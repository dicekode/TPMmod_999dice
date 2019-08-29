echo "==== Starting core.php====";
cd /home/`whoami`/TPM/mods/999dice
php core.php test
ec=$?
echo " [ExitCode]: $ec";
if [ "$ec" == "0" ];
then
    screen -dm php core.php
else
    echo "Oups, sombody forget to configure 999dice";
    bash config.sh
    bash start.sh
fi
echo "==== core.php started ====";
echo "==== api starting ====";
cd /home/`whoami`/TPM/mods/999dice/api
screen -dm php -S 127.0.0.1:`cat port.txt`
echo "==== api started ====";
