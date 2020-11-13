<?php
// require_once __DIR__ . '/class.Koelsch_Walker_Nav_Menu.php';
// foreach(glob('/*.php') as $filename){
//   require_once $filename;
// }
function koelsch_class_autoloader($class) {
    $file = __DIR__ . '/class.'.$class.'.php';
    if (!file_exists($file)){
      return false;
    }
    require_once $file;

}
spl_autoload_register('koelsch_class_autoloader');
?>
