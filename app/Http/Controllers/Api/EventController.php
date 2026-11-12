<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /** Columns a client may sort on; anything else falls back to the default order. */
    private const SORTABLE = ['id', 'name', 'date', 'location', 'created_at'];

    public function index(Request $request)
    {
        $sort = $request->get('sort');

        // The sort column comes from a fixed list and goes through the query builder, never into raw SQL.
        $events = in_array($sort, self::SORTABLE, true) ?
            Event::query()->orderBy($sort)->get() :
            Event::all();

        return response()->json($events);
    }
}
