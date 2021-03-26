# Laravel Pages
![Packagist](https://img.shields.io/packagist/l/ryancco/laravel-pages?style=flat-square)
![GitHub Workflow Status](https://github.com/ryancco/laravel-pages/actions/workflows/tests.yml/badge.svg?style=flat-square)
![Packagist](https://img.shields.io/packagist/dm/ryancco/laravel-pages?style=flat-square)


Laravel Pages allows for static pages to be served without the need to configure a route or controller and without having to version files in your `public/` directory.

The primary purpose for this package is to allow designers who are comfortable with writing code to contribute to the same repository that developers will eventually be adapting their designs into. Allowing for one trail of version control history to step through and a more collaborative and inclusive workspace for the entire team without a higher barrier to entry.

There are also plenty of other use cases for such a package - anywhere you want to quickly scaffold and serve static files with the added abilities to leverage the blade compiler composing your pages and Laravel mix for building assets without having to create a new project.

This package has been heavily inspired by [High Voltage](https://github.com/thoughtbot/high_voltage) by [thoughtbot](https://github.com/thoughtbot) from the Rails world.

## Usage
```bash
composer require ryancco/laravel-pages
```

By default,
  - the path to create your view files will be `resources/pages/`
  - the default route prefix to access these pages will be `http://your-app.com/pages/`
  - there are no middleware applied to the pages **(this includes the web middleware group which provides session functionality)**

Though these are all configurable in the `config/pages.php` file.
```bash
php artisan vendor:publish --provider="Ryancco\Pages\PagesServiceProvider"
```
_**Note**: in order to use any session-dependent logic (i.e. the `Auth` or `Session` facades) or blade directives in your pages, such as anything related to the authorization status of a user (i.e. `@auth`, `@guest`) you must configure pages to use the `web` middleware group or the individual `StartSession` middleware._
```php
[
// ...
    'middleware' => [
         'web'
    ]
// ...
];
```

With pages configured to your liking, if you were to create a view at `resources/pages/about.blade.php` you would be able to access this at `http://your-app.com/pages/about`. Without having to register a single route or create a single controller.

## Routing

Pages can be routed to from within your application as you would any other dynamic page or route.

Alongside traditional routing methods leveraging relative/absolute paths and the `url` helper, there is also a `page` helper and `Page` facade which accept both slash and dot form paths.

```php
// continue to work as expected 👍
redirect()->to('/pages/about_us');
redirect()->to(url('pages/about_us'));

// both work - regardless of your configured prefix 👌
redirect()->to(page('pages/about_us'));
redirect()->to(page('pages.about_us'));

// also available via the Pages facade 🤝
redirect()->to(Pages::url('pages/about_us'));
redirect()->to(Pages::url('pages.about_us'));
```

_**Note**: Because package routes are loaded last, you can set the route prefix to an empty string to allow for serving static pages from the top level alongside your application-defined routes. However, this may conflict with routes registered **after** this package is loaded (i.e. routes registered by other packages & routes registered outside your applications' route files)._

# License
Laravel Pages is licensed under the MIT License. Please see the [LICENSE.md](LICENSE.md) file for more information.
