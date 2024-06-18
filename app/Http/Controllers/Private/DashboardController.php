<?php

namespace App\Http\Controllers\Private;

use App\Http\Services\Private\DashboardService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new DashboardService();
    }


    public function index()
    {
        return $this->service->index();
    }
}
