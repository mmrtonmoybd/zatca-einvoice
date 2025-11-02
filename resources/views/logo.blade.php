<div>
@if (auth('web')->user())
<a href="{{ url('/') }}">
        <img class="w-40 h-10" src="{{ public_path('storage/' . auth('web')->user()->company->logo) }}" alt="" />
    </a>
    <br><br>
@else
    <h3>{{ config('app.name') }}</h3>
@endif
    
</div>