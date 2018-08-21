<?php
/**
 * Created by PhpStorm.
 * User: Marina
 * Date: 21/08/2018
 * Time: 19:50
 */

namespace PtitdejBundle\Entity;


abstract class AbstractEntity
{
    public function sinceArray(array $data)
    {
        foreach ($data as $clef => $value) {
            $this->_set($clef, $value);
        }
    }
    abstract public function _set($clef, $value);

}