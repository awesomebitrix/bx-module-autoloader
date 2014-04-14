<?php
namespace Pushin\Bitrix\ModuleAutoloader;

abstract class AbstractMapper implements MapperInterface
{
    protected $map;

    protected $mergeMap;

    protected $baseMap;

    public function getModuleByClassName($className)
    {
        $map = $this->getMap();
        return isset($map[$className]) ? $map[$className] : null;
    }

    public function mergeMap($map)
    {
        $this->resetMap();
        $this->mergeMap = array_merge((array) $this->mergeMap, $this->normalizeMap($map));
    }

    protected function resetMap()
    {
        $this->map = null;
    }

    protected function getMap()
    {
        if (null === $this->map) {
            $this->map = $this->buildMap();
        }
        return $this->map;
    }

    protected function buildMap()
    {
        return array_merge((array) $this->getBaseMap(), (array) $this->mergeMap);
    }

    abstract protected function getBaseMap();

    protected function normalizeMap($map)
    {
        $normalMap = array();
        foreach($map as $module => $classes) {
            foreach(array_filter(explode(' ', $classes)) as $class) $normalMap[$class] = $module;
        }
        return $normalMap;
    }

} 