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
echo "Checking if data is correct...     ";
$uname = explode(PHP_EOL, file_get_contents($path."/uname.txt"))[0];
$upass = explode(PHP_EOL, file_get_contents($path."/upass.txt"))[0];
$api = explode(PHP_EOL, file_get_contents($path."/uapik.txt"))[0];
// Initialize 999
try {
$three9DiceClient = new \Three9Dice\Client(
	new \Three9Dice\User($api, $uname, $upass)
);
} catch (Exception $e) {
    print_r($e);
    unlink($path."/uname.txt");
    unlink($path."/uname.txt");
    echo "Failed";
    //include $path."/core.php"; // TODO: Make it better
    exit(2);
}
echo 'OK';
try {
    if ($argv[1] == 'test') {
        exit(0);
    }
} catch (Exception $e) {
    // 🙈
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
$cnt = 0;
while (1) {
    $inp = file_get_contents('./api/todo.txt');
    if ($inp == "") {
        $cnt++;
    } else {
	$inp = explode("\n",$inp);
	if ($inp[0] == 'bet') {
	    $amount = $inp[1];
	    $chance = $inp[2];
	    $bethi  = $inp[3];
            try {
	    file_put_contents("./api/reply.txt",placeBet($amount, $chance, $bethi));
            } catch (Exception $e) {
                print_r($e);
            }
	}
	$cnt = 0;    
    }
    // wait for .05 seconds
    if ($cnt > 100) {
        $cnt = 90;
    }
    file_put_contents('./api/todo.txt',"");
    echo "\nTaking break: ".(50000*$cnt);
    usleep(50000*$cnt);
}
function placeBet($amount = 0, $chance = 49.95, $bethi = true) {
    global $three9DiceClient;
    $lower = !$bethi;
    $bet = new \Three9Dice\Bet\Bet(
	// Amount in satoshi
	$amount,
	// Currency
	\Three9Dice\Constant::CURRENCY_DOGE, 
	// GuessRange 
	\Three9Dice\GuessRange\GuessRange::generatePercent($chance, $lower)
    );	
    $bet = $three9DiceClient->placeBet( $bet );
    // print_r($bet);
/*
Array
(
    [BetId] => 100504281418
    [PayOut] => 0
    [Secret] => 327078
    [StartingBalance] => 15851548
    [ServerSeed] => 0cdf979b1138cdab18dccfa3fffb11b4c6290f580688b419adc914a10edf9d3a
    [Next] => 0357b5fce9e9466ecd6ab76ccbd2e88360a07ab7541ec3b7725c61ff037fd138
)
*/
	$response = [];
	$response['win'] = 1*$bet['PayOut'];
	$response['balance'] = $bet['StartingBalance']+$bet['PayOut'];
	print_r($response);
	return json_encode($response);
	// #TODO: add bet verification.
}
