<?php

/**
 * @Entity @Table(name="products")
 **/
class Product
{
    /**
     * GeneratedValue - автоинкримент
     * @Id @Column(type="integer") @GeneratedValue **/
    public $id;

    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="string") **/
    public $love;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
