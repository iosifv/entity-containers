<?php
/**
 * Trait class
 *
 * @category  Traits
 * @package   Iqu\ContactApiClient
 * @author    Iosif Vigh <iosif.vigh@iqu.com>
 * @copyright 2016 iQU. All rights reserved.
 * @license   https://composer.iqugroup.com/license Proprietary and private
 * @link      http://www.iqu.com iQU Homepage
 */


namespace Iqu\ContactApiClient\Entity\Traits;

use Iqu\ContactApiClient\Entity\Exceptions\BaseException;

/**
 * Class PropertyIdTrait
 *
 * @category Traits
 * @package  Iqu\ContactApiClient\Entity\Traits
 * @author   Iosif Vigh <iosif.vigh@iqu.com>
 * @license  https://composer.iqugroup.com/license Proprietary and private
 * @link     http://www.iqu.com iQU Homepage
 */
trait PropertyIdTrait
{
    /**
     * Unique ID of any of the Entity Objects
     *
     * @var int
     */
    private $id;

    /**
     * Id getter
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Id setter
     *
     * @param int $id value to be set
     *
     * @return $this
     * @throws BaseException Exceptions extended from the base
     */
    public function setId($id)
    {
        $idInt = intval($id);
        if (!is_numeric($id) || $id != $idInt || $idInt <= 0) {
            $exceptionClassName = self::EXCEPTION_CLASS;
            /**
             * Will be some class extended from this base Exception, but this is good enough for code linting
             *
             * @var BaseException $exceptionClassName
             */
            throw $exceptionClassName::factoryInvalidValue($id, 'id', 'positive integer');
        }
        $this->id = $idInt;
        return $this;
    }
}
