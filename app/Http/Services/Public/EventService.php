<?php

namespace App\Http\Services\Public;

use App\Repositories\UserRepository;
use App\Models\Event;
use App\Models\Ubication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Carbon;
use Illuminate\Support\ValidatedInput;


class EventService
{
    public function index()
    {
        $events = Event::all();
        $events->each(function ($event) {
            $event->imageURL = $event->getFirstMediaURL();
        });
        $event1 = Event::find(1);
        return response()->json($events, 200);
    }

    public function eventList()
    {
        $events = Event::paginate(9);

        $events->each(function ($event) {
            $event->imageURL = $event->getFirstMediaURL();
        });

        return response()->json($events, 200);
    }



    public function home()
    {
        $events = Event::where('available_at', '>', now())
                    ->orderByRaw('available_at - NOW()')
                    ->simplePaginate(3);

        $events->each(function ($event) {
            $event->imageURL = $event->getFirstMediaURL();
        });
        return response()->json($events, 200);
    }

    public function show(string $id)
    {
        $events = Event::find($id);

        $events->imageURL = $events->getFirstMediaURL();

        $ubication = $events->ubications;

        return response()->json($events, 200);
    }

    public function store(Request $request)
    {
        try {
            $event = new Event();
            $event->title = $request->input('title');
            $event->code = str_replace(' ', '_', strtolower($request->input('title')));
            $event->description = $request->input('description');
            $event->organizator = $request->input('organizator');
            $event->available_at = $request->input('available_at');
            $event->finish_at = $request->input('finish_at');
            $event->ubication_id = $request->input('ubication_id');
            $event->capacity = $request->input('capacity');

            $event->save();

            $event->addMedia( $request->image)->toMediaCollection();

            return response()->json($event, 201);
        } catch (Exception $e) {
            Log::error('Error creating event: ' . $e->getMessage());
            return response()->json(['message' => 'Error creating event'], 500);
        }
    }

    public function update(Array $request, $id)
    {
        \Log::info($request);

        $event = Event::findOrFail($id);

        // Actualizar los datos del evento
        $event->title = $request['title'];
        $event->description = $request['description'];
        $event->organizator = $request['organizator'];
        $event->capacity = $request['capacity'];
        $event->ubication_id = $request['ubication_id'];

        $availableAt = Carbon::parse($request['available_at'])->format('Y-m-d H:i:s');
        $finishAt = Carbon::parse($request['finish_at'])->format('Y-m-d H:i:s');

        $event->available_at = $availableAt;
        $event->finish_at = $finishAt;


        if (!empty($request['image'])) {

            $event->clearMediaCollection();

            $imageData = $request['image'];
            $imageData = substr($imageData, strpos($imageData, ",") + 1);
            $imageData = base64_decode($imageData);
            $fileName = 'image_' . time() . '.png';
            $filePath = 'images/' . $fileName;

            \Storage::disk('public')->put($filePath, $imageData);

            $event->addMedia(storage_path('app/public/' . $filePath))
                ->toMediaCollection();
        }

        $event->save();

        return response()->json(['message' => 'Event updated successfully!', 'event' => $event]);
    }






    public function destroy(string $id)
    {
        $event = Event::find($id)->delete();
        return response()->json($event, 201);
    }
}

