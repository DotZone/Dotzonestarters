<?php

namespace DotZone\Dotzonestarters\Scaffold;

use DotZone\Dotzonestarters\Generators\BaseGenerator;
use DotZone\Dotzonestarters\Common\GeneratorConfig;

class PermissionGenerator extends BaseGenerator
{

    public function __construct(GeneratorConfig $config)
    {
        $this->config = $config;
    }

    public function generate()
    {
        try {

            // Check if the permission flag is set to false
            if (config('dotzone.cms.role_permission') == false) {
                $this->config->commandWarn(dotzone_nl().'Permission flag is set to false, Skipping Adjustment.');
                return;
            }

            $this->config->commandInfo(dotzone_nl().'Generating Permission...');

            $seedersFilePath = config_path('laratrust_seeder.php');
            if (!file_exists($seedersFilePath)) {
                $this->config->commandInfo(dotzone_nl().'Permission file does not exist, Skipping Adjustment.');
                return;
            }
            $content = get_filesystem()->getFile($seedersFilePath);
            // Find the 'profile' => 'r,u' line and add the new permission after it
            $newPermission = "        '".$this->config->modelNames->dashedPlural."' => 'c,r,u,d',";
            // Check if the permission already exists
            if (strpos($content, $newPermission) !== false) {
                $this->config->commandWarn(dotzone_nl().'Permission already exists, Skipping Adjustment.');
                return;
            }
            $content = str_replace("'profile' => 'r,u',", "'profile' => 'r,u'," . dotzone_nl() . $newPermission, $content);
            // Save the file
            get_filesystem()->createFile($seedersFilePath, $content);
            // Show the Success message
            $this->config->commandInfo(dotzone_nl().'Permission generated.');
            // Show a warning message to not forget to run the seeder
            $this->config->commandInfo(dotzone_nl().'Please run the seeder to add the new permission to the database.');
        } catch (\Throwable $th) {
            // Rollback
            $this->rollback();
            throw $th;
        }
    }

    public function rollback()
    {
        $this->config->commandInfo(dotzone_nl().'Rollback Permissions...');
        $baseRoutePath = config_path('laratrust_seeder.php');
        if (!file_exists($baseRoutePath)) {
            $this->config->commandInfo(dotzone_nl().'Permission file does not exist, Skipping Adjustment.');
            return;
        }
        $routeContents = get_filesystem()->getFile($baseRoutePath);
        // Find the 'profile' => 'r,u' line and add the new permission after it
        $newPermission = "        '".$this->config->modelNames->dashedPlural."' => 'c,r,u,d',";
        $routeContents = str_replace($newPermission, '', $routeContents);
        // Save the file
        get_filesystem()->createFile($baseRoutePath, $routeContents);
        // Show the Success message
        $this->config->commandInfo(dotzone_nl().$this->config->modelNames->dashedPlural.' permissions removed.');
    }
}
