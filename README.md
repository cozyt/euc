# European Cookie Law Compliance Class

A Simple set of classes to manage cookies to comply with the _(silly)_ European cookie law

## Version

1.0

## Installation

Installation is pretty straight forward.

1. Add the package to your `composer.json` file. As it's not yet registered on Packagist, you might want to add the full repository

    ```json
        "require": [
            "cozyt/euc": "1.*",
        ],
        "repositories": [
            {
                "type": "git",
                "url": "https://github.com/cozyt/euc"
            }
        ],
    ```

2. Register the middleware class in your `app\Http\Kernel.php` as a `$routeMiddleware` or listed as part of a middleware group.

    ```php
    \Euc\Middleware\InitEuc::class,
    ```

3. Add a setting called `privacy_document` to the `app/config/app.php` config file. This should be the location of the application's privacy view file and so should be defined in the same way as it would be if you were calling `View::make()`.

	```php
    'privacy_document' => 'pages.privacy',`
    ```

4. Register the following routes in your `route.php` file, if you need them

    ```php
    Route::get('privacy',           ['as' => 'privacy',         'uses' => '\Euc\Controllers\EucController@privacy']);
    Route::get('cookies/optin',     ['as' => 'cookies.optin',   'uses' => '\Euc\Controllers\EucController@cookiesOptIn']);
    Route::get('cookies/optout',    ['as' => 'cookies.optout',  'uses' => '\Euc\Controllers\EucController@cookiesOptOut']);
    ```

5. Register the view files, if you need them

    ```php
    'paths' => [
        realpath(base_path('vendor/cozyt/euc/views')),
    ],
    ```

Thats it! You can then use some of the built in methods to control inclusions of Googe Analytics snippets and Cookie Notices/Banners or to manage a users acceptance of cookies on the site.

