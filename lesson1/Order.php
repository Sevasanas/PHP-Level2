<?php
class Order {
    public static function sumOrder($product){
        return $product->getPrice() * $product->getCount();
    }
}