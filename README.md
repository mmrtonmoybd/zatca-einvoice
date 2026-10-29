# ZATCA E-Invoice

A multi-company invoicing system for Saudi Arabia that issues bilingual (English / Arabic) VAT invoices with a ZATCA-compliant QR code. Built with Laravel 12, Filament 4, and Livewire 3.

Each customer company works in its own isolated workspace (tenant). A central admin panel creates companies, assigns their users, and controls subscription expiry.

## Features

### Company workspace (`/app`)

- **Sales invoices:** cash or credit, with line items, per-line discount and VAT, cash discount, and automatic totals
- Optional invoice details: PO reference, delivery note reference, delivery and due dates, payment terms, invoice period, project reference, narration, and an attached file
- **PDF invoices:** bilingual A4 layout with:
  - a ZATCA (Fatoora) QR code containing seller name, VAT number, invoice date, total, and VAT amount
  - the amount in words in English and Arabic (Saudi Riyals)
  - company bank details
  - an optional header and footer banner variant
- **Products** with categories and units, and **customers**
- **Company profile:** English and Arabic name, address, VAT number, CR number, bank details, IBAN, SWIFT code, and logo
- Team users with invitations
- Date-range filters on tables

### Admin panel (`/admin`)

- Manage companies (teams), their owners, and members
- Set a company's **expiration date** and active status. Expired or inactive companies are limited to their dashboard and profile until they are renewed
- Enable invoice header/footer banners per company
- Manage admins, users, and team invitations
- Log viewer

## Tech stack

| Layer    | Packages                                                      |
| -------- | ------------------------------------------------------------- |
| Backend  | PHP 8.2+, Laravel 12                                          |
| Admin UI | Filament 4, Livewire 3                                        |
| Invoices | `salla/zatca` (QR code), `omaralalwi/gpdf` (Arabic-ready PDF) |
| Numbers  | `rmunate/spell-number` (amount in words)                      |
| Tooling  | Pest, Larastan, Pint, Debugbar, IDE Helper                    |

## Getting started

### Requirements

- PHP 8.2+
- Composer
- Node.js and npm
- MySQL (default) or another database supported by Laravel

### Installation

```bash
git clone https://github.com/mmrtonmoybd/zatca-einvoice.git
cd zatca-einvoice

php install.php
```

The installer installs dependencies, creates `.env`, generates the app key, sets up the database, runs migrations and seeders, and builds the frontend assets.

To do it by hand instead:

```bash
composer install
cp .env.example .env
php artisan key:generate
# set the DB_* values in .env
php artisan migrate --seed
php artisan storage:link
npm install && npm run build
```

### Default accounts

| Panel             | Email               | Password   |
| ----------------- | ------------------- | ---------- |
| Admin (`/admin`)  | `admin@teamkit.com` | `password` |
| Company (`/app`)  | `user@teamkit.com`  | `password` |

Change both passwords right away. In the admin panel, create a company and add the user to it before signing in to `/app`.

### Run locally

```bash
composer dev
```

## Testing and code style

```bash
php artisan test        # Pest test suite
vendor/bin/pint         # fix PHP code style
vendor/bin/phpstan      # static analysis
```

## Credits

Built on the [TeamKit](https://github.com/jeffersongoncalves/teamkitv4) Filament starter kit by Jefferson Gonçalves.

## Author

Moshiur Rahman — [rmedha037@gmail.com](mailto:rmedha037@gmail.com)
