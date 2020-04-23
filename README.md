# Laravel Pages
![Packagist](https://img.shields.io/packagist/l/ryancco/laravel-pages?style=flat-square)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/ryancco/laravel-pages/tests?style=flat-square)
![Packagist](https://img.shields.io/packagist/dm/ryancco/laravel-pages?style=flat-square)


Laravel Pages allows for static pages to be served without the need to configure a route or controller and without having to version files in your `public/` directory.

The primary purpose for this package is to allow designers who are comfortable with writing code to contribute to the same repository that developers will eventually be adapting their designs into. Allowing for one trail of version control history to step through and a more collaborative and inclusive workspace for the entire team without a higher barrier to entry.

There are also plenty of other use cases for such a package. Anything that you would serve as static HTML and CSS.

This package has been heavily inspired by [High Voltage](https://github.com/thoughtbot/high_voltage) by [thoughtbot](https://github.com/thoughtbot) from the Rails world.

## Usage
```bash
composer require ryancco/laravel-pages
```

From there, you're ready to create your pages! By default, the path to create your view files will be `resources/pages/` and the default route prefix to access these pages will be `http://your-app.com/pages/`. Though these are both configurable in your `config/pages.php` file.

For example, if you were to create a view at `resources/pages/about.blade.php` you would be able to access this at `http://your-app.com/pages/about`. Without having to register a single route or create a single controller.

## Routing

Pages can be routed to from within your application as you would any other dynamic page or route.

Alongside traditional routing methods leveraging relative/absolute paths and the `url` helper, there is also a `page` helper which accepts both slash and dot form paths.

```php
redirect()->to('/pages/about_us');

redirect()->to(url('pages/about_us'));

redirect()->to(page('pages/about_us'));
redirect()->to(page('pages.about_us'));
```

Because package routes are loaded last, you can set the route prefix to an empty string to allow for serving static pages from the top level alongside your application-defined routes. Note: this will conflict with routes registered *after* this package is loaded (i.e. routes registered by other packages & routes registered outside of your applications' route files).

# License
Laravel Pages is licensed under the MIT License. Please see the [LICENSE.md](LICENSE.md) file for more information.