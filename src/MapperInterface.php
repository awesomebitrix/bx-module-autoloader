<?php
namespace Pushin\Bitrix\ModuleAutoloader;

interface MapperInterface
{
    public function getModuleByClassName($className);
}