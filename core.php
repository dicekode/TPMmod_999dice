<?php

include './vendor/autoload.php';

//Do update, just in case.
shell_exec("bash ~/TPM/mod/999dice/update.sh");
//Ask user for input
$path = "/home/".shell_exec('whoami')."/TPM/mods/999dice";
echo "Launching 999dice module!\n";
// Do setup
echo "Checking for username...    ";
if (file_exists($path."/uname.txt")) {
    echo "OK!\n";
} else {
    echo "Fail!\n";
    echo "Unable to find login information in \"database\"";
    echo "Please finish setup!!!\n\n#############";
    echo "echo \"YOUR_999DICE_USERNAME\" >> $path/uname.txt";
    die();
}
echo "Checking for password...    ";
if (file_exists($path."/upass.txt")) {
    echo "OK!\n";
} else {
    echo "Fail!\n";
    echo "Unable to find login information in \"database\"";
    echo "echo \"YOUR_999DICE_PASSWORD\" >> $path/upass.txt";
    die();
}
echo "Checking if data is correct";
$uname = file_get_contents($path."/uname.txt");
$upass = file_get_contents($path."/upass.txt");
// Initialize 999
$api = "4f80542ca113477d8d2fc380af54e15e";
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
    exit;
}

// ==== User is no longer needed

$server = new Server(function (ServerRequestInterface $request) {
    $queryParams = $request->getQueryParams();
    
    
    
    if (isset($queryParams['foo'])) {
        $body = 'The value of "foo" is: ' . htmlspecialchars($queryParams['foo']);
    }
    return new Response(
        200,
        array(
            'Content-Type' => 'text/html'
        ),
        $body
    );
});
