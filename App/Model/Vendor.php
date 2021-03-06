<?php

namespace App\Model;

class Vendor extends Model
{
    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) :void
    {
        $this->name = $name;
    }
}