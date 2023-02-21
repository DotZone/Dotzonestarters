# Dotzone Starters

Package that contains all the basic files and folders that are needed to start a new project.

Works only with the latest Laravel 9.

The package suggests to install [Laravel UI](https://github.com/laravel/ui) (Bootstrap) starter kit, and adds the chosen design theme on top, in addition to some features and generators.

---

## Important

This package should be used **immediately after installing Laravel**. If you add any more functionality, like routes or controllers, they may get overridden by Dotzonestarters.

---

## Usage

1. Install fresh Laravel project
2. Run `composer require DotZone/dotzonestarters --dev`
3. Run `php artisan dotzone-starter:install` - it will show a wizard to choose the starter kit and the theme (options are listed below)
4. To have **Role Permission** integradet into the starter kit, you just have to answer with *Yes* upon seeing the question after running the dotzone installer command.
5. That's it, you have Laravel Auth starter, just visit the home page and click Log in / Register

### Developing within a container

Internally this package runs several `php artisan` commands during the install process. This command may not work and the installation process hang if you are within a container. Alternatively, you may pass the `--php_version` flag to change this behaviour. For example: `php artisan dotzonestarters:install --php_version=./vendor/bin/sail`.

## Generate code

By running `php artisan dotzone-starter:generate {name}` where the `name` is the model name. This command will excute the following actions:

- Create the model and migration
- Create Controller with ready made functions
- Create Store and Update Request
- Create views like index, table and modal 
- Create custom Javascript file with ready made functions
- Add translation keys inside lang/en/messages.php
- Add custom menu to the sidebar menu list
- Add permission keys to the default permission seeder

All previews actions are generated for the management part of the webapp (Control Panel).


## Available Themes

In the current version, there is 1 theme supported. 

**Bootstrap Themes with Laravel UI**

- [Metronic - Bootstrap 5](https://keenthemes.com/metronic8/)

## Role Permissions

In the current version, there is 1 role-based access control package supported.

- [Laratrust - Santigarcor](https://laratrust.santigarcor.me)

## Credit

- [Larastarters - LaravelDaily](https://github.com/LaravelDaily/Larastarters)

---
