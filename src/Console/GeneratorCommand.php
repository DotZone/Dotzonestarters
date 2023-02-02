<?php

namespace DotZone\Dotzonestarters\Console;

use RuntimeException;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class GeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dotzonestarters:generate
                            {--composer=global : Absolute path to the Composer binary which should be used to install packages}
                            {--php_version=php : Php version command, like `sail` or `./vendor/bin/sail` or `docker-compose up...`}';

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
        $this->php_version = $this->option('php_version');
        
        $name = $this->components->ask('What is the name of the model?');

        // Validate the name
        if (!preg_match('/^[A-Za-z][A-Za-z0-9_]+$/', $name)) {
            throw new RuntimeException('The name of the model is invalid.');
        }

        // Check if the model already exists
        if (file_exists(app_path("Models/{$name}.php"))) {
            throw new RuntimeException('The model already exists.');
        }

        $view = $this->components->choice(
            'Do you want to generate a view?',
            ['yes', 'no'],
            0
        );

        $command = "{$this->php_version} artisan make:model {$name} -m";

        shell_exec($command);

        if ($view === 'yes') {
            $this->generateViews($name);
        }

        return 0;
    }


    /**
     * Generate Views for the given model.
     *
     * @return void
     */
    protected function generateViews($name)
    {
        $this->info('Converting stubs to blade templates...');
        // make new folder inside resources/views/manage/pages/$name
        (new Filesystem)->makeDirectory(resource_path("views/manage/pages/{$name}"), 0755, true);
        // Save the path
        $path = resource_path("views/manage/pages/{$name}");        
        // Check the default theme from the dotzone Config 
        $theme = config('dotzone.theme');
        // Get the views folder from resources/stubs/$theme/views
        $views = resource_path("../../resources/stubs/{$theme}/views");
        // Get all the files from the views folder
        $files = (new Filesystem)->allFiles($views);
        // Loop through the files and copy them to the new folder
        foreach ($files as $file) {
            // Get the file name
            $filename = $file->getFilename();
            // Get the file contents
            $contents = (new Filesystem)->get($file);
            // Replace the stubs with the correct values
            $contents = str_replace(
                ['{{name}}', '{{Name}}', '{{NAME}}', '{{names}}'],
                [$name, ucfirst($name), strtoupper($name), str_plural($name)],
                $contents
            );
            // Save the file to the new folder
            (new Filesystem)->put("{$path}/{$filename}", $contents);
        }
        // Create new index.js file in the public/manage/js/custom/{$name} folder
        (new Filesystem)->put(public_path("js/custom/{$name}/index.js"), '');

        $this->info('Views generated successfully!');
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
