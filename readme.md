## Installation

  
  Add to composer.json:
```json

"repositories": {
	"nova": {
		"type": "composer",
		"url": "https://nova.laravel.com"
	},
	"spark-stripe": {
		"type": "composer",
		"url": "https://spark.laravel.com"
	},
	"service-base-test": {
		"type": "path",
		"url": "./packages/rhyslees/service-base-test",
		"options": {
			"symlink": true
		}
	},
	"nova-styling": {
		"type": "vcs",
		"url": "https://github.com/Manage-It-Pro-Ltd/Nova-Styling"
	}
},
"require": {
	"rhyslees/service-base-test": "@dev"
},

```

  

Add to .env:

```env
DB_SERVICE_BASE_CONNECTION=mysql
DB_SERVICE_BASE_HOST=
DB_SERVICE_BASE_PORT=
DB_SERVICE_BASE_DATABASE=
DB_SERVICE_BASE_USERNAME=
DB_SERVICE_BASE_PASSWORD=  

STRIPE_KEY=
STRIPE_SECRET=
STRIPE_WEBHOOK_SECRET=

CASHIER_MODEL=App\Models\Team
CASHIER_CURRENCY=gbp
CASHIER_CURRENCY_LOCALE=en_GB
```

  
Run the following commands:

```bash
composer update

php artisan servicebase:install

npm install && npm run dev

php artisan vendor:publish --provider="ManageItProLtd\NovaStyling\ThemeServiceProvider" --tag="config" --force
php artisan vendor:publish --provider="ManageItProLtd\NovaStyling\ThemeServiceProvider" --tag="views" --force
php artisan vendor:publish --provider="ManageItProLtd\NovaStyling\ThemeServiceProvider" --tag="styling" --force

php artisan migrate:fresh

```


They should be added automatically upon running `php artisan servicebase:install`

Ensure the following is added to App\Models\Team.php:

```php
use  RhysLees\ServiceBase\Traits\Team  as TraitsTeam;
use  RhysLees\ServiceBase\Traits\ServiceBase;
...

use  ServiceBase;
use  TraitsTeam;

```
Ensure the following is added to App\Models\TeamInvitation.php:
```php

use  RhysLees\ServiceBase\Traits\Team  as TraitsTeamInvitation;
use  RhysLees\ServiceBase\Traits\ServiceBase;
...

use  ServiceBase;
use  TraitsTeamInvitation;

```

  

Ensure the following is added to App\Models\Membership.php:
```php

use  RhysLees\ServiceBase\Traits\ServiceBase;
...

use  ServiceBase;

```

  

Ensure the following is added to App\Models\User.php:
```php

use  RhysLees\ServiceBase\Traits\Team  as TraitsUser;
use  RhysLees\ServiceBase\Traits\ServiceBase;
...

use  ServiceBase;
use  TraitsUser;

```

  
  
  

## Usage

  
  

### Changelog

  

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

  

## Contributing

  

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

  

### Security

  

If you discover any security related issues, please email me@iuga.dev instead of using the issue tracker.

  

## Credits

  

- [Rhys Lees](https://github.com/rhyslees)

- [All Contributors](../../contributors)

  

## License

  

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
