<?php
namespace Pushin\Bitrix\ModuleAutoloader\Mappers;

class StaticHardcodedMapper extends AbstractMapper
{
    protected function getBaseMap()
    {
        return $this->normalizeMap(array(
            'iblock' => 'CIBlock CIBlockElement CIBlockSection',
            'catalog' => 'CCatalogProduct CCatalogStore CCatalogGroup CCatalogStoreProduct CCatalogProduct CPrice',
            'sale' => 'CSaleOrder CSaleOrderPropsValue CSaleBasket CSaleStatus CSaleOrderProps',
            'search' => 'CSearch CSearchTitle CSearchLanguage',
            'subscribe' => 'CRubric',
        ));
    }
} 