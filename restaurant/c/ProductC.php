<?php

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class ProductC extends BaseC
{
    public function viewItem()
    {
//        var_dump($_SERVER);
        $item = new ProductM();
        $this -> title = "Информация о товаре";  // Todo: добавить правильное отображение названия товара из базы
        $product=$item->getItem();
        $loader = new FilesystemLoader('v');
        $twig = new Environment($loader, [
            'cache' => 'tcc','debug' => true,
        ]);
        $twig->addExtension(new DebugExtension());
        echo $twig->render('product.twig', ['product' => $product, 'title' => $this -> title, 'userid' => $_SESSION['user_id'], 'user' => $this->userTest()]);
    }

    public function viewBasket()
    {
        $basket = new ProductM();
        $this -> title = "Корзина товаров";  // Todo: добавить правильное отображение названия товара из базы
        $products=$basket->getCart();
        $num=$basket->getCountCart();
        $loader = new FilesystemLoader('v');
        $twig = new Environment($loader, [
            'cache' => 'tcc','debug' => true,
        ]);
        $twig->addExtension(new DebugExtension());
        echo $twig->render('basket.twig', ['products' => $products, 'title' => $this -> title, 'userid' => $_SESSION['user_id'], 'user' => $this->userTest(), 'num' => $num]);
    }

    public function addToCart()
    {
        $item = new ProductM();
        $item -> addToCart();

        echo '<script> window.location="index.php?class=product&method=viewBasket"; </script>';
//        echo '<script> window.location=" '.$_SERVER['PHP_SELF'].' "; </script>';
    }

    public function deleteFromCart()
    {
        $item = new ProductM();
        $item -> removeFromCart();
        echo '<script> window.location="index.php?class=product&method=viewBasket"; </script>';
//        echo '<script> window.location=" '.$_SERVER['PHP_SELF'].' "; </script>';
    }

    public function clearCart()
    {
        $item = new ProductM();
        $item -> emptyCard();
        echo '<script> window.location="index.php"; </script>';
//        echo '<script> window.location=" '.$_SERVER['PHP_SELF'].' "; </script>';
    }

    public function viewOrder()
    {
        $order = new ProductM();
        $this -> title = "Заказ";  // Todo: добавить правильное отображение названия товара из базы
        $products=$order->getCart();
        $num=$order->getCountCart();
        $loader = new FilesystemLoader('v');
        $twig = new Environment($loader, [
            'cache' => 'tcc','debug' => true,
        ]);
        $twig->addExtension(new DebugExtension());
        echo $twig->render('order.twig', ['products' => $products, 'title' => $this -> title, 'userid' => $_SESSION['user_id'], 'user' => $this->userTest(), 'num' => $num]);
    }

    public function makeOrder()
    {
        $item = new ProductM();
        $item -> createOrder();

        echo '<script> window.location="index.php?class=user&method=getUser"; </script>';
//        echo '<script> window.location=" '.$_SERVER['PHP_SELF'].' "; </script>';
    }

}