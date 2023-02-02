<?php

namespace DotZone\Dotzonestarters\Console;

use RuntimeException;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dotzonestarters:install
                            {--composer=global : Absolute path to the Composer binary which should be used to install packages}
                            {--php_version=php : Php version command, like `sail` or `./vendor/bin/sail` or `docker-compose up...`}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install one of the DotzoneStarter Themes';

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
        
        $theme = $this->components->choice(
            'Which design theme you want to use?',
            ['metronic'],
            0
        );

        $role_permissions = $this->components->choice(
            'Do you want to add role permissions?',
            ['yes', 'no'],
            1
        );

        $this->requireComposerPackages('laravel/ui:^4.0');
        shell_exec("{$this->php_version} artisan ui bootstrap --auth");


        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__ . '/../../resources/stubs/routes.stub'),
            FILE_APPEND
        );

        // Move the config/dotzone.php file to the config folder
        copy(__DIR__ . '/../../config/dotzone.php', config_path('dotzone.php'));


        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/controllers', app_path('Http/Controllers/'));

        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/requests', app_path('Http/Requests/'));

        copy(__DIR__ . '/../../resources/stubs/ui/AppServiceProvider.php', app_path('Providers/AppServiceProvider.php'));
        copy(__DIR__ . '/../../resources/stubs/ui/vite.config.js', base_path('vite.config.js'));


        if ($role_permissions === 'yes') {
            $this->installLaratrust();
        }

        if ($theme === 'metronic') {
            $this->replaceWithMetronicTheme();
        }

        return 0;
    }

    protected function replaceWithMetronicTheme()
    {

        $this->components->info('Installing Metronic Theme');
        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/auth'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/auth/passwords'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/layouts'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/includes'));

        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/ui/metronic/views/auth', resource_path('views/auth'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/ui/metronic/views/auth/passwords', resource_path('views/auth/passwords'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/ui/metronic/views/layouts', resource_path('views/layouts'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/ui/metronic/views/includes', resource_path('views/includes'));

        // Assets
        (new Filesystem)->ensureDirectoryExists(resource_path('js'));
        (new Filesystem)->ensureDirectoryExists(public_path('css'));
        (new Filesystem)->ensureDirectoryExists(public_path('js'));
        (new Filesystem)->ensureDirectoryExists(public_path('images'));

        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/ui/metronic/css', public_path('css'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/ui/metronic/js', public_path('js'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/ui/metronic/images', public_path('images'));

        copy(__DIR__ . '/../../resources/stubs/ui/metronic/views/home.blade.php', resource_path('views/home.blade.php'));
        copy(__DIR__ . '/../../resources/stubs/ui/metronic/views/dashboard.blade.php', resource_path('views/dashboard.blade.php'));

        // Demo table
        (new Filesystem)->ensureDirectoryExists(resource_path('views/users'));
        copy(__DIR__ . '/../../resources/stubs/ui/metronic/views/users/index.blade.php', resource_path('views/users/index.blade.php'));

        // $this->runCommands(['npm install', 'npm run build']);
        $this->components->info('Dotzone UI scaffolding replaced successfully.');
    }

    protected function installLaratrust()
    {
        $this->components->info('Installing Laratrust...');

        $this->requireComposerPackages('santigarcor/laratrust');
        shell_exec("{$this->php_version} artisan vendor:publish --provider=\"Santigarcor\Laratrust\LaratrustServiceProvider\"");
        shell_exec("{$this->php_version} artisan laratrust:setup");
        shell_exec("{$this->php_version} artisan laratrust:seeder");
        shell_exec("{$this->php_version} artisan vendor:publish --tag=\"laratrust-seeder\"");
        shell_exec("{$this->php_version} artisan migrate");

        $this->components->info('Laratrust installed successfully.');
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
