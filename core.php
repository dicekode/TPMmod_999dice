<?php

$port = file_get_contents("./port.txt");

include './vendor/autoload.php';
//Do update, just in case.
//shell_exec("bash ~/TPM/mod/999dice/update.sh");
$path = str_replace(PHP_EOL,"",shell_exec('echo "/home/`whoami`/TPM/mods/999dice"'));
echo "Launching 999dice module!\n";
echo "PATH: $path\n";
// Do checkups
echo "Checking for username...    ";
if (file_exists($path."/uname.txt")) {
    echo "OK!\n";
} else {
    echo "Fail!\n";
    echo "Unable to find login information in \"database\"";
    echo "\nPlease finish setup by using this command:\n#############\n";
    echo "bash $path/config.sh";
    exit(1);
}
echo "Checking for password...    ";
if (file_exists($path."/upass.txt")) {
    echo "OK!\n";
} else {
    echo "Fail!\n";
    echo "Unable to find login information in \"database\"";
    echo "Please finish setup by using this command:\n#############\n";
    echo "bash $path/config.sh";
    exit(1);
}
echo "Checking if data is correct";
$uname = file_get_contents($path."/uname.txt");
$upass = file_get_contents($path."/upass.txt");
// Initialize 999
$api = file_get_contents($path."/uapik.txt");
try {
$three9DiceClient = new \Three9Dice\Client(
	new \Three9Dice\User($api, $uname, $upass)
);
} catch (Exception $e) {
    print_r($e);
    unlink($path."/uname.txt");
    unlink($path."/uname.txt");
    echo "Failed...";
    include $path."/core.php"; // TODO: Make it better
    exit(2);
}

// ==== User is no longer needed

//$server = new Server(function (ServerRequestInterface $request) {
//    $q = $request->getQueryParams();
//    $bet    = $q['bet'];
//    $chance = $q['chance'];
//    $where  = $q['prediction'];
//    $body = 'This gonna work soon, sorry Jake but YD first";
//    return new Response(
//        200,
//        array(
//            'Content-Type' => 'text/html'
//        ),
//        $body
//    );
//});

while (1) {
    file_get_contents('./todo.txt');	
}
