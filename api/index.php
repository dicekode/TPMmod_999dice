<?php
try {
$f = "./todo.txt";
$g = "./reply.txt";
//print_r($_GET);
if ($_GET['action'] == 'bet') {
    file_put_contents($f,"bet\n".$_GET['amount']."\n".$_GET['chance']."\n".$_GET['bethi']);
    $try = 0;
    while (1) {
        if ($try > 50) {
          echo "Oh no...";
          //exit 1;
          return 1;
        }
        if (file_exists($g)) {
          unlink($g);
          echo file_get_contents($g);
          return 0;
        }
    }
}
} catch ( Exception $e ) {
    print_r($e);
}
