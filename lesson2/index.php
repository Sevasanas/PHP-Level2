<?php
include "Template.php";


$obj_online = new OnlineCourse(1);
echo "Стоимость онлайн-курса 'Торт Медовик':". $obj_online->profitCalc(). "<br>";

$obj_goods = new Goods(1);
echo "Стоимость торта Медовик:".$obj_goods->profitCalc(). "<br>";

$obj_weight = new GoodsForWeight(1, 450);
echo "Стоимость конфет:". $obj_weight->profitCalc();