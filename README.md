Notifier for Laravel 5
============================

Instant notifications for yours errors and exceptions on your Laravel php applications.


[BugTower](https://bugtower.net) captures errors in real-time from your web and android applications, helping you to understand and resolve them  as fast as possible.


How to Install
--------------

1.  Install the `bugtower/bugtower-report` package

    ```shell
    $ composer require "bugtower/bugtower-report": "dev-master"
    ```

2.  Update `config/app.php`

    ```php
    # Add `BugsnagLaravelServiceProvider` to the `providers` array
    'providers' => array(
        ...
        'BugTower\BugTowerLaravel\BugTowerLaravelServiceProvider',
    )

    # And in aliases add following
    'aliases' => array(
        ...
        'BugTower' => 'BugTower\BugTowerLaravel\BugTowerFacade',
    )
    ```

3. Change exception handler in `App/Exceptions/Handler.php`.

    ```php
    # COMMENT this line
    use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
    ```

    ```php
    # ADD this line instead
    use BugTower\BugTowerLaravel\BugTowerExceptionHandler as ExceptionHandler;
    ```

    After this change, your file should look like this:

    ```php
    <?php namespace App\Exceptions;

    use Exception;
	// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
    use BugTower\BugTowerLaravel\BugTowerExceptionHandler as ExceptionHandler;

    class Handler extends ExceptionHandler {
        ...
    }

    ```

Configuration
-------------------------

1. Open file `config/services.php`

2. Add array `api_key`:

    ```php
		...
		'bugtower' => [
			'key' => 'YOUR-API-KEY-HERE',
		]
		...
    ```
	
	After this change, your file should look like this:
	
	```php
		<?php

		return [
			'mailgun' => [
				'domain' => '',
				'secret' => '',
			],

			'mandrill' => [
				'secret' => '',
			],

			'ses' => [
				'key' => '',
				'secret' => '',
				'region' => 'us-east-1',
			],

			'stripe' => [
				'model'  => 'App\User',
				'secret' => '',
			],
			'bugtower' => [
				'key' => 'YOUR-API-KEY-HERE',
			]
		];
    ```