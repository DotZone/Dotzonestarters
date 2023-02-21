<?php

namespace DotZone\Dotzonestarters\Scaffold;

use DotZone\Dotzonestarters\Common\GeneratorConfig;
use Illuminate\Support\Str;
use DotZone\Dotzonestarters\Generators\BaseGenerator;

class MenuGenerator extends BaseGenerator
{
    private string $templatesPath;

    public function __construct(GeneratorConfig $config)
    {
        $this->config = $config;
        $this->templatesPath = config('dotzone.stubs.templates') . '' . config('dotzone.cms.template', 'metronic') . '/stubs';
    }

    public function generate()
    {
        $this->config->commandInfo(dotzone_nl().'Adding Menu...');

        // Find the menu.blade.php inside the views/manage/includes folder
        $menu_file = resource_path('views/manage/includes/menu.blade.php');
        // Check if the file exists
        if (!file_exists($menu_file)) {
            $this->config->commandWarn('File not found: '.$menu_file);
            return;
        }

        // Get the content of menu.stub file from the template folder
        $contents = get_filesystem()->getFile($this->templatesPath.'/menu.stub');
        // Replace the stubs with the correct values
        $contents = str_replace(
            ['{{name}}', '{{Name}}', '{{NAME}}', '{{names}}'],
            [$this->config->modelNames->name, $this->config->modelNames->capital, $this->config->modelNames->upper, $this->config->modelNames->plural],
            $contents
        );

        // Get the content of the menu.blade.php file
        $menu_content = get_filesystem()->getFile($menu_file);
        // Check if the menu item already exists
        if (Str::contains($menu_content, $this->config->modelNames->name)) {
            $this->config->commandWarn('Menu item already exists: '.$this->config->modelNames->name);
            return;
        }

        // Append the menu item to the menu.blade.php file
        $menu_content .= $contents;
        // Save the file
        get_filesystem()->createFile($menu_file, $menu_content);

        $this->config->commandInfo('Menu added successfully.');
    }

    public function rollback()
    {
        $this->config->commandInfo(dotzone_nl().'Removing Menu...');

        // Find the menu.blade.php inside the views/manage/includes folder
        $menu_file = resource_path('views/manage/includes/menu.blade.php');
        // Check if the file exists
        if (!file_exists($menu_file)) {
            $this->config->commandWarn('File not found: '.$menu_file);
            return;
        }

        // Get the content of the menu.blade.php file
        $menu_content = get_filesystem()->getFile($menu_file);
        // Check if the menu item already exists
        if (!Str::contains($menu_content, $this->config->modelNames->name)) {
            $this->config->commandWarn('Menu item not found: '.$this->config->modelNames->name);
            return;
        }

        // Get the content of menu.stub file from the template folder after replacing the stubs with the correct values
        $contents = str_replace(
            ['{{name}}', '{{Name}}', '{{NAME}}', '{{names}}'],
            [$this->config->modelNames->name, $this->config->modelNames->capital, $this->config->modelNames->upper, $this->config->modelNames->plural],
            get_filesystem()->getFile($this->templatesPath.'/menu.stub')
        );
        // Remove the menu item from the menu.blade.php file
        $menu_content = str_replace($contents, '', $menu_content);
        // Save the file
        get_filesystem()->createFile($menu_file, $menu_content);
        $this->config->commandInfo('Menu removed successfully.');
    }

}
