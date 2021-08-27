<?php
namespace App\Controllers;

use App\Models\Dashboard;
use App\Services\Utils;

class DashboardController {

    public function __construct()
    {
        $this->dashboard = new Dashboard();
    }

    /**
     * Display onde dashboard.
     */
    public function show($id) {
        echo $this->dashboard->findOne($id);
    }
}