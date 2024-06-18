<?php

namespace App\Http\Services\Public;

use App\Repositories\UserRepository;
use App\Models\Ubication;
use App\Http\Requests\UbicationRequest;

use Illuminate\Support\Carbon;
use Illuminate\Support\ValidatedInput;


class UbicationService
{
    public function index()
    {
        $ubication = Ubication::all();
        $ubication->each(function ($ubication) {
            $ubication->imageURL = $ubication->getFirstMediaURL();
        });
        return response()->json($ubication, 200);
    }

    public function show(string $id)
    {
        $ubication = Ubication::find($id);

        $ubication->imageURL = $ubication->getFirstMediaURL();

        $disabledDates = [];
        $events = [];

        if($ubication->events()){

            $events = $ubication->events()->where('finish_at', '>', now())->get();

            foreach ($events as $event) {
                $event->imageURL = $event->getFirstMediaURL();

                $startDate = date('Y-m-d', strtotime($event->available_at));
                $endDate = date('Y-m-d', strtotime($event->finish_at));
                $disabledDates[] = [
                    'start' => $startDate,
                    'end' => $endDate,
                ];
            }
        }


        return response()->json([
            'ubication' => $ubication,
            'events' => $events,
            'disabledDates'=> $disabledDates,
        ], 200);
    }


    public function store(UbicationRequest $request)
    {
        try {
            $ubication = new Ubication();
            $ubication->place = $request->input('place');
            $ubication->code = str_replace(' ', '_', strtolower($request->input('place')));
            $ubication->place_description = $request->input('place_description');
            $ubication->address = $request->input('address');
            $ubication->capacity = $request->input('capacity');
            $ubication->opens_at = $request->input('opens_at');
            $ubication->closes_at = $request->input('closes_at');

            $ubication->save();

            $ubication->addMedia( $request->image )->toMediaCollection();

            return response()->json($ubication, 201);
        } catch (Exception $e) {
            Log::error('Error creating location: ' . $e->getMessage());
            return response()->json(['message' => 'Error creating location'], 500);
        }
    }

    public function destroy(string $id)
    {
        $ubication = Ubication::find($id);
        $ubication->events->each->delete();
        $ubication->delete();
        return response()->json($ubication, 201);
    }
}
