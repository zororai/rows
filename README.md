# Rose of Sharon Welfare Organisation website

Laravel 13 site with an admin panel for posting stories and gallery photos.

## Run locally

Requires PHP 8.3+ (Herd's PHP 8.4 works) and Composer.

```bash
composer install
cp .env.example .env        # first time only
php artisan key:generate    # first time only
php artisan migrate --seed
php artisan serve
```

Open http://127.0.0.1:8000. The admin panel is at http://127.0.0.1:8000/admin.

## Admin login

`php artisan migrate --seed` creates the admin account from these `.env` values:

```
ADMIN_NAME="Site Administrator"
ADMIN_EMAIL=admin@roseofsharon.co.zw
ADMIN_PASSWORD="ChangeMe123!"
```

**Change the password before going live.** Edit the values in `.env`, then run `php artisan db:seed` again to update the account. Seeding won't duplicate existing stories or photos.

## What the admin can do

- **Stories**: write, edit, delete, save as draft, schedule a future publish date, upload a cover image.
- **Gallery**: upload up to 20 photos at once, set title, caption and album, choose which photos appear on the home page, and set their order.

Uploaded files are saved in `public/uploads/`, so `storage:link` isn't needed. Back up this folder along with `database/database.sqlite`.

## Deploying with Hostinger's GitHub deployment

The repo deploys straight into `public_html`. The root `.htaccess` sends all traffic into `public/`, so `.env`, the database and the source code can't be downloaded. There is no Node/npm build step; the CSS and JS in `public/` are used as they are.

After the first deployment, open SSH (hPanel → Advanced → SSH Access) and run, once:

```bash
cd ~/domains/yourdomain.com/public_html
php -v                                        # must be 8.3 or newer
composer install --no-dev --optimize-autoloader
cp .env.example .env && php artisan key:generate
# edit .env: APP_ENV=production, APP_DEBUG=false, APP_URL=https://yourdomain.com, ADMIN_PASSWORD=...
touch database/database.sqlite
php artisan migrate --seed --force
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

After each later redeploy, run `composer install --no-dev --optimize-autoloader && php artisan migrate --force && php artisan config:cache`.

## Deploying to cPanel / shared hosting

1. Upload the whole project **outside** `public_html`, e.g. `~/rose-of-sharon`.
2. Copy the contents of `rose-of-sharon/public/` into `public_html/`.
3. In `public_html/index.php`, change the two `__DIR__.'/../` paths to `__DIR__.'/../rose-of-sharon/`.
4. In `.env`, set `APP_ENV=production`, `APP_DEBUG=false` and `APP_URL=https://your-domain`.
5. Run `php artisan migrate --seed --force` (from cPanel Terminal or SSH).
6. Make `storage/`, `bootstrap/cache/`, `database/` and `public_html/uploads/` writable by the web server.

With step 2, uploads go to `rose-of-sharon/public/uploads`, not to `public_html/uploads`. Fix this by adding the following to `register()` in `app/Providers/AppServiceProvider.php`:
`$this->app->usePublicPath(base_path('../public_html'));`

To use MySQL instead of SQLite, set `DB_CONNECTION=mysql` and fill in the `DB_*` values in `.env`.

Photo uploads are limited to 5 MB each. PHP's own limits must allow this too: set `upload_max_filesize` to at least `8M` and `post_max_size` to at least `64M` (cPanel → MultiPHP INI Editor).

## Tests

```bash
php artisan test
```
