<?php

$minPhpVersion = '8.1';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    exit(sprintf('Your PHP version must be %s or higher. Current version: %s', $minPhpVersion, PHP_VERSION));
}

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

if (getcwd() !== FCPATH) {
    chdir(FCPATH);
}

 

require FCPATH . '../vendor/autoload.php';
require FCPATH . '../app/Config/Paths.php';

$paths = new Config\Paths();
exit(CodeIgniter\Boot::bootWeb($paths));
