## Gemeente Klachten (Laravel + Blade, plain CSS)

A simple complaints portal for Gemeente Vlaardingen. Auth is via Laravel Breeze (Blade). No Tailwind/Bootstrap/Vite; all CSS/JS are linked directly from `public`.

### Requirements
- PHP 8.2+, Composer
- MySQL (tested with XAMPP), database name `gemeente_klachten`

### Setup
1) Install dependencies: `composer install`
2) Environment: copy `.env.example` → `.env`, set DB creds (default DB `gemeente_klachten`, user `root`, empty password), then `php artisan key:generate`
3) Migrate + seed: `php artisan migrate --seed`
4) Storage symlink: `php artisan storage:link`
5) Run: `php artisan serve`

### Admin credentials
- `admin@local.test` / `password`

### Navigation
- Guest home: `/` (route `welcome`), redirects authenticated users to `dashboard` → `/my/complaints`
- Submit complaint: `/complaints/create`
- My complaints: `/my/complaints`
- Admin list: `/admin/complaints`
- Admin map + API: `/admin/map`, data at `/admin/api/complaints`

### Notes
- Authorization uses `AuthorizesRequests`; `ComplaintPolicy@view` allows owner or admin to view details.
- Assets for the public home page: `public/css/pages/home.css`, `public/js/home.js`, images in `public/images/`.
