<?php
include "Food.php";
class Size extends Food {
    private $size;

    public function __construct($name,$description,$price,$size)
    {
        parent::__construct($name,$description,$price);
        $this->size = $size;
    }

    public function getSize(){
        return $this->size;
    }

    public function getInfo(){
        $info = parent::getInfo(). 'Размер:'. $this->size;
        return $info;
    }

}

$size = new Size('Маргарита', 'Томатная паста, сыр, помидоры', 450, rand(18, 35));
echo $size->getInfo();