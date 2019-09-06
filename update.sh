echo "Updating...";
cd "/home/`whoami`/TPM/mods/betmeup";
php composer.phar update;
git pull
