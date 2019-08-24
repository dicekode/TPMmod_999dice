echo "Installing composer";
curl -sS https://getcomposer.org/installer | php
echo "Installing 999dice.";
php composer.phar require reilag/999dice
echo "Installing react";
php composer.phar require react/react:^1.0
echo "All done"
exit
