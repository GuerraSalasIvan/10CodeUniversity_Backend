<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Public\UbicationService;
use App\Http\Requests\UbicationRequest;

class UbicationController extends Controller
{

    private $service;

    public function __construct()
    {
        $this->service = new UbicationService();
    }

    function index()
    {
        return $this->service->index();
    }


    public function store(UbicationRequest $request)
    {
        return $this->service->store($request);
    }


    public function show(string $id)
    {
        return $this->service->show($id);
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}
