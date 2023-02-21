<?php

namespace DotZone\Dotzonestarters\Common;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use DotZone\Dotzonestarters\DTOs\ModelNames;
use Illuminate\Console\View\Components\Factory;

class GeneratorConfig
{
    public ModelNames $modelNames;
    public Command $command;
    public Factory $components;
    public string $templateType;

    public function init()
    {
        $this->loadModelNames();
        $this->loadTemplateType();
    }

    public function setCommand(Command &$command)
    {
        $this->command = &$command;
    }

    public function setComponents(Factory &$components)
    {
        $this->components = &$components;
    }

    public function loadModelNames()
    {
        $modelNames = new ModelNames();
        $name = $this->command->argument('model');
        if ($name === null) {
            $this->commandError('Model name is required');
            exit;
        }
        $modelNames->name = Str::lower($name);
        $modelNames->plural = Str::plural($modelNames->name);
        $modelNames->camel = Str::camel($modelNames->name);
        $modelNames->camelPlural = Str::camel($modelNames->plural);
        $modelNames->snake = Str::snake($modelNames->name);
        $modelNames->snakePlural = Str::snake($modelNames->plural);
        $modelNames->dashed = Str::kebab($modelNames->name);
        $modelNames->dashedPlural = Str::kebab($modelNames->plural);
        $modelNames->human = Str::title(str_replace('_', ' ', $modelNames->snake));
        $modelNames->humanPlural = Str::title(str_replace('_', ' ', $modelNames->snakePlural));
        $modelNames->upper = strtoupper($modelNames->name);
        $modelNames->upperPlural = strtoupper($modelNames->plural);
        $modelNames->capital = ucfirst($modelNames->name);
        $modelNames->capitalPlural = ucfirst($modelNames->plural);

        $this->modelNames = $modelNames;
    }

    public function loadTemplateType()
    {
        $this->templateType = config('dotzone.cms.template');
    }

    public function getTemplate($template)
    {
        $templatePath = config('dotzonestarters.path.templates').'/'.$this->templateType.'/'.$template.'.stub';

        if (!file_exists($templatePath)) {
            $this->command->error('Template not found: '.$templatePath);
            exit;
        }

        return file_get_contents($templatePath);
    }

    public function getOption($option)
    {
        return $this->command->option($option);
    }

    public function commandError($error)
    {
        $this->components->error($error);
    }

    public function commandWarn($warning)
    {
        $this->components->warn($warning);
    }

    public function commandInfo($message)
    {
        $this->components->info($message);
    }
}
