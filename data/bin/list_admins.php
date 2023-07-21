<?php
// data/bin/list_admins.php
global $entityManager;

use GradeBook\Entity\Admin;

require_once "bootstrap.php";

$adminRepository = $entityManager->getRepository(Admin::class);
$admins = $adminRepository->findAll();

foreach ($admins as $admin) {
    echo sprintf("-%s %s\n", $admin->getFirstName(), $admin->getLastName());
}