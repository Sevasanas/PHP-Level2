<?php
abstract class Template { 
    
    const PROFIT_PERCENT = 10;  // Процент прибыли уже заложенный в стоимость каждого товара
    
    abstract public function totalCost();   // Финальная стоимость товара с учётом кол-ва или веса
    
    abstract public function profitCalc();  // Доход получаемый с продажи товара с учётом PROFIT_PERCENT

} 
class OnlineCourse extends Template {
    
    const PRICE = 350;	
    private $amount;

    public function __construct($amount)
    {
        self::setAmount($amount);
    }
    
    public function getPrice() {
        return PRICE;
    }
    
    public function getAmount() {
        return $this->amount;
    }
    
    public function setAmount($amount=0)
    {
        $this->amount = $amount;
    }
    
    public function totalCost()
    {
        return self::PRICE * $this->amount;
    }

    public function profitCalc()
    {
        return $this->totalCost() -  $this->totalCost() / 100 * parent::PROFIT_PERCENT;
    }

}
class Goods extends OnlineCourse {
    public function getPrice() {
        return parent::PRICE * 2;
    }
    
    public function totalCost()
    {
        return $this->getPrice() * parent::getAmount();
    }
    
    public function profitCalc()
    {
        return  $this->totalCost() -  $this->totalCost() / 100 * parent::PROFIT_PERCENT;
    }
}
class GoodsForWeight extends Template {
    private $price;
    private $weight;
    
    public function __construct($price, $weight)
    {
        self::setPrice($price);
        self::setWeight($weight);
    }
    
    public function setPrice($price=0)
    {
        $this->price = $price;
    }
    
    public function setWeight($weight=0)
    {
        $this->weight = $weight;
    }
    
    public function totalCost()
    {
        return $this->price * $this->weight;
    }
    
    public function profitCalc()
    {
        return $this->totalCost() -  $this->totalCost() / 100 * parent::PROFIT_PERCENT;
    }
}

