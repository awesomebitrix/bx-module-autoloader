<?php
namespace Pushin\Bitrix\ModuleAutoloader\Mappers;

use Pushin\Bitrix\ModuleAutoloader\MapperInterface;

class StaticHardcodedMapper implements MapperInterface
{
    protected $mapping;

    public function getModuleByClassName($className)
    {
        $mapping = $this->getMapping();

        return isset($mapping[$className]) ? $mapping[$className] : null;
    }

    protected function getMapping()
    {
        if (null === $this->mapping) {
            $this->mapping = array();
            foreach($this->getMappingSource() as $module => $classes) {
                foreach(explode(' ', $classes) as $class) $this->mapping[$class] = $module;
            }

        }
        return $this->mapping;
    }

    protected function getMappingSource()
    {
        return array(
            'iblock' => 'CIBlock CIBlockElement CIBlockSection',
            'catalog' => 'CCatalogProduct CCatalogStore CCatalogGroup CCatalogStoreProduct CCatalogProduct CPrice',
            'sale' => 'CSaleOrder CSaleOrderPropsValue CSaleBasket CSaleStatus CSaleOrderProps',
            'search' => 'CSearch CSearchTitle CSearchLanguage',
            'subscribe' => 'CRubric',
        );
    }
} 