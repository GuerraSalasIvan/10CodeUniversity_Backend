<?php

namespace App\Http\Services\Private;

use App\Repositories\UserRepository;
use App\Models\Event;
use App\Models\Ubication;

use Illuminate\Support\Carbon;
use Illuminate\Support\ValidatedInput;


class DashboardService
{
    public function index()
    {
        $event = Event::where('available_at', '>', now())
                ->orderByRaw('available_at - NOW()')
                ->simplePaginate(4);

        return response()->json($event, 200);
    }

}
