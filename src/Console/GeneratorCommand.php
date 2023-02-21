<?php

namespace DotZone\Dotzonestarters\Console;

use DotZone\Dotzonestarters\Scaffold\ControllerGenerator;
use DotZone\Dotzonestarters\Console\BaseCommand;
use DotZone\Dotzonestarters\Scaffold\MenuGenerator;
use DotZone\Dotzonestarters\Scaffold\PermissionGenerator;
use DotZone\Dotzonestarters\Scaffold\RoutesGenerator;
use DotZone\Dotzonestarters\Scaffold\TranslationGenerator;
use DotZone\Dotzonestarters\Scaffold\ViewGenerator;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Illuminate\Support\Str;
use RuntimeException;

class GeneratorCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dotzone-starter:generate
                            {model : The name of the model}
                            {--composer=global : Absolute path to the Composer binary which should be used to install packages}
                            {--php_version=php : Php version command, like `sail` or `./vendor/bin/sail` or `docker-compose up...`}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new dotzone model with a migration, factory, resource, views and controller.';

    /**
     * The artisan command to run. Default is php.
     *
     * @var string
     */
    protected string $php_version;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        parent::handle();

        // Check if the package is installed or not
        if (!config('dotzone.cms.installed')) {
            $this->components->error('The package is not installed yet. Run `php artisan dotzonestarters:install` first.');
            return;
        }

        $this->php_version = $this->option('php_version');

        // Get the name of the model from the argument
        $name = Str::studly($this->argument('model'));

        // Validate the name
        if (!preg_match('/^[A-Za-z][A-Za-z0-9_]+$/', $name)) {
            $this->components->error('The name of the model is invalid.');
            return;
        }

        // Check if the model already exists
        if (file_exists(app_path("Models/{$name}.php"))) {
            $this->components->error('The model already exists.');
            // Show a question to the user to overwrite the model or not
            if (!$this->components->confirm('Do you want to overwrite the model?')) {
                return;
            }
            // Delete the model
            unlink(app_path("Models/{$name}.php"));
        }

        // Create the model
        $this->components->info('Creating model...');
        shell_exec("{$this->php_version} artisan make:model {$name} -m");
        // show the success message with check mark icon
        $this->components->info('Model created successfully.');

        // Create the store and update requests
        $this->components->info('Creating store requests...');
        shell_exec("{$this->php_version} artisan make:request Store{$name}Request");
        $this->components->info('Store request created successfully.');

        // Create the update request
        $this->components->info('Creating update request...');
        shell_exec("{$this->php_version} artisan make:request Update{$name}Request");
        $this->components->info('Update request created successfully.');


        // Generate the controller
        $controllerGenerator = new ControllerGenerator($this->config);
        $controllerGenerator->generate();

        // Generate the views
        $viewGenerator = new ViewGenerator($this->config);
        $viewGenerator->generate();
        $viewGenerator->generateJs();

        // Add the route
        $routeGenerator = new RoutesGenerator($this->config);
        $routeGenerator->generate();

        // Add the permissions
        $permissionsGenerator = new PermissionGenerator($this->config);
        $permissionsGenerator->generate();

        // Add the menu
        $menuGenerator = new MenuGenerator($this->config);
        $menuGenerator->generate();

        // Add the translations
        $translationsGenerator = new TranslationGenerator($this->config);
        $translationsGenerator->generate();

        return 0;
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array_merge(parent::getArguments(), []);
    }

    /**
     * Installs the given Composer Packages into the application.
     * Taken from https://github.com/laravel/breeze/blob/1.x/src/Console/InstallCommand.php
     *
     * @param mixed $packages
     * @return void
     */
    protected function requireComposerPackages($packages)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Update the "package.json" file.
     * Taken from https://github.com/laravel/breeze/blob/1.x/src/Console/InstallCommand.php
     *
     * @param callable $callback
     * @param bool $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (!file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
        );
    }

    /**
     * Run the given commands.
     * Taken from https://github.com/laravel/breeze/blob/1.x/src/Console/InstallCommand.php
     *
     * @param  array  $commands
     * @return void
     */
    protected function runCommands($commands)
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> '.$e->getMessage().PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    '.$line);
        });
    }
}
