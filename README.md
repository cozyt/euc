# European Cookie Law Compliance Class

A Simple Laravel class to manage cookies to comply with the European cookie law

## Version

0.1

## Installation

Installation is pretty straight forward.

1. Add the class to Laravel Autoloader, I choose to do this in Composer but however is best for you should still work

Either add to a `libraries` directory and load the entire contents:

	"autoload": {
		"classmap": [
			"app/DIRECTORY_WHERE_YOUR_LIBRARY_FILES_LIVE",
		],
	},

OR load on a file by file basis:

	"autoload": {
		"files": [
			"app/libraries/EUC.php"
		]
	},

2. Call the `EUC::init()` method in the `app/filters.php` file

	`
	App::after(function($request, $response)
	{
		EUC::init();
	});
	`

3. Add a setting called `privacy_document` to the `app/config/app.php` config file. This should be the location of the application's privacy view file and so should be defined in the same way as it would be if you were calling `View::make()`.

	`'privacy_document' => 'pages.privacy',`

Thats it! You can then use some of the built in methods to control inclusions of Googe Analytics snippets and Cookie Notices/Banners or to manage a users acceptance of cookies on the site.