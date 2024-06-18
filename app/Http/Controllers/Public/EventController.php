<?php

namespace App\Http\Controllers\Public;

use App\Http\Services\Public\EventService;
use App\Http\Requests\EventRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Event;
use Carbon\Carbon;


class EventController extends Controller
{

    private $service;

    public function __construct()
    {
        $this->service = new EventService();
    }


    public function index()
    {
        return $this->service->index();
    }

    public function home()
    {
        return $this->service->home();
    }

    public function eventList()
    {
        return $this->service->eventList();
    }


    public function store(Request $request)
    {
        return $this->service->store($request);
    }


    public function show(string $id)
    {
        return $this->service->show($id);
    }


    public function update(EventRequest $request, string $id)
    {
        return $this->service->update($request->safe()->all(), $id);
    }


    public function destroy(string $id)
    {
    return $this->service->destroy($id);
    }

}
