<?php
namespace Pushin\Bitrix\ModuleAutoloader;

use CModule;

class ModuleAutoloader
{
    protected $mapper;

    public function __construct(MapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    public function autoload($className)
    {
        $module = $this->mapper->getModuleByClassName($className);
        if (!$module) return;

        CModule::IncludeModule($module);
        CModule::RequireAutoloadClass($className);
    }
} 