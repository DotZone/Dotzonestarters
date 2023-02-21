<?php

namespace DotZone\Dotzonestarters\Scaffold;

use DotZone\Dotzonestarters\Common\GeneratorConfig;
use DotZone\Dotzonestarters\Generators\BaseGenerator;

class ControllerGenerator extends BaseGenerator
{

    public string $managePath;
    public string $fileName;
    public string $stubPath;


    public function __construct(GeneratorConfig $config)
    {
        $this->config = $config;
        $this->managePath = config('dotzone.path.manage_controller');
        $this->stubPath = config('dotzone.stubs.controller');
        $this->fileName = $this->config->modelNames->capital.'Controller.php';
    }

    public function generate()
    {
        try {

            // Show the Generating Controller message
            $this->config->commandInfo(dotzone_nl().'Generating Controller...');
            // Check if the folder exists
            get_filesystem()->createDirectoryIfNotExist($this->managePath);
            // Get the stub file content
            $stub_content = get_filesystem()->getFile($this->stubPath);
            // Render the stub file
            $stub_content = str_replace(
                [
                    '{{name}}',
                    '{{Name}}',
                    '{{NAME}}',
                    '{{names}}'
                ],
                [
                    $this->config->modelNames->name,
                    $this->config->modelNames->capital,
                    $this->config->modelNames->upper,
                    $this->config->modelNames->plural
                ],
                $stub_content
            );
            // Check if the file exists
            if (file_exists($this->managePath.'/'.$this->fileName)) {
                $this->config->commandWarn('File already exists: '.$this->fileName);
                return;
            }
            // Create the file
            get_filesystem()->createFile($this->managePath . '/' . $this->fileName, $stub_content);
            // Show the Generating Controller message
            $this->config->commandInfo('Controller created: ' . $this->fileName);
        } catch (\Throwable $th) {
            // Rollback
            $this->rollback();
            throw $th;
        }
    }

    public function rollback()
    {
        try {
            // Show the Generating Controller message
            $this->config->commandInfo('Rolling back Controller...');
            // Get the file name
            $file_name = $this->config->modelNames->upper.'Controller.php';
            // Delete the file
            get_filesystem()->deleteFile($this->managePath, $file_name);
            // Show the Generating Controller message
            $this->config->commandInfo(' Controller rolled back successfully.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
