<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;

class CheckTenantSuspension
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = Filament::getTenant();

        // No tenant = ignore check
        if (! $tenant) {
            return $next($request);
        }

        if ($tenant->isSuspended()) {
            // Allow only these routes
            $allowedRoutes = [
                'filament.app.pages.my-profile',
                'filament.app.auth.logout',
                'filament.app.pages.dashboard',
                'filament.app.tenant'
            ];

            if (! in_array($request->route()?->getName(), $allowedRoutes)) {
                // Optional: show a message
               // session()->flash('suspended_message', 'Your subscription has expired. Please renew to regain access.');

                Notification::make('Error')
        ->title('suspended_message')
        ->danger()
        ->body('Your subscription has expired. Please renew to regain access.')->send();

                // Redirect to dashboard or a suspension page
                return redirect()->route('filament.app.pages.dashboard', $tenant);
            }
        }

        return $next($request);
    }
}
