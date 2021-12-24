<?php
class Food {
    private $name;
    private $description;
    private $price;

    public function __construct($name,$description,$price){
        $this->name=$name;
        $this->description=$description;
        $this->price=$price;
    }
    public function getName(){
        return $this->name;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getPrice(){
        return $this->price;
    }

    protected function getInfo(){
        $info = 'Название:'. $this->name. '<br>'.
                'Состав:'. $this->description. '<br>'.
                'Цена:' . $this->price. '<br>';
    return $info;
    }
}