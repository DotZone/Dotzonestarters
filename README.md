# Dotzonestarters

Package to install a regular Laravel Starter Kit with a non-regular different design theme.

Works only with the latest Laravel 9.

The package suggests to install [Laravel UI](https://github.com/laravel/ui) (Bootstrap) starter kit, and adds the chosen design theme on top.

---

## Important

This package should be used **immediately after installing Laravel**. If you add any more functionality, like routes or controllers, they may get overridden by Larastarters.

---

## Usage

1. Install fresh Laravel project
2. Run `composer require DotZone/dotzonestarters --dev`
3. Run `php artisan dotzonestarters:install` - it will show a wizard to choose the starter kit and the theme (options are listed below)
4. That's it, you have Laravel Auth starter, just visit the home page and click Log in / Register

### Developing within a container

Internally this package runs several `php artisan` commands during the install process. This command may not work and the installation process hang if you are within a container. Alternatively, you may pass the `--php_version` flag to change this behaviour. For example: `php artisan dotzonestarters:install --php_version=./vendor/bin/sail`.


## Available Themes

In the current version, there are 7 themes supported. 

**Bootstrap Themes with Laravel UI**

- [Core UI - Bootstrap 5](https://coreui.io/)
- [AdminLTE - Bootstrap 4](https://adminlte.io/)
- [Metronic - Bootstrap 5](https://https://keenthemes.com/metronic8/)
- [Plainadmin - Bootstrap 5](https://plainadmin.com/)
- [Volt - Bootstrap 5](https://demo.themesberg.com/volt/) - contributed by [@knaazimkhan](https://github.com/knaazimkhan)
- [SB Admin 2 - Bootstrap 4](https://startbootstrap.github.io/startbootstrap-sb-admin-2/) - contributed by [@pcmehrdad](https://github.com/pcmehrdad)
- [Tabler.io - Bootstrap 5](https://tabler.io/) - contributed by [@PierreLebedel](https://github.com/PierreLebedel)

---