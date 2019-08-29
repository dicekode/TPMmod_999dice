echo "==== Starting core.php====";
cd /home/`whoami`/TPM/mods/999dice
php core.php
ec=$?
echo "==== core.php exited ====";
exit $ec
