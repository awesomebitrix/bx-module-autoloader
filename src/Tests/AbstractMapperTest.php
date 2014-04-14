<?php
namespace Pushin\Bitrix\ModuleAutoloader\Tests;

class AbstractMapperTest extends TestCase
{

    public function testMergeMap()
    {
        $mapper = $this->createAbstractMapper(array(
            'CTest' => 'test',
            'CTestSecond' => 'test',
            'CSomeClass' => 'SomeModule',
            'CYetAnotherClass' => 'SomeModule',
        ));
        $mapper->mergeMap(array(
            'merge' => 'CMerge CMergeTwo',
            'test' => 'CMergeTest'
        ));
        $mapper->mergeMap(array(
            'merge2' => 'CMerge2 CMergeTwo2',
            'test' => 'CMergeTest2',
            'CTestModule' => 'CTest',
        ));

        $this->assertEquals('CTestModule', $mapper->getModuleByClassName('CTest'));
        $this->assertEquals('test', $mapper->getModuleByClassName('CTestSecond'));
        $this->assertEquals('SomeModule', $mapper->getModuleByClassName('CSomeClass'));
        $this->assertEquals('merge', $mapper->getModuleByClassName('CMergeTwo'));
        $this->assertEquals('merge', $mapper->getModuleByClassName('CMerge'));
        $this->assertEquals('test', $mapper->getModuleByClassName('CMergeTest'));
        $this->assertEquals('merge2', $mapper->getModuleByClassName('CMerge2'));
        $this->assertEquals('merge2', $mapper->getModuleByClassName('CMergeTwo2'));
        $this->assertEquals('test', $mapper->getModuleByClassName('CMergeTest2'));
    }

    /**
     * @dataProvider providerMergeMap
     */
    public function testGetModuleFromMergeMap($expected, $map, $className)
    {
        $mapper = $this->createAbstractMapper(null);
        $mapper->mergeMap($map);
        $this->assertEquals($expected, $mapper->getModuleByClassName($className));
    }

    public function providerMergeMap()
    {
        $fullMap = array(
            'test' => 'CTest CTestMain SomeTestNamespace\CTest CTestExtended',
            'text' => 'CText CTextMain SomeTextNamespace\CTest CTextExtended',
            'another' => 'AnotherClass   WrongFormatNamespace\Write_Example\SomeSubNamespace  TrailingClassName'
        );

        return array(
            array(null, null, 'CText'),
            array(null, array('test' => 'CTest'), 'CText'),
            array('test', array('test' => 'CTest'), 'CTest'),
            array('test', $fullMap, 'CTest'),
            array('test', $fullMap, 'CTestMain'),
            array('text', $fullMap, 'SomeTextNamespace\CTest'),
            array('another', $fullMap, 'WrongFormatNamespace\Write_Example\SomeSubNamespace'),
            array(null, $fullMap, 'WrongFormatNamespace\Write_Example'),
            array(null, $fullMap, ''),
        );
    }

    /**
     * @dataProvider providerBaseMap
     */
    public function testGetModuleFromBaseMap($expected, $map, $className)
    {
        $this->assertEquals($expected, $this->createAbstractMapper($map)->getModuleByClassName($className));
    }

    public function providerBaseMap()
    {
        return array(
            array(null, null, 'CText'),
            array(null, array('CTest' => 'test'), 'CText'),
            array('test', array('CTest' => 'test'), 'CTest'),
            array('text', array('CTest' => 'test', 'CText' => 'text'), 'CText'),
        );
    }

    protected function createAbstractMapper($baseMap)
    {
        $abstractMapper = $this->getMockForAbstractClass(
            '\Pushin\Bitrix\ModuleAutoloader\AbstractMapper',
            array(),
            '',
            true,
            true,
            true,
            array('getBaseMap')
        );

        $abstractMapper->expects($this->any())->method('getBaseMap')->will($this->returnValue($baseMap));

        return $abstractMapper;
    }

} 