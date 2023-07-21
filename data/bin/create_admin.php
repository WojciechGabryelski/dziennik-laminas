<?php
// data/bin/create_admin.php <firstName> <lastName>
global $entityManager;

use GradeBook\Entity\Admin;

require_once "bootstrap.php";

$newAdminFirstName = $argv[1];
$newAdminLastName = $argv[2];

$admin = new Admin();
$admin->setFirstName($newAdminFirstName);
$admin->setLastName($newAdminLastName);

$entityManager->persist($admin);
$entityManager->flush();

echo "Created Admin with ID " . $admin->getId() . "\n";

