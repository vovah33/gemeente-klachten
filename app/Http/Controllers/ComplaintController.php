<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required','string','min:5','max:100'],
            'description' => ['nullable','string','min:20'],
            'category' => ['required', Rule::in(['afval','verlichting','wegen','groen','overlast'])],
            'lat' => ['required','numeric'],
            'lng' => ['required','numeric'],
            'reporter_name' => ['required','string','max:255'],
            'reporter_email' => ['required','email','max:255'],
            'photos' => ['nullable','array','max:3'],
            'photos.*' => ['file','mimes:jpg,jpeg,png,webp','max:10240'],
        ]);

        $validated['user_id'] = Auth::id();

        $complaint = Complaint::create($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $upload) {
                if (!$upload) continue;
                $dir = "complaints/{$complaint->id}";
                $filename = uniqid().'.'.$upload->getClientOriginalExtension();
                $path = $upload->storeAs($dir, $filename, 'public');
                ComplaintPhoto::create([
                    'complaint_id' => $complaint->id,
                    'path' => $path, // relative to storage/app/public
                ]);
            }
        }

        return redirect()->route('complaints.mine')
            ->with('success', 'Klacht succesvol ingediend.');
    }

    public function myIndex(Request $request)
    {
        $complaints = Complaint::where('user_id', Auth::id())
            ->latest()->paginate(10);
        return view('complaints.my', compact('complaints'));
    }

    public function showMine(Complaint $complaint)
    {
        $this->authorize('view', $complaint);
        return view('complaints.show_mine', compact('complaint'));
    }
}

