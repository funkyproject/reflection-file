<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *
 * @category    PhpStorm
 * @author     aurelien
 * @copyright  2014 Efidev 
 * @version    CVS: Id:$
 */

namespace Funkyproject\Tests;


use Funkyproject\ReflectionFile;

class ReflectionFileTest extends \PHPUnit_Framework_TestCase
{
    public function testReflectionWithFileExistReturnAReflectionClassObject()
    {
        $reflectionFile = new ReflectionFile(__DIR__.'/Fake/FakeOne.php');

        $this->assertEquals('Funkyproject\Tests\Fake\FakeOne', $reflectionFile->getName());
    }

    public function testReflectionWithFileWhitoutNamespaceReturnAReflectionClassObject()
    {
        require __DIR__.'/Fake/FakeTwo.php';

        $reflectionFile = new ReflectionFile(__DIR__.'/Fake/FakeTwo.php');

        $this->assertEquals('FakeTwo', $reflectionFile->getName());
    }

    /**
     * @expectedException \ReflectionException
     */
    public function testReflectionWithFileWithoutClassThrowAnException()
    {
        new ReflectionFile(__DIR__.'/Fake/MissingClass.php');
    }

    /**
     * @expectedException \Funkyproject\Exceptions\FileNotFoundException
     */
    public function testReflectionWithoutFileThrowAnException()
    {
        new ReflectionFile(__DIR__.'/Fake/FakeThree.php');
    }
}
 