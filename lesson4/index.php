<?php

CONST PHOTO_PATH = 'data/photo';
CONST PHOTO_SMALL_PATH = 'data/photo_small';


require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {

  $dbh = new PDO('mysql:dbname=lesson6;host=3307', 'root', '');
} catch (PDOException $e) {
  echo "Error: Could not connect. " . $e->getMessage();
}

// установка error режима
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
  if(isset($_GET['limit'])){
    $limit = $_GET['limit'];
  } else {
    $limit = 5;
  }

  $sql = "SELECT gallery.id AS id, gallery.filename AS filename, gallery.type AS type, gallery.title AS title, gallery.description AS description, gallery.count AS count FROM gallery limit $limit";
  
  $sth = $dbh->query($sql);
  while ($row = $sth->fetchObject()) {
    $data[] = $row;
  }

  print_r($_GET['a']);
  
  
  unset($dbh); 
  $loader = new Twig_Loader_Filesystem('templates');
  

  $twig = new Twig_Environment($loader);
  

  $template = $twig->loadTemplate('index.tmpl');
  
  $photos_in_dir = array_slice(scandir(PHOTO_PATH), 2);


  echo $template->render(array(
            'title' => 'Сериалы',
            'path_to_photo_small' => PHOTO_SMALL_PATH,
            'photos' => $photos_in_dir,
            'data' => $data,
            'count'=>count($data)
            ));
  
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>
