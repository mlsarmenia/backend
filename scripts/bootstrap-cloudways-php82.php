<?php

$releaseRoot = dirname(__DIR__);
$envPath = $releaseRoot . '/.env';

if (!is_link($envPath)) {
    return;
}

$productionEnv = realpath($envPath);
$normalizedProductionRoot = $productionEnv === false
    ? ''
    : str_replace('\\', '/', dirname($productionEnv));

if (!str_ends_with($normalizedProductionRoot, '/bvcxzudysy/public_html')) {
    fwrite(STDERR, "Refusing to bootstrap an unexpected Cloudways application path.\n");
    exit(1);
}

$files = [
    'vendor/composer/platform_check.php',
    'app/Services/CurrencyRateService.php',
];

foreach ($files as $relativePath) {
    $source = $releaseRoot . '/' . $relativePath;
    $target = $normalizedProductionRoot . '/' . $relativePath;

    if (!is_file($source) || !is_file($target) || !copy($source, $target)) {
        fwrite(STDERR, "Unable to bootstrap {$relativePath}.\n");
        exit(1);
    }
}

echo "Prepared the installed release for the PHP 8.2 maintenance command.\n";
