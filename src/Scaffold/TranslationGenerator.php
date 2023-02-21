<?php

namespace DotZone\Dotzonestarters\Scaffold;

use DotZone\Dotzonestarters\Common\GeneratorConfig;
use Illuminate\Support\Str;
use DotZone\Dotzonestarters\Generators\BaseGenerator;

class TranslationGenerator extends BaseGenerator
{
    private string $langPath;
    public string $stubPath;

    public function __construct(GeneratorConfig $config)
    {
        $this->config = $config;
        $this->langPath = base_path('lang/en');
        $this->stubPath = config('dotzone.stubs.lang');
    }

    public function generate()
    {
        $this->config->commandInfo(dotzone_nl().'Adding Translation...');

        // Check if the lang folder exists
        if (!file_exists($this->langPath)) {
            $this->config->commandWarn('Folder not found: '.$this->langPath);
            return;
        }

        // Get the content of the lang/messages.php file
        $messages_file = $this->langPath.'/messages.php';
        $messages_content = get_filesystem()->getFile($messages_file);
        // Check if the translation already exists
        if (Str::contains($messages_content, $this->config->modelNames->name)) {
            $this->config->commandWarn('Translation already exists: '.$this->config->modelNames->name);
            return;
        }

        // Get the lang.stub's content
        $stub_content = get_filesystem()->getFile($this->stubPath);
        // Render the stub file
        $stub_content = str_replace(
            [
                '{{name}}',
                '{{Name}}',
                '{{NAME}}',
                '{{names}}',
                '{{Names}}',
            ],
            [
                $this->config->modelNames->name,
                $this->config->modelNames->capital,
                $this->config->modelNames->upper,
                $this->config->modelNames->plural,
                $this->config->modelNames->capitalPlural,
            ],
            $stub_content
        );
        // Add the translation to the messages.php file under the // New keys
        $messages_content = str_replace(
            '// New keys',
            '// New keys'.PHP_EOL.$stub_content,
            $messages_content
        );
        // Save the messages.php file
        get_filesystem()->createFile($messages_file, $messages_content);

        $this->config->commandInfo('Translation added successfully.');
    }

    public function rollback()
    {
        $this->config->commandInfo(dotzone_nl().'Removing Menu...');


        $this->config->commandInfo('Menu removed successfully.');
    }

}
