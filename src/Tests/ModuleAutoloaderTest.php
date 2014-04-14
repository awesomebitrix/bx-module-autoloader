<?php
namespace Pushin\Bitrix\ModuleAutoloader\Tests;

//use Pushin\Bitrix\ModuleAutoloader\ModuleAutoloader;

use Pushin\Bitrix\ModuleAutoloader\Mappers\StaticHardcodedMapper;
use Pushin\Bitrix\ModuleAutoloader\ModuleAutoloader;
use CIBlockElement;
use CModule;

class ModuleAutoloaderTest extends TestCase
{

    /**
     * @runInSeparateProcess
     */
    public function testAutoloaderInactionWhenModuleLoaded()
    {
        $mapper = $this->getMock('\Pushin\Bitrix\ModuleAutoloader\Mappers\StaticHardcodedMapper');
        $mapper
            ->expects($this->any())
            ->method('getModuleByClassName')
            ->will($this->returnValue('iblock'))
        ;

        $loader = $this->getMock('Pushin\Bitrix\ModuleAutoloader\ModuleAutoloader', array('autoload'), array($mapper));
        $autoloadInvoked = false;
        $loader->expects($this->any())->method('autoload')->will($this->returnCallback(function() use (&$autoloadInvoked) {
            $autoloadInvoked = true;
        }));
        $loader->register();

        CModule::IncludeModule('iblock');

        new CIBlockElement();

        $this->assertFalse($autoloadInvoked);
    }

    /**
     * @runInSeparateProcess
     */
    public function testAutoload()
    {
        $this->assertFalse(class_exists('\CIBlockElement'));

        $mapper = $this->getMock('\Pushin\Bitrix\ModuleAutoloader\Mappers\StaticHardcodedMapper');

        $mapper
            ->expects($this->any())
            ->method('getModuleByClassName')
            ->will($this->returnValue('iblock'))
        ;

        $loader = new ModuleAutoloader($mapper);
        $loader->register();

        new CIBlockElement();

        $this->assertTrue(class_exists('\CIBlockElement'));

    }

    /**
     * @runInSeparateProcess
     */
    public function testRegister()
    {
        $mapper = new StaticHardcodedMapper();

        $loader = $this->getMock('Pushin\Bitrix\ModuleAutoloader\ModuleAutoloader', array('autoload'), array($mapper));
        $autoloadInvoked = false;
        $loader->expects($this->once())->method('autoload')->will($this->returnCallback(function() use (&$autoloadInvoked) {
            $autoloadInvoked = true;
        }));
        $loader->register();

        spl_autoload_register(function($className) {
            throw new \Exception('Ok');
        });

        try {
            new SomeNonexistClass();
        }
        catch(\Exception $e) {

        }

        $this->assertTrue($autoloadInvoked);
    }
} 