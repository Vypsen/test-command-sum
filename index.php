#!/usr/bin/php
<?php

require __DIR__ . '/vendor/autoload.php';

use Console\Commands\GetSumCountAllFilesCommand;
use Symfony\Component\Console\Application;

$app = new Application();
$app->add(new GetSumCountAllFilesCommand());
$app->run();