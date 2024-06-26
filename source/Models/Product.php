<?php

namespace Source\Models;

use Source\Core\Model;

class Product extends Model {
    protected $id;
    protected $name;
    protected $color;
    protected $size;
    protected $price_brl;
    protected $res_path;

    /**
     * @param $id
     * @param $name
     * @param $color
     * @param $size
     * @param $price_brl
     * @param $res_path
     */
    public function __construct($id, $name, $color, $size, $price_brl, $res_path)
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->size = $size;
        $this->price_brl = $price_brl;
        $this->res_path = $res_path;
        $this->entity = "products";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getPriceBrl()
    {
        return $this->price_brl;
    }

    /**
     * @param mixed $price_brl
     */
    public function setPriceBrl($price_brl): void
    {
        $this->price_brl = $price_brl;
    }

    /**
     * @return string
     */
    public function getResPath() : string
    {
        return $this->res_path;
    }

    /**
     * @param mixed $res_path
     */
    public function setResPath($res_path): void
    {
        $this->res_path = $res_path;
    }

}