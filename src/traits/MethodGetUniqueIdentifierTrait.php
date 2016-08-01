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

/**
 * Class MethodGetUniqueIdentifierTrait
 *
 * @category Traits
 * @package  Iqu\ContactApiClient\Entity\Traits
 * @author   Iosif Vigh <iosif.vigh@iqu.com>
 * @license  https://composer.iqugroup.com/license Proprietary and private
 * @link     http://www.iqu.com iQU Homepage
 */
trait MethodGetUniqueIdentifierTrait
{
    /**
     * This method is used for assigning list entries into a container, see it as array key.
     *
     * @return integer
     */
    public function getUniqueIdentifier()
    {
        $unique = '';
        $fields = $this->getDbColumns();
        foreach ($fields as $field) {
            $str = ucwords(str_replace('_', '', $field));
            $unique .= $this->{"get" . $str}();
        }
        if ('' === $unique) {
            $exceptionClassName = self::EXCEPTION_CLASS;
            throw $exceptionClassName::factoryIncompleteIdentifier();
        }
        return md5($unique);
    }
}
