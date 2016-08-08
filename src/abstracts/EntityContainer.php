<?php


namespace VighIosif\EntityContainers\Abstracts;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use VighIosif\EntityContainers\Exceptions\EntityContainerException;
use VighIosif\EntityContainers\Exceptions\ExceptionConstants;
use VighIosif\EntityContainers\Interfaces\EntityInterface;

abstract class EntityContainer implements IteratorAggregate, Countable
{
    const ENTITY_CLASS = null;
    /**
     * @var array
     */
    private $list = [];

    /**
     * Creates a complete object only from the array provided.
     * Can be used in combination with getData() to morph objects into arrays and the other way around. Awesome!
     *
     * @param array $entities
     *
     * @return EntityContainer
     * @throws EntityContainerException
     */
    public static function factory(array $entities = [])
    {
        // Need to use static because this is in an abstract class will be extended.
        $entityClass = static::ENTITY_CLASS;
        $container   = new static();

        foreach ($entities as $entity) {
            if (is_array($entity)) {
                // If array, we just add the factorized object.
                $newEntity = $entityClass::factory($entity);
                $container->add($newEntity);
            } elseif (is_object($entity) && $entity instanceof \stdClass) {
                // If it's a standard object, the process is the same as with an array, but we cast to array first.
                $newEntity = $entityClass::factory((array) $entity);
                $container->add($newEntity);
            } elseif ($entity instanceof EntityInterface) {
                // If it's an entity which is an instanceof EntityInterface, we're lucky because nothing is needed.
                $container->add($entity);
            } else {
                // Something fishy is happening if we got here!
                throw new EntityContainerException(
                    ExceptionConstants::INVALID_ENTITY_FORMAT,
                    ExceptionConstants::INVALID_ENTITY_FORMAT_CODE
                );
            }
        }
        return $container;
    }

    /**
     * Adds an entity to the present container.
     *
     * @param EntityInterface $entity
     *
     * @return $this
     */
    public function add(EntityInterface $entity)
    {
        $this->list[$entity->getUniqueIdentifier()] = $entity;
        return $this;
    }

    /**
     * Count the number of entities in this container
     *
     * @return int
     */
    public function count()
    {
        return count($this->list);
    }

    /**
     * Returns the first element in the container
     *
     * @return mixed
     */
    public function getFirst()
    {
        return reset($this->list);
    }

    /**
     * Returns data which should be used by entity merge
     *
     * @param bool $addNullValues
     *
     * @return array
     */
    public function getData($addNullValues = true)
    {
        $result = [];
        if (is_array($this->list)) {
            foreach ($this->list as $entity) {
                /**
                 * @var $entity EntityInterface
                 */
                $result[] = $entity->getData($addNullValues);
            }
        }
        return $result;
    }

    /**
     * Returns an iterator from the current list.
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->list);
    }

    /**
     * Can be used within classes which has private properties and corresponding get methods to return the data
     * This method will allow to merge subsequent objects which implements the getData method
     *
     * @param EntityContainer $container
     *
     * @return EntityContainer
     */
    public function merge(EntityContainer $container)
    {
        foreach ($container as $currentEntity) {
            /**
             * @var $currentEntity EntityInterface
             */
            if (!$this->exists($currentEntity)) {
                $this->add($currentEntity);
            } else {
                $currentEntity = $this->get($currentEntity->getUniqueIdentifier())->merge($currentEntity);
                $this->deleteByEntity($currentEntity);
                $this->add($currentEntity);
            }
        }
        return $this;
    }

    /**
     * Assesses the existence of the provided entities
     *
     * @param $entities
     *
     * @return bool
     */
    public function exists($entities)
    {

        if (is_array($entities)) {
            foreach ($entities as $entity) {
                if (!array_key_exists($entity, $this->list)) {
                    return false;
                }
            }
            return true;
        } elseif (is_scalar($entities)) {
            if (isset($this->list[$entities])) {
                return true;
            }
            return false;
        } elseif ($entities instanceof EntityInterface) {
            if (is_array($this->list)) {
                return array_key_exists($entities->getUniqueIdentifier(), $this->list);
            }
            return false;
        }
        return false;
    }

    /**
     * Provided with the identifier an entity will be returned from the container
     *
     * @param string|integer $identifier
     *
     * @return bool|EntityInterface
     */
    public function get($identifier)
    {
        if (isset($this->list[$identifier])) {
            return $this->list[$identifier];
        }
        return false;
    }

    /**
     * Provided with an entity, this method will delete that entity from the container
     *
     * @param EntityInterface $entity
     *
     * @return $this
     */
    public function deleteByEntity(EntityInterface $entity)
    {
        return $this->deleteByIdentifier(
            $entity->getUniqueIdentifier()
        );
    }

    /**
     * Provided with an identifier, this method will delete the corresponding entity from the container
     *
     * @param $identifier
     *
     * @return $this
     */
    public function deleteByIdentifier($identifier)
    {
        unset($this->list[$identifier]);
        return $this;
    }
}
