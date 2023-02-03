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
        try {
            $this->php_version = $this->option('php_version');
            $this->installDotzoneStarter();
        } catch (RuntimeException $e) {
            $this->components->error($e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Install the DotzoneStarter.
     *
     * @return void
     */
    protected function installDotzoneStarter()
    {
        // Ask for the Theme installation
        $theme = $this->components->choice(
            'Which design theme you want to use?',
            ['metronic'],
            0
        );
        // Ask for the Role Permissions installation
        $role_permissions = $this->components->choice(
            'Do you want to add role permissions?',
            ['yes', 'no'],
            1
        );
        // Install the required packages
        $this->requireComposerPackages('laravel/ui:^4.0');
        shell_exec("{$this->php_version} artisan ui bootstrap --auth");
        $this->requireComposerPackages('yajra/laravel-datatables-oracle');

        // Copy the routes file to the routes folder
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__ . '/../../resources/stubs/routes.stub'),
            FILE_APPEND
        );
        // Copy the Controllers folder to the app/Http folder
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/controllers', app_path('Http/Controllers/'));
        // Copy the AppServiceProvider.php file to the app/Providers folder
        copy(__DIR__ . '/../../resources/ui/AppServiceProvider.php', app_path('Providers/AppServiceProvider.php'));
        // Copy the vite.config.js file to the root folder
        copy(__DIR__ . '/../../resources/ui/vite.config.js', base_path('vite.config.js'));
        // Overwrite the default RouteServiceProvider.php file
        $this->overwriteServiceProviders();
        // Check if the user wants to install Laratrust
        if ($role_permissions === 'yes') $this->installLaratrust();
        // Check if the user wants to install Metronic Theme
        if ($theme === 'metronic') $this->replaceWithMetronicTheme();
        // Update the config/dotzone.php file to set the installed flag to true
        $this->updateDotzoneConfig($role_permissions);
        // Move the config/dotzone.php file to the config folder
        copy(__DIR__ . '/../../config/dotzone.php', config_path('dotzone.php'));
    }

    /**
     * Install the metronic theme.
     *
     * @param  string  $packages
     * @return void
     */
    protected function replaceWithMetronicTheme()
    {

        $this->components->info('Installing Metronic Theme');
        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/manage/auth'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/manage/auth/passwords'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/manage/layouts'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/manage/includes'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/front'));

        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/ui/metronic/views/manage/auth', resource_path('views/manage/auth'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/ui/metronic/views/manage/auth/passwords', resource_path('views/manage/auth/passwords'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/ui/metronic/views/manage/layouts', resource_path('views/manage/layouts'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/ui/metronic/views/manage/includes', resource_path('views/manage/includes'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/ui/metronic/views/front', resource_path('views/front'));

        // Assets
        (new Filesystem)->ensureDirectoryExists(resource_path('manage/js'));
        (new Filesystem)->ensureDirectoryExists(public_path('manage/css'));
        (new Filesystem)->ensureDirectoryExists(public_path('manage/js'));
        (new Filesystem)->ensureDirectoryExists(public_path('manage/images'));

        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/ui/metronic/manage/css', public_path('manage/css'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/ui/metronic/manage/js', public_path('manage/js'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/ui/metronic/manage/images', public_path('manage/images'));

        copy(__DIR__ . '/../../resources/ui/metronic/views/manage/home.blade.php', resource_path('views/manage/home.blade.php'));
        copy(__DIR__ . '/../../resources/ui/metronic/views/manage/dashboard.blade.php', resource_path('views/manage/dashboard.blade.php'));

        // Demo table
        (new Filesystem)->ensureDirectoryExists(resource_path('views/manage/pages/users'));
        copy(__DIR__ . '/../../resources/ui/metronic/views/manage/pages/users/index.blade.php', resource_path('views/manage/pages/users/index.blade.php'));

        // $this->runCommands(['npm install', 'npm run build']);
        $this->components->info('Dotzone UI scaffolding replaced successfully.');
    }

    /**
     * Install the laratrust package.
     *
     * @param  string  $packages
     * @return void
     */
    protected function installLaratrust()
    {
        $this->components->info('Installing Laratrust...');

        try {
            $this->requireComposerPackages('santigarcor/laratrust');
            // wait for the package to be installed
            sleep(5);
            shell_exec("{$this->php_version} artisan vendor:publish --provider=\"Santigarcor\Laratrust\LaratrustServiceProvider\"");
            $this->components->info('Laratrust setup successfully. Please press enter to continue.');
            shell_exec("{$this->php_version} artisan laratrust:setup");
            shell_exec("{$this->php_version} artisan laratrust:seeder");
            shell_exec("{$this->php_version} artisan vendor:publish --tag=\"laratrust-seeder\"");
        } catch (\Exception $e) {
            $this->components->error('Laratrust installation failed.');
            $this->components->error($e->getMessage());
            return;
        }
        $this->components->info('Laratrust installed successfully.');
        $this->components->info('Please run php artisan migrate.');
    }

    /**
     * Overwrite the default RouteServiceProvider.php file.
     *
     * @return void
     */
    protected function overwriteServiceProviders()
    {
        $this->components->info('Overwriting Dotzone config file...');
        // Overwrite the RouteServiceProvider
        $routeProvider = file_get_contents(app_path('Providers/RouteServiceProvider.php'));
        $config = str_replace(['/home'],['/dashboard'],$routeProvider);
        file_put_contents(app_path('Providers/RouteServiceProvider.php'), $config);
        $this->components->info('Dotzone config file overwritten successfully.');
    }

    /**
     * Update the config/dotzone.php file to set the installed flag to true.
     *
     * @param  string  $role_permissions
     * @return void
     */
    protected function updateDotzoneConfig($role_permissions)
    {
        $this->components->info('Updating Dotzone config file...');

        // Update the config/dotzone.php file to set the installed flag to true
        $dotzoneConfig = file_get_contents(config_path('dotzone.php'));

        $config = str_replace(['\'installed\' => false'],['\'installed\' => true'],$dotzoneConfig);
        if ($role_permissions === 'yes') {
            $config = str_replace(['\'role_permission\' => false'],['\'role_permission\' => true'],$config);
        }
        file_put_contents(config_path('dotzone.php'), $config);

        $this->components->info('Dotzone config file updated successfully.');
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
