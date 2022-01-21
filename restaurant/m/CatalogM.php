<?php


class CatalogM
{


    // Вывод информации о продуктах каталога
    public function getCatalog()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM pizza WHERE category_id=$id";
        } else {
            $query = "SELECT * FROM pizza";
        }
//        var_dump($query);
        $res = PdoM::Instance() -> SelectAll($query);
//        var_dump($res);
        return $res;
    }
}