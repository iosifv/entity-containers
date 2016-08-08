<?php
namespace VighIosif\EntityContainers\Tests;

use VighIosif\EntityContainers\SampleEntity\AccountEntity;
use VighIosif\EntityContainers\SampleEntity\Containers\AccountContainer;

require dirname(__FILE__) . '/../vendor/autoload.php';

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        date_default_timezone_set('Europe/Amsterdam');
        parent::__construct();
    }

    public function testContainers()
    {
        $accountContainer = new AccountContainer();
        $accountEntity1   = new AccountEntity();
        $accountEntity2   = new AccountEntity();
        $accountEntity3   = new AccountEntity();
        $accountEntity4   = new AccountEntity();
        $accountEntity1->setType(1)->setUsername('AlPacino')->setPassword('Scarface');
        $accountEntity2->setType(2)->setUsername('RobertDeNiro')->setPassword('TheGoodfelas');
        $accountEntity3->setType(2)->setUsername('JackNicholson')->setPassword('TheShining');
        $accountEntity4->setType(2)->setUsername('MarlonBranco')->setPassword('TheGodfather');
        $accountContainer
            ->add($accountEntity1)
            ->add($accountEntity2)
            ->add($accountEntity3)
            ->add($accountEntity4);

        $accountContainerCompare = AccountContainer::factory([
            [
                'type'     => 1,
                'username' => 'AlPacino',
                'password' => 'Scarface',
            ],
            [
                'type'     => 2,
                'username' => 'RobertDeNiro',
                'password' => 'TheGoodfelas',
            ],
            [
                'type'     => 2,
                'username' => 'JackNicholson',
                'password' => 'TheShining',
            ],
            [
                'type'     => 2,
                'username' => 'MarlonBranco',
                'password' => 'TheGodfather',
            ],
        ]);

        $this->assertEquals(
            $accountContainer,
            $accountContainerCompare
        );

        $this->assertEquals(
            $accountContainer->getData(),
            $accountContainerCompare->getData()
        );

        $this->assertEquals(
            $accountContainer->getFirst(),
            $accountContainerCompare->getFirst()
        );

        $this->assertEquals(
            $accountContainer->getFirst()->getUniqueIdentifier(),
            $accountContainerCompare->getFirst()->getUniqueIdentifier()
        );
    }
}
