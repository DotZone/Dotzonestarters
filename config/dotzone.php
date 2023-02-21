<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Default Information
    |--------------------------------------------------------------------------
    |
    */

    'cms' => [

        'name' => 'Dotzone Starter',

        'template' => 'metronic',

        'installed' => false,

        'role_permission' => false,

        'package' => [

            'name' => 'Dotzone Starter',

            'version' => '1.0.0',

            'author' => 'Dotzone Group',

            'email' => 'ahmad.m.shebbo@dotzonegrp.com',

            'website' => 'https://dotzonegrp.com',

            'description' => 'Dotzone Starter is a package that helps you to start your project with a ready-made admin panel and a ready-made API.',

            'namespace' => 'DotZone\Dotzonestarters',

            'license' => 'MIT',

            'path' => base_path('vendor/dotzone/dotzonestarters'),

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    */

    'path' => [

        'migration'         => database_path('migrations/'),

        'model'             => app_path('Models/'),

        'routes'            => base_path('routes/web.php'),

        'api_routes'        => base_path('routes/api.php'),

        'request'           => app_path('Http/Requests/'),

        'api_request'       => app_path('Http/Requests/API/'),

        'controller'        => app_path('Http/Controllers/'),

        'manage_controller' => app_path('Http/Controllers/Manage/'),

        'api_controller'    => app_path('Http/Controllers/API/'),

        'api_resource'      => app_path('Http/Resources/'),

        'view_provider'     => app_path('Providers/ViewServiceProvider.php'),

        'views'             => resource_path('views/'),

        'manage_views'      => resource_path('views/manage/'),

        'menu_file'         => resource_path('views/layouts/menu.blade.php'),

    ],

    /*
    |--------------------------------------------------------------------------
    | Stubs Path
    |--------------------------------------------------------------------------
    |
    */

    'stubs' => [

        'controller'    => base_path('vendor/dotzone/dotzonestarters/resources/stubs/controller.stub'),

        'model'         => base_path('vendor/dotzone/dotzonestarters/resources/stubs/model.stub'),

        'routes'        => base_path('vendor/dotzone/dotzonestarters/resources/stubs/routes.stub'),

        'lang'          => base_path('vendor/dotzone/dotzonestarters/resources/stubs/lang.stub'),

        'api_routes'    => base_path('vendor/dotzone/dotzonestarters/resources/stubs/api_routes.stub'),

        'templates'     => base_path('vendor/dotzone/dotzonestarters/resources/templates/'),

    ],


    /*
    |--------------------------------------------------------------------------
    | Namespaces
    |--------------------------------------------------------------------------
    |
    */

    'namespace' => [

        'model'             => 'App\Models',

        'datatables'        => 'App\DataTables',

        'livewire_tables'   => 'App\Http\Livewire',

        'controller'        => 'App\Http\Controllers',

        'api_controller'    => 'App\Http\Controllers\API',

        'api_resource'      => 'App\Http\Resources',

        'request'           => 'App\Http\Requests',

        'api_request'       => 'App\Http\Requests\API',

        'seeder'            => 'Database\Seeders',

        'factory'           => 'Database\Factories',

    ],


    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    */

    'options' => [

        'soft_delete' => false,

        'save_schema_file' => true,

        'localized' => false,

        'repository_pattern' => true,

        'resources' => false,

        'factory' => false,

        'seeder' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Prefixes
    |--------------------------------------------------------------------------
    |
    */

    'prefixes' => [

        'route' => '',  // e.g. admin or admin.shipping or admin.shipping.logistics

        'manage' => 'manage',  // e.g. admin or admin.shipping or admin.shipping.logistics

        'namespace' => '',  // e.g. Admin or Admin\Shipping or Admin\Shipping\Logistics

        'view' => '',  // e.g. admin or admin/shipping or admin/shipping/logistics

        'api' => '',  // e.g. api/v1 or api/v2
    ],

    /*
    |--------------------------------------------------------------------------
    | Table Types
    |
    | Possible Options: blade, datatables
    |--------------------------------------------------------------------------
    |
    */

    'tables' => 'datatables',

    /*
    |--------------------------------------------------------------------------
    | Timestamp Fields
    |--------------------------------------------------------------------------
    |
    */

    'timestamps' => [

        'enabled'       => true,

        'created_at'    => 'created_at',

        'updated_at'    => 'updated_at',

        'deleted_at'    => 'deleted_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Specify custom doctrine mappings as per your need
    |--------------------------------------------------------------------------
    |
    */

    'from_table' => [

        'doctrine_mappings' => [],
    ],

];
