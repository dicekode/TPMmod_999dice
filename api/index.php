<?php
try {

$waittime=0.1; //seconds

$waittime=round($waittime*1000000);

$f = "./todo.txt";
$g = "./reply.txt";
unlink($g);
//print_r($_GET);
if ($_GET['action'] == 'bet') {
    file_put_contents($f,"bet\n".$_GET['amount']."\n".$_GET['chance']."\n".$_GET['bethi']);
    $try = 0;
    while (1) {
        usleep($waittime);
        if ($try > 50) {
          echo "Oh no...";
          //exit 1;
          return 1;
        }
        if (file_exists($g)) {
          echo file_get_contents($g);
          unlink($g);
          return 0;
        }
    }
}
if ($_GET['action'] == 'deposit') {
    file_put_contents($f,"deposit");
    $try = 0;
    while (1) {
	usleep($waittime);
        if ($try > 50) {
          echo "Oh no...";
          //exit 1;
          return 1;
        }
        if (file_exists($g)) {
          echo file_get_contents($g);
          unlink($g);
          return 0;
        }
    }
}
if ($_GET['action'] == 'balance') {
    file_put_contents($f,"balance");
    $try = 0;
    while (1) {
	usleep($waittime);
        if ($try > 50) {
          echo "Oh no...";
          //exit 1;
          return 1;
        }
        if (file_exists($g)) {
          echo file_get_contents($g);
          unlink($g);
          return 0;
        }
    }
}
if ($_GET['action'] == 'withdraw') {
    file_put_contents($f,"withdraw\n".$_GET['amount']."\n".$_GET['address']);
    $try = 0;
    while (1) {
        if ($try > 50) {
	  usleep($waittime);
          echo "Oh no...";
          //exit 1;
          return 1;
        }
        if (file_exists($g)) {
          echo file_get_contents($g);
          unlink($g);
          return 0;
        }
    }
}
} catch ( Exception $e ) {
    print_r($e);
}
