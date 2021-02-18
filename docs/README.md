# CakePHP Users Notifications Plugin 


## Installation
```
composer require token27/cakephp-user-notify-plugin
```

### Load the plugin
If you prefer load the plugin from command CLI:
```sh
bin/cake plugin load UserNotify
```

If you want edit in your `you-app-path/src/Application.php`'s bootstrap():
```php
$this->addPlugin('UserNotify');
```

If you want to also access the backend controller (not just using CLI), you need to use
```php
$this->addPlugin('UserNotify', ['routes' => true]);
```

### Create database plugin schema
Run the following command in the CakePHP console to create the tables using the Migrations plugin:
```sh
bin/cake migrations migrate -p UserAuth
bin/cake migrations migrate -p UserNotify
```

### Global configuration
The plugin allows some simple runtime configuration.
You may create a file called `app_user_notifiy.php` inside your `config` folder (NOT the plugins config folder) to set the following values:

- Use a different connection:

```php
$config['UserNotify']['connection'] = 'custom'; // Defaults to 'default'
```

# Endpoints

## Users
| METHOD | PATH | PARAMS | Description |
| --- | ------ | -------- | --- |
| **GET/POST** | **/user-notify/list** | user_id, status | Get notification list by params. |

## Postman
You can test endpoints with a Postman.
File: `you-app-path/src/vendor/token27/cakephp-user-notify-plugin/docs/postman.json`
(You must modify the enviroment vars from postman domain, etc..)

