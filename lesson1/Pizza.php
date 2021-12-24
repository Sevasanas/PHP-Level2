<?php
include "Food.php";
include "Order.php";
class Pizza extends Food {
    private $count;

    public function __construct($name,$description,$price,$count)
    {
        parent::__construct($name,$description,$price);
        $this->count = $count;
    }

    public function getCount(){
        return $this->count;
    }


    public function getInfo(){
        $info = parent::getInfo(). 'Количество:'. $this->count. '<br>'.
                                    'Общая стоимость:' . Order::sumOrder($this). '<br>';
        return $info;
    }

    
}

$pizza = new Pizza('Маргарита', 'Томатная паста, сыр, помидоры', 450, rand(1, 5));
echo $pizza->getInfo();
