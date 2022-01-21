<?php

class ProductM
{
    // Вывод информации о конкретном продукте
    public function getItem()
    {
        
        //       $sqlupdate = "UPDATE pizza SET reviews_count = reviews_count + 1 where id = $id";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM pizza where id=$id";
        }
        $res = PdoM::Instance() -> Select($query);
        return $res;
    }

    // Вывод информации о конкретном продукте
    public function getItemTitle()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT name FROM pizza where id=$id";
        }
        $res = PdoM::Instance() -> Select($query);
        return $res;
    }

    public function getItemPrice()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT price FROM pizza where id=$id";
        }
        $res = PdoM::Instance() -> Select($query);
        return $res;
    }

    
    public function getUserId($name)
    {
        $sql = "SELECT id_user FROM users where name='$name';";
        $res = PdoM::Instance() -> select($sql);
        return $res['id_user'];
    }

    public function getUserName($id)
    {
        $sql = "SELECT name FROM users where id_user='$id';";
        $res = PdoM::Instance() -> select($sql);
        return $res['name'];
    }

    public function getPrice($id)
    {
        $sql = "SELECT price FROM pizza where id='$id';";
        $res = PdoM::Instance() -> select($sql);
        return $res['price'];
    }

    public function getName($id)
    {
        $sql = "SELECT name FROM pizza where id='$id';";
        $res = PdoM::Instance() -> select($sql);
        return $res['name'];
    }

    public function checkCart($id,$userid)
    {
        $sql = "SELECT id FROM cart where (id_pizza='$id' AND id_user='$userid');";
        $res = PdoM::Instance() -> select($sql);
        return $res['id'];
    }

    public function getCartAmount($id,$userid)
    {
        $sql = "SELECT count FROM cart where (id_pizza='$id' AND id_user='$userid');";
        $res = PdoM::Instance() -> select($sql);
        return $res['cart'];
    }

    public function addToCart()
    {
        // Todo: доработать и проверить функцию
        $id = $_GET['id'];
        if ($_SESSION['user_id'] == NULL) {
            // Демо режим
            $user = "demo";
            $userid = 999;
        } else {
            $userid = $_SESSION['user_id'];
            $user = $this->getUserName($userid);
        }
        $price = $this->getPrice($id);
        $cart_id = $this->checkCart($id,$userid);
        $name = $this->getName($id);
        $count = 1;
        if ($cart_id == NULL) {
            $object = ['id_user' => $userid, 'id_pizza' => $id, 'price' => $price, 'count' => $count, 'name' => $name];
            $res = PdoM::Instance() -> Insert('cart',$object);
        } else {
           $amount = $this->getCartAmount($id,$userid) + 1;
           $object = ['count' => $count];
           $res = PdoM::Instance() -> Update('cart',$object,"id='$cart_id'");
        }
    }

    public function removeFromCart()
    {
        // Todo: доработать и проверить функцию
        $id = $_GET['id'];
        if ($_SESSION['user_id'] == NULL) {
            // Демо режим
            $user = "demo";
            $userid = 999;
        } else {
            $userid = $_SESSION['user_id'];
            $user = $this->getUserName($userid);
        }
        $cart_id = $this->checkCart($id,$userid);
        $count = $this->getCartAmount($id,$userid);
        if ($count > 1) {
            $count = $count - 1;
            $object = ['count' => $count];
            $res = PdoM::Instance() -> Update('cart',$object,"id='$cart_id'");
        } else {
            $res = PdoM::Instance() -> Delete('cart',"id='$cart_id'");
        }
    }

    public function addShopItem($object)
    {
        $object = ['category_id' => $object[category_id], 'name' => $object[name], 'photo' => $object[photo], 'description' => $object[description],
            'short_description' => $object[short_description], 'brand_id' => $object[brand_id], 'price' => $object[price], 'availability' => $object[availability],
            'discount' => $object[discount], 'is_new' => 0, 'is_recommended' => 0,'reviews_count' => 0, 'reviews_score' => 0];
        $res = PdoM::Instance() -> Insert('products',$object);
    }

    public function deleteShopItem($id)
    {
        $res = PdoM::Instance() -> Delete('products',"id='$id'");
    }

    // Вывод информации о корзине товаров
    public function getCart()
    {
        if ($_SESSION['user_id'] == NULL) {
            // Демо режим
            $user = "demo";
            $userid = 999;
        } else {
            $userid = $_SESSION['user_id'];
            $user = $this->getUserName($userid);
        }
            $query = "SELECT * FROM cart where id_user=$userid";
        $res = PdoM::Instance() -> SelectAll($query);
        return $res;
    }

    public function getCountCart()
    {
        if ($_SESSION['user_id'] == NULL) {
            // Демо режим
            $user = "demo";
            $userid = 999;
        } else {
            $userid = $_SESSION['user_id'];
            $user = $this->getUserName($userid);
        }
        $query = "SELECT COUNT(*) FROM cart where id_user=$userid";
        $res = PdoM::Instance() -> Select($query);
        return $res["COUNT(*)"];
    }

    public function emptyCard()
    {
        if ($_SESSION['user_id'] == NULL) {
            // Демо режим
            $user = "demo";
            $userid = 999;
        } else {
            $userid = $_SESSION['user_id'];
            $user = $this->getUserName($userid);
        }
        $res = PdoM::Instance() -> Delete('cart',"id_user='$userid'");
    }

    public function createOrder()
    {
        if ($_SESSION['user_id'] == NULL) {
            // Демо режим
            $user = "demo";
            $userid = 999;
        } else {
            $userid = $_SESSION['user_id'];
            $user = $this->getUserName($userid);
        }
        $num=$this->getCountCart();
        $cart=$this->getCart();
        $totalPrice=0;
        if ($num > 1) {
            foreach ($cart as $item) {
                $totalPrice += $item["count"]*$item["price"];
            }
        } else {
            $totalPrice = $cart[0]["count"]*$cart[0]["price"];
        }
        // Создаем заказ, номер и дата создания присваивается автоматически в MySQL
        $object = ['id_user' => $userid, 'count' => $totalPrice, 'id_order_status' => 1];
        $ordid = PdoM::Instance() -> Insert('orders',$object);
         // Вносим информацию о заказанных товарах в таблицу order_items
        if ($num > 1) {
            foreach ($cart as $item) {
                $cartobj = ['ord_id' => $ordid, 'item_id' => $item["id"], 'count' => $item["count"], 'notes' => "", 'price' => $item["price"]];
                $res = PdoM::Instance() -> Insert('order_items',$cartobj);
            }
        } else {
            $cartobj = ['ord_id' => $ordid, 'item_id' => $cart[0]["id"], 'count' => $cart[0]["count"], 'notes' => "", 'price' => $cart[0]["price"]];
            $res = PdoM::Instance() -> Insert('order_items',$cartobj);
        }
        // Далее необходимо обнулить корзину заказа
        $this->emptyCard();
    }

    public function listOrders()
    {
        if ($_SESSION['user_id'] == NULL) {
            // Демо режим
            $user = "demo";
            $userid = 999;
        } else {
            $userid = $_SESSION['user_id'];
            $user = $this->getUserName($userid);
        }
        $query = "SELECT * FROM orders where id_user=$userid";
        $res = PdoM::Instance() -> SelectAll($query);
        return $res;
    }

    public function getCountOrders()
    {
        if ($_SESSION['user_id'] == NULL) {
            // Демо режим
            $user = "demo";
            $userid = 999;
        } else {
            $userid = $_SESSION['user_id'];
            $user = $this->getUserName($userid);
        }
        $query = "SELECT COUNT(*) FROM orders where id_user=$userid";
        $res = PdoM::Instance() -> Select($query);
        return $res["COUNT(*)"];
    }
}