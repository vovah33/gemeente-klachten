<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('admin.map.index');
    }

    public function data(Request $request)
    {
        $complaints = Complaint::select(['id','title','status','lat','lng','category'])
            ->latest()->get();

        $items = $complaints->map(function ($c) {
            return [
                'id' => $c->id,
                'title' => $c->title,
                'status' => $c->status,
                'lat' => (float) $c->lat,
                'lng' => (float) $c->lng,
                'category' => $c->category,
                'url' => route('admin.complaints.show', $c),
            ];
        });

        return response()->json($items);
    }
}

