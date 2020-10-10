<?php
/**
 * Created by PhpStorm.
 * User: diffe
 * Date: 20.03.2020
 * Time: 22:23
 */

namespace Features;


class Example
{
    private $test;

    public function __construct($test)
    {
        $this->test = $test;
    }

    /**
     * @return mixed
     */
    public function getTest()
    {
        return $this->test;
    }
}