<?php
// Set the environment variable for Composer's home directory
putenv('COMPOSER_HOME=' . __DIR__ . '/composer');

// Download the Composer installer
copy('https://getcomposer.org/installer', 'composer-setup.php');

// Run the Composer installer
system('php composer-setup.php');

// Remove the Composer installer script
unlink('composer-setup.php');

// Run the Composer command to install the desired package
system('php composer.phar require kreait/firebase-php:6.1.0');

// Remove Composer if you no longer need it (optional)
// unlink('composer.phar');
?>
