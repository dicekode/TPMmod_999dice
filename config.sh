echo "=============";
echo "Configuting 999dice module";
echo "I'll ask you some things, please be honest and answer them";
echo "=============";
echo "Username:";
read user
echo "Password:";
read pass
echo "writing username";
echo "$user" >> /home/`whoami`/TPM/mods/999dice/uname.txt; 
echo "writing password";
echo "$pass" >> /home/`whoami`/TPM/mods/999dice/upass.txt;
echo "=== D O N E ===";
exit;
