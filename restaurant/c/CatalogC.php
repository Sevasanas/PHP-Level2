<?php

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class CatalogC extends BaseC
{

    public function viewCatalog()
    {
        $prod = new CatalogM();
        $this -> title = "Каталог товаров";
        $products=$prod->getCatalog();
        $loader = new FilesystemLoader('v');
        $twig = new Environment($loader, [
            'cache' => 'tcc','debug' => true,
        ]);
        $twig->addExtension(new DebugExtension());
        echo $twig->render('catalog.twig', ['products' => $products, 'title' => $this -> title, 'userid' => $_SESSION['user_id'], 'user' => $this->userTest()]);
    }
}