# Laravel-Nuxt

<a href="https://travis-ci.org/cretueusebiu/laravel-nuxt"><img src="https://travis-ci.org/cretueusebiu/laravel-nuxt.svg?branch=master" alt="Build Status"></a>
<a href="https://packagist.org/packages/cretueusebiu/laravel-nuxt"><img src="https://poser.pugx.org/cretueusebiu/laravel-nuxt/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/cretueusebiu/laravel-nuxt"><img src="https://poser.pugx.org/cretueusebiu/laravel-nuxt/v/stable.svg" alt="Latest Stable Version"></a>

> A Laravel-Nuxt starter project template.

<p align="center">
<img src="https://i.imgur.com/NHFTsGt.png">
</p>

## Features

- Nuxt 2.8
- Laravel 5.8
- SPA or SSR
- Socialite integration
- VueI18n + ESlint + Bootstrap 4 + Font Awesome 5
- Login, register, email verification and password reset

## Installation

- `composer create-project --prefer-dist cretueusebiu/laravel-nuxt`
- Edit `.env` to set your database connection details and `APP_URL` (the url to your Laravel application)
- (When installed via git clone or download, run `php artisan key:generate` and `php artisan jwt:secret`)
- `php artisan migrate`
- `npm install`

## Usage

### Development

```bash
npm run dev
```

You can access your application at `http://localhost:3000`.

### Production

```bash
npm run build
```

You can access your application the url you set `APP_URL` to.

### Enable SSR

- Remove `mode: 'spa'` and `'~plugins/nuxt-client-init'` from `client/nuxt.config.js` 
- Edit `.env` to set `APP_URL=http://api.example.com` and `CLIENT_URL=http://example.com`
- Run `npm run build` and `npm run start`

#### Nginx Proxy

For Nginx you can add a proxy using the follwing location block:

```
server {
    location / {
        proxy_pass http://http://127.0.0.1:3000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }
}
```

#### Process Manager

In production you need a process manager to keep the Node server alive forever:

```bash
# install pm2 process manager
npm install -g pm2

# startup script
pm2 startup

# start process
pm2 start npm --name "laravel-nuxt" -- run start

# save process list
pm2 save

# list all processes
pm2 l
```

After each deploy you'll need to restart the process:

```bash
pm2 restart laravel-nuxt 
```

Make sure to read the [Nuxt docs](https://nuxtjs.org/).

## Socialite

This project comes with GitHub as an example for [Laravel Socialite](https://laravel.com/docs/5.8/socialite).

To enable the provider create a new GitHub application and use `https://example.com/api/oauth/github/callback` as the Authorization callback URL.

Edit `.env` and set `GITHUB_CLIENT_ID` and `GITHUB_CLIENT_SECRET` with the keys form your GitHub application.

For other providers you may need to set the appropriate keys in `config/services.php` and redirect url in `OAuthController.php`.

## Email Verification

To enable email verification make sure that your `App\User` model implements the `Illuminate\Contracts\Auth\MustVerifyEmail` contract.

## Notes

- This project uses [router-module](https://github.com/nuxt-community/router-module), so you have to add the routes manually in `client/router.js`.
- If you want to separate this in two projects (client and server api), move `package.json` into `client/` and remove config path option from the scripts section. Also make sure to add the env variables in `client/.env`.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.
