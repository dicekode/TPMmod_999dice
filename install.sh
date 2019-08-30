cd "/home/`whoami`/TPM/mods/999dice"
echo "Installing unzip";
sudo apt install unzip -y
echo "Installing php extensions";
sudo apt-get install php-pear php-zip php-curl php-gd php-mysql php-xml php-mbstring -y
echo "Installing composer";
curl -sS https://getcomposer.org/installer | php
echo "Installing 999dice.";
php composer.phar require reilag/999dice
# echo "Installing react";
# php composer.phar require react/react:^1.0
echo "All done"
exit
