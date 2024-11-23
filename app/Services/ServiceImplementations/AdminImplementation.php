<?php

namespace App\Services\ServiceImplementations;

use App\Repositories\RepositoryInterfaces\AdminRepoInterface;
use App\Services\ServiceInterfaces\AdminInterface;

class AdminImplementation implements AdminInterface {

    protected $adminRepo;

    public function __construct(AdminRepoInterface $adminRepo) {
        $this->adminRepo = $adminRepo;
    }

}


?>