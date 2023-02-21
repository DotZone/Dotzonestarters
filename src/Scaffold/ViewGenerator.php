<?php

namespace DotZone\Dotzonestarters\Scaffold;

use DotZone\Dotzonestarters\Common\GeneratorConfig;
use DotZone\Dotzonestarters\Generators\BaseGenerator;

class ViewGenerator extends BaseGenerator
{
    private string $templatesPath;
    private string $resourceViewPath;
    private string $publicJsFilePath;

    public function __construct(GeneratorConfig $config)
    {
        $this->config = $config;

        $this->templatesPath = config('dotzone.stubs.templates') . '' . config('dotzone.cms.template', 'metronic') . '/stubs';

        $this->resourceViewPath = resource_path('views/manage/pages/'.$this->config->modelNames->plural);
        $this->publicJsFilePath = public_path("/manage/js/custom/{$this->config->modelNames->name}/index.js");
    }

    public function generate()
    {
        $this->config->commandInfo(dotzone_nl().'Generating Views...');

        // Check if the folder exists
        get_filesystem()->createDirectoryIfNotExist($this->resourceViewPath);
        // Get the files in the template folder
        $files = get_filesystem()->getFiles($this->templatesPath.'/views');
        // Loop through the files and replace the placeholders with the actual values and create the files in the resource folder
        foreach ($files as $file) {

            if ($file == '.' || $file == '..') {
                continue;
            }

            // Check if the file exists
            if (file_exists($this->resourceViewPath.'/'.$file)) {
                $this->config->commandWarn('File already exists: '. '/manage/pages/'.$this->config->modelNames->plural.'/'.$file);
                continue;
            }
            $stub_content = get_filesystem()->getFile($this->templatesPath.'/views/'.$file);
            $stub_content = str_replace(
                [
                    '{{name}}',
                    '{{Name}}',
                    '{{NAME}}',
                    '{{names}}',
                ],
                [
                    $this->config->modelNames->name,
                    $this->config->modelNames->capital,
                    $this->config->modelNames->upper,
                    $this->config->modelNames->plural,
                ],
                $stub_content
            );

            // Create the file
            get_filesystem()->createFile($this->resourceViewPath.'/'.$file, $stub_content);
        }
        $this->config->commandInfo('Views created');
    }

    public function generateJs()
    {
        $this->config->commandInfo(dotzone_nl().'Generating JS...');

        // Check if the folder exists
        get_filesystem()->createDirectoryIfNotExist($this->resourceViewPath);
        // Get the file in the template folder
        $file = get_filesystem()->getFile($this->templatesPath . '/js/index.js');
        // Check if the file exists
        if (file_exists($this->publicJsFilePath)) {
            $this->config->commandWarn('File already exists: '.$this->publicJsFilePath);
            return;
        }
        // Replace the placeholders with the actual values and create the files in the resource folder
        $stub_content = str_replace(
            [
                '{{name}}',
                '{{Name}}',
                '{{NAME}}',
                '{{names}}',
            ],
            [
                $this->config->modelNames->name,
                $this->config->modelNames->capital,
                $this->config->modelNames->upper,
                $this->config->modelNames->plural,
            ],
            $file
        );
        get_filesystem()->createFile($this->publicJsFilePath, $stub_content);

        $this->config->commandInfo('Javascript File created');
    }

    public function rollback($views = [])
    {
        if (empty($views)) {
            $views = get_filesystem()->getFiles($this->resourceViewPath);
        }
        foreach ($views as $view) {
            if ($view == '.' || $view == '..') {
                continue;
            }
            $this->rollbackFile($this->resourceViewPath, $view);
        }

        $this->rollbackFile($this->publicJsFilePath, $this->config->modelNames->plural . '.js');

        $this->config->commandInfo('Views deleted');
    }
}
