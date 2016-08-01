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
 * Class PropertyContactIdTrait
 *
 * @category Traits
 * @package  Iqu\ContactApiClient\Entity\Traits
 * @author   Iosif Vigh <iosif.vigh@iqu.com>
 * @license  https://composer.iqugroup.com/license Proprietary and private
 * @link     http://www.iqu.com iQU Homepage
 */
trait PropertyContactIdTrait
{
    /**
     * The contactId which connects all other entities
     *
     * @var int $contactId
     */
    private $contactId;

    /**
     * ContactId getter
     *
     * @return int
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * Contact Id setter
     *
     * @param int $contactId value to be set
     *
     * @return $this
     * @throws BaseException Exceptions extended from the base
     */
    public function setContactId($contactId)
    {
        $contactIdInt = intval($contactId);
        if (!is_numeric($contactId) || $contactId != $contactIdInt || $contactIdInt <= 0) {
            $exceptionClassName = self::EXCEPTION_CLASS;
            /**
             * Will be some class extended from this base Exception, but this is good enough for code linting
             *
             * @var BaseException $exceptionClassName
             */
            throw $exceptionClassName::factoryInvalidValue($contactId, 'id', 'positive integer');
        }
        $this->contactId = $contactIdInt;
        return $this;
    }
}
