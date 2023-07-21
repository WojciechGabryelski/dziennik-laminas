<?php
// data/bin/doctrine.php
global $entityManager;

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// Adjust this path to your actual bootstrap.php
require __DIR__ . '/bootstrap.php';

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
