<?php
namespace VighIosif\EntityContainers\Tests;

use VighIosif\EntityContainers\SampleEntity\AccountEntity;
use VighIosif\EntityContainers\SampleEntity\Containers\AccountContainer;

require dirname(__FILE__) . '/../vendor/autoload.php';

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public static function getAccountContainerArray()
    {
        return [
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
        ];
    }

    /**
     * @return AccountContainer
     * @throws \Exception
     */
    public static function getAccountContainerObject()
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
        return $accountContainer;
    }

    /**
     * Test creation of containers and make sure that the structure is maintained through getData() method
     *
     * @throws \Exception
     * @throws \VighIosif\EntityContainers\Exceptions\EntityContainerException
     */
    public function testContainers()
    {
        $accountContainer        = self::getAccountContainerObject();
        $accountContainerCompare = AccountContainer::factory(self::getAccountContainerArray());

        $this->assertEquals(
            $accountContainer,
            $accountContainerCompare
        );

        $this->assertEquals(
            $accountContainer->getData(),
            $accountContainerCompare->getData()
        );

        $this->assertEquals(
            $accountContainer->getData(false),
            $accountContainerCompare->getData(false)
        );

        $this->assertEquals(
            $accountContainer->getFirst(),
            $accountContainerCompare->getFirst()
        );
    }

    /**
     * This test proves the working mechanism of the unique identifier  method
     */
    public function testUniqueIdentifierMethod()
    {
        $accountContainer        = self::getAccountContainerObject();
        $accountContainerCompare = AccountContainer::factory(self::getAccountContainerArray());

        $this->assertEquals(
            $accountContainer->getFirst()->getUniqueIdentifier(),
            $accountContainerCompare->getFirst()->getUniqueIdentifier()
        );

        /** @var AccountEntity $accountEntity */
        $accountEntity = $accountContainer->getFirst();
        $this->assertEquals(
            $accountEntity->getUniqueIdentifier(),
            AccountEntity::factory(
                [
                    'type'     => $accountEntity->getType(),
                    'username' => $accountEntity->getUsername(),
                    'password' => $accountEntity->getPassword(),
                ]
            )->getUniqueIdentifier()
        );
    }
}
