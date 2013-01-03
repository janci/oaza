<?php
namespace Oaza\Application\Adapter\Drivers\DummyDriver\TranslateRepository;

use \Oaza\Application\Adapter\Drivers\DummyDriver\DummyDriver,
    \Oaza\Application\Adapter\Entities\TranslateEntity;
/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-11-20 at 01:29:49.
 */
class TranslateEntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TranslateEntity
     */
    protected $object;

    /**
     * @var TranslateEntity
     */
    protected $object2;

    /**
     * @var TranslateEntity
     */
    protected $object3;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $dummyDriver = new DummyDriver();
        $translateRepository = $dummyDriver->getTranslateRepository();
        $translateRepository->prepareTranslateEntitiesForCurrentPage();

        $this->object = $translateRepository->getTranslateEntity('MESSAGE_BUTTON_SUBMIT');
        $this->object2 = $translateRepository->getTranslateEntity('MESSAGE_BUTTON_CANCEL');
        $this->object3 = $translateRepository->getTranslateEntity('MESSAGE_BUTTON_TEST');

        //$this->currentEntities['MESSAGE_BUTTON_TEST']->setMessage('sk', 'Testov',0);
        //$this->currentEntities['MESSAGE_BUTTON_TEST']->setMessage('sk', 'Test',1);
        //$this->currentEntities['MESSAGE_BUTTON_TEST']->setMessage('sk', 'Testy',2);
        //$this->currentEntities['MESSAGE_BUTTON_TEST']->setMessage('sk', 'Testov',5);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }


    /**
     * @covers Oaza\Application\Adapter\Drivers\DummyDriver\TranslateRepository\TranslateEntity::getTranslateMessage
     */
    public function testGetTranslateMessage_Simple()
    {

        $this->assertEquals( 'Potvrdiť', $this->object->getTranslateMessage('sk'));
        $this->assertEquals( 'Submit', $this->object->getTranslateMessage('en'));

        $this->assertEquals( 'Zrušiť', $this->object2->getTranslateMessage('sk'));
        $this->assertEquals( 'Cancel', $this->object2->getTranslateMessage('en'));
    }

    public function testGetTranslateMessage_Advanced()
    {
        $this->assertEquals( 'Testov', $this->object3->getTranslateMessage('sk',0));
        $this->assertEquals( 'Test', $this->object3->getTranslateMessage('sk',1));
        $this->assertEquals( 'Testy', $this->object3->getTranslateMessage('sk',2));
        $this->assertEquals( 'Testy', $this->object3->getTranslateMessage('sk',3));
        $this->assertEquals( 'Testy', $this->object3->getTranslateMessage('sk',4));
        $this->assertEquals( 'Testov', $this->object3->getTranslateMessage('sk',5));
        $this->assertEquals( 'Testov', $this->object3->getTranslateMessage('sk',100));
    }
}
