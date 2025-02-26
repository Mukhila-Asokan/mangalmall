<?php

/*
exec('/usr/bin/php /var/www/vhosts/zusan.in/httpdocs/mangalmall/composer.phar dump-autoload'); // Or the correct path
echo "Autoload complete.";


*/


$projectRoot = __DIR__;  // Current directory

$composerPath = $projectRoot . '/composer.phar'; // Or the full path if it's elsewhere

// Example with full path (replace with your actual path):
$composerPath = '/var/www/vhosts/zusan.in/httpdocs/mangalmall/composer.phar';


if (!file_exists($composerPath)) {
    die("Error: composer.phar not found at: $composerPath");
}

$phpPath = '/opt/plesk/php/8.2/bin/php'; // **Corrected PHP path**

if (!file_exists($phpPath)) {
    die("Error: PHP binary not found at: $phpPath");
}

$output = [];
$return_var = null;

exec("$phpPath $composerPath dump-autoload", $output, $return_var);

if ($return_var !== 0) {
    die("Error running composer dump-autoload. Output: " . implode("\n", $output));
}

echo "Autoload complete.\n";

?>