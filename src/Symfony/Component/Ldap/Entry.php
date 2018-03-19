<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Ldap;

/**
 * @author Charles Sarrazin <charles@sarraz.in>
 */
class Entry
{
    private $dn;
    private $attributes;

    public function __construct(string $dn, array $attributes = array())
    {
        $this->dn = $dn;
        $this->attributes = $this->resetValuesIndex($attributes);
    }

    /**
     * Resets the index for array values.
     *
     * @param array $attributes
     *
     * @return array
     */
    private function resetValuesIndex(array $attributes)
    {
        return array_map(function ($v) {
            return array_values($v);
        }, $attributes);
    }

    /**
     * Returns the entry's DN.
     *
     * @return string
     */
    public function getDn()
    {
        return $this->dn;
    }

    /**
     * Returns whether an attribute exists.
     *
     * @param $name string The name of the attribute
     *
     * @return bool
     */
    public function hasAttribute($name)
    {
        return isset($this->attributes[$name]);
    }

    /**
     * Returns a specific attribute's value.
     *
     * As LDAP can return multiple values for a single attribute,
     * this value is returned as an array.
     *
     * @param $name string The name of the attribute
     *
     * @return null|array
     */
    public function getAttribute($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }

    /**
     * Returns the complete list of attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Sets a value for the given attribute.
     *
     * @param string $name
     * @param array  $value
     */
    public function setAttribute($name, array $value)
    {
        $this->attributes[$name] = array_values($value);
    }

    /**
     * Removes a given attribute.
     *
     * @param string $name
     */
    public function removeAttribute($name)
    {
        unset($this->attributes[$name]);
    }
}