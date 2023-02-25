# Dotzone Starters

<div align="center">
    <p align="center">
        <a href="#get-started">Get started</a> |
        <a href="#available-themes">Available Themes</a> |
        <a href="#generator">Generator</a> |
        <a href="#features">Features</a> |
        <a href="https://dotzonegrp.com" target="_blank">Dotzone Group</a>
        <br/> <br/>
        <a href="https://packagist.org/packages/LaravelDaily/Larastarters"><img alt="Laravel Version" src="https://img.shields.io/static/v1?label=laravel&message=%E2%89%A59.0&color=0078BE&logo=laravel&style=flat-square"></a>
        <a href="https://packagist.org/packages/LaravelDaily/Larastarters"><img alt="Latest Version" src="https://img.shields.io/packagist/v/LaravelDaily/Larastarters"></a>
        <a href="https://packagist.org/packages/LaravelDaily/Larastarters"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/LaravelDaily/Larastarters"></a>
  </p>
</div>

Package that contains all the basic files and folders that are needed to start a new project.

Works only with the latest Laravel 9 for now.

The package suggests to install [Laravel UI](https://github.com/laravel/ui) (Bootstrap) starter kit, and adds the chosen design theme on top, in addition to some features and generators.

---

## ` ❗ ` Important

This package must be used in a **NEW** Laravel project. Existing project functionalities, such as routes or controllers, may be overridden by Dotzonestarters.


---

## Features

Along with the Design Themes, Dotzonestarters adds a few features that are typical for almost any project:

- Main Page
- Login/Register Pages
- A generator command

<br/>

---

## Get Started

Dotzonestarters requires PHP 8+ and Laravel 9+.

1. Create a new Laravel project.

2. Require Dotzonestarters as a dev dependency, run:

<<<<<<< HEAD
    ```shell
    composer require dotzone/dotzonestarters:latest --dev
    ```
=======
1. Install fresh Laravel project
2. Run `composer require dotzone/dotzonestarters:1.1.2 --dev`
3. Run `php artisan dotzone-starter:install` - it will show a wizard to choose the starter kit and the theme (options are listed below)
4. To have **Role Permission** integradet into the starter kit, you just have to answer with *Yes* upon seeing the question after running the dotzone installer command.
5. That's it, you have Laravel Auth starter, just visit the home page and click Log in / Register
>>>>>>> a492dd0869cd606dfa6f800c7ad480ff3839beea

3. Configure Dotzonestarters, run the command below:

    ```shell
    php artisan dotzone-starter:install
    ```

    Choose your preferred starter kit and Design Theme.

4. For **Role Permission** integration, choose yes once you see the question.

5. That's it! You have Laravel Auth starter, just visit the home page and click Log in / Register.

<br/>

---

## Developing within a container

Internally, this package runs several `php artisan` commands during the installation process.

If you are developing with a container, like Laravel Sail or Docker, you can pass the `--php_version` flag to change this behaviour and avoid problems in the installation process:

```shell
php artisan dotzone-starter:install --php_version=./vendor/bin/sail`.
```

</br>

---
## Generator

To generate a new entity just run
```shell
php artisan dotzone-starter:generate {name}
```
where the `name` is the model name. This command will excute the following actions:

- Create the model and migration
- Create Controller with ready made functions
- Create Store and Update Request
- Create views like index, table and modal 
- Create custom Javascript file with ready made functions
- Add translation keys inside lang/en/messages.php
- Add custom menu to the sidebar menu list
- Add permission keys to the default permission seeder

All previews actions are generated for the management part of the webapp (Control Panel).

</br>

---

## Available Themes

In the current version, there is 1 theme supported. 

**Bootstrap Themes with Laravel UI**

- [Metronic - Bootstrap 5](https://keenthemes.com/metronic8/)

## Role Permissions

In the current version, there is 1 role-based access control package supported.

- [Laratrust - Santigarcor](https://laratrust.santigarcor.me)

</br>

---
## Credit

- [Larastarters - LaravelDaily](https://github.com/LaravelDaily/Larastarters)

---
