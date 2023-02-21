<?php

namespace DotZone\Dotzonestarters\Scaffold;

use DotZone\Dotzonestarters\Generators\BaseGenerator;
use DotZone\Dotzonestarters\Common\GeneratorConfig;
use Illuminate\Support\Str;

class RoutesGenerator extends BaseGenerator
{

    public function __construct(GeneratorConfig $config)
    {
        $this->config = $config;
    }

    public function generate()
    {
        try {
            $this->config->commandInfo(dotzone_nl().'Generating Routes...');
            $controllerName = $this->config->modelNames->capital.'Controller::class';
            // Locate the // Addition routes comment in the routes/web.php file
            $baseRoutePath = config('dotzone.path.routes');
            $routeContents = get_filesystem()->getFile($baseRoutePath);
            // Create the new route
            $newRoute = "    Route::resource('".$this->config->modelNames->dashedPlural."', ".$controllerName.");";
            // Check if the route already exists
            if (Str::contains($routeContents, $newRoute)) {
                $this->config->commandWarn(dotzone_nl().'Route '.$this->config->modelNames->dashedPlural.' already exists, Skipping Adjustment.');
                return;
            }
            $routeContents = str_replace('// Addition routes', '// Addition routes'.dotzone_nl().$newRoute, $routeContents);
            // Save the file
            get_filesystem()->createFile($baseRoutePath, $routeContents);
            // Show the Success message
            $this->config->commandInfo(dotzone_nl().$this->config->modelNames->dashedPlural.' routes added.');
        } catch (\Throwable $th) {
            // Rollback
            $this->rollback();
            throw $th;
        }
    }

    public function rollback()
    {
        $this->config->commandInfo(dotzone_nl().'Rollback Routes...');
        $controllerName = $this->config->modelNames->capital.'Controller::class';
        // Locate the // Addition routes comment in the routes/web.php file
        $baseRoutePath = config('dotzone.path.routes');
        $routeContents = get_filesystem()->getFile($baseRoutePath);
        // Create the new route
        $newRoute = "    Route::resource('".$this->config->modelNames->dashedPlural."', ".$controllerName.");";
        // Check if the route already exists
        if (!Str::contains($routeContents, $newRoute)) {
            $this->config->commandInfo(dotzone_nl().'Route '.$this->config->modelNames->dashedPlural.' does not exist, Skipping Adjustment.');
            return;
        }
        $routeContents = str_replace($newRoute, '', $routeContents);
        // Save the file
        get_filesystem()->createFile($baseRoutePath, $routeContents);
        // Show the Success message
        $this->config->commandInfo(dotzone_nl().$this->config->modelNames->dashedPlural.' routes removed.');
    }
}
