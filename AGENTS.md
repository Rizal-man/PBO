# BLOXSHOP — Laravel + Filament

## Stack
- **Laravel 13**, PHP 8.3+, MySQL 8 (Laragon), **Filament 5.6**, Tailwind CSS 4 (Vite), Spatie Permission 8
- Session/cache/queue all use `database` driver in `.env`

## Key commands
| Command | Action |
|---|---|
| `composer dev` | Serve + queue:listen + Vite (concurrently) |
| `composer test` | `config:clear` then `php artisan test` |
| `npm run dev` | Vite dev server only |
| `npm run build` | Vite production build |
| `composer setup` | Full first-time setup (composer install, .env, key, migrate, npm build) |

> `php artisan test` uses SQLite `:memory:` (see `phpunit.xml`).

## App structure
- **Filament admin** at `/admin` — only users with `role = 'admin'` can access (`app/Models/User.php:21`)
- **Filament Resources** use separated `Schemas/`, `Tables/`, `Pages/` per resource (not inline)
- **Public page** is `welcome.blade.php` rendered via `ItemController@index` at `/`
- **Two customer models** exist: `customers` (current table) and `CustomerModel` (legacy `customer` table)
- **Items** have: `nama_item`, `jumlah_item`, `harga_item`, `kode_item`, `images` (stored on `public` disk under `item-images/`)

## Conventions
- 4-space indentation (PHP), 2-space for YAML (`.editorconfig`)
- Filament forms use `Filament\Schemas\Schema` (not old `Forms\Components`)
- When adding a Filament resource, create separate files under `Schemas/`, `Tables/`, `Pages/`
- Image uploads → `public` disk → `item-images/` directory, max 1 MB
- All new Filament Resources/Pages/Widgets are auto-discovered from `app/Filament/`

## Test quirks
- No RefreshDatabase trait used in existing tests; tests run on in-memory SQLite
- Only example tests exist — any new test that hits the DB needs to handle migration/setup
