include './vendor/autoload.php';

//Do update, just in case.
shell_exec("bash ~/TPM/mod/999dice/update.sh");
//Ask user for input
function userPrompt($message) {
    print($message);
    $handle = fopen ('php://stdin','r');
    $line = rtrim(fgets($handle), "\r\n");
    return $line;
    }
}

$path = "~/TPM/mod/999dice";
echo "Launching 999dice module!\n";


// Do setup
echo "Checking for username...    ";
if (file_exist($path."/uname.txt")) {
    echo "OK!\n";
} else {
    echo "Fail!\n";
    echo "Unable to find login information in "database\"";
    file_put_contents($path."/uname.txt",userPrompt("Username: "));
    echo "Got it.\n";
}
echo "Checking for password...    ";
if (file_exist($path."/upass.txt")) {
    echo "OK!\n";
} else {
    echo "Fail!\n";
    echo "Unable to find login information in "database\"";
    file_put_contents($path."/upass.txt",userPrompt("Password: "));
    echo "Got it.\n";
}
echo "Checking if data is correct";
$uname = file_get_contents($path."/uname.txt");
$upass = file_get_contentd($path."/upass.txt");
