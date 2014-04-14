<?php
namespace Pushin\Bitrix\ModuleAutoloader\Tests\Mappers;

use Pushin\Bitrix\ModuleAutoloader\Mappers\StaticHardcodedMapper;
use Pushin\Bitrix\ModuleAutoloader\Tests\TestCase;

class StaticHardcodedMapperTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testGetModuleByClassName($module, $class)
    {
        $mapper = new StaticHardcodedMapper();
        $this->assertEquals($module, $mapper->getModuleByClassName($class));
    }

    public function provider()
    {
        return array(
            array('iblock', 'CIBlockElement'),
            array('iblock', 'CIBlockSection'),
            array('iblock', 'CIBlock'),
            array('catalog', 'CCatalogProduct'),
            array('catalog', 'CCatalogStore'),
            array('catalog', 'CCatalogGroup'),
            array('catalog', 'CPrice'),
            array('sale', 'CSaleOrder'),
            array('sale', 'CSaleOrderPropsValue'),
            array('sale', 'CSaleOrderProps'),
            array('search', 'CSearch'),
            array('search', 'CSearchTitle'),
            array('subscribe', 'CRubric'),
        );
    }

} 