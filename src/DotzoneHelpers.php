<?php

use Illuminate\Support\Str;
use DotZone\Dotzonestarters\Common\FileSystem;


/**
 * this function is used to get the filesystem instance
 *
 * @return FileSystem
 **/
if (!function_exists('get_filesystem')) {
    /**
     * @return FileSystem
     */
    function get_filesystem()
    {
        return app(FileSystem::class);
    }
}

/**
 * this function is used to generate tab character(s)
 *
 * @param int $spaces
 * @return string
 **/
if (!function_exists('dotzone_tab')) {
    function dotzone_tab(int $spaces = 4): string
    {
        return str_repeat(' ', $spaces);
    }
}

/**
 * this function is used to generate tab character(s)
 *
 * @param int $tabs
 * @param int $spaces
 * @return string
 **/
if (!function_exists('dotzone_tabs')) {
    function dotzone_tabs(int $tabs, int $spaces = 4): string
    {
        return str_repeat(dotzone_tab($spaces), $tabs);
    }
}


/**
 * this function is used to generate new line character(s)
 *
 * @param int $count
 * @return string
 **/
if (!function_exists('dotzone_nl')) {
    function dotzone_nl(int $count = 1): string
    {
        return str_repeat(PHP_EOL, $count);
    }
}

/**
 * this function is used to generate new line character(s)
 *
 * @param int $count
 * @param int $nls
 * @return string
 **/
if (!function_exists('dotzone_nls')) {
    function dotzone_nls(int $count, int $nls = 1): string
    {
        return str_repeat(dotzone_nl($nls), $count);
    }
}

/**
 * this function is used to generate new line character(s) and tab character(s)
 *
 * @param int $lns
 * @param int $tabs
 * @return string
 **/
if (!function_exists('dotzone_nl_tab')) {
    function dotzone_nl_tab(int $lns = 1, int $tabs = 1): string
    {
        return dotzone_nls($lns).dotzone_tabs($tabs);
    }
}

/**
 * this function is used to get the model name from table name
 *
 * @param int $lns
 * @param int $tabs
 * @param int $spaces
 * @return string
 **/
if (!function_exists('model_name_from_table_name')) {
    function model_name_from_table_name(string $tableName): string
    {
        return Str::ucfirst(Str::camel(Str::singular($tableName)));
    }
}

/**
 * this function is used to create resource route names
 *
 * @param int $lns
 * @param int $tabs
 * @param int $spaces
 * @return string
 **/
if (!function_exists('create_resource_route_names')) {
    function create_resource_route_names($name, $isScaffold = false): array
    {
        $result = [
            "'index' => '$name.index'",
            "'store' => '$name.store'",
            "'show' => '$name.show'",
            "'update' => '$name.update'",
            "'destroy' => '$name.destroy'",
        ];

        if ($isScaffold) {
            $result[] = "'create' => '$name.create'";
            $result[] = "'edit' => '$name.edit'";
        }

        return $result;
    }
}
