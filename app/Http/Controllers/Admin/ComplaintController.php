<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintNote;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::query()->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }
        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }
        if ($request->filled('q')) {
            $id = (int) $request->input('q');
            if ($id > 0) {
                $query->where('id', $id);
            }
        }

        $complaints = $query->paginate(12)->withQueryString();
        return view('admin.complaints.index', compact('complaints'));
    }

    public function show(Complaint $complaint)
    {
        return view('admin.complaints.show', compact('complaint'));
    }

    public function resolve(Request $request, Complaint $complaint)
    {
        $request->validate([
            'note' => ['nullable','string']
        ]);

        $complaint->update([
            'status' => 'opgelost',
            'resolved_at' => now(),
        ]);

        if ($request->filled('note')) {
            ComplaintNote::create([
                'complaint_id' => $complaint->id,
                'admin_id' => $request->user()->id,
                'content' => (string)$request->input('note'),
            ]);
        }

        return back()->with('success', 'Klacht gemarkeerd als opgelost.');
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return redirect()->route('admin.complaints.index')
            ->with('success', 'Klacht verwijderd.');
    }
}

