<?php

namespace DotZone\Dotzonestarters\Console;

use DotZone\Dotzonestarters\Common\GeneratorConfig;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Composer;
use Illuminate\Console\Command;

class BaseCommand extends Command
{
    public GeneratorConfig $config;

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle()
    {
        try {
            $this->config = app(GeneratorConfig::class);
            $this->config->setCommand($this);
            $this->config->setComponents($this->components);
            $this->config->init();
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['model', InputArgument::REQUIRED, 'Singular Model name'],
        ];
    }
}
