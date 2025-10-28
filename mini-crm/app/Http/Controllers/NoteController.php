<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $query = Note::with(['customer', 'deal', 'user']);
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('content', 'like', '%' . $request->search . '%');
            });
        }
        
        $notes = $query->orderBy('created_at', 'desc')->paginate(15);
        $customers = Customer::all();
        $deals = Deal::all();
        $users = User::all();
        
        return view('notes.index', compact('notes', 'customers', 'deals', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'nullable|exists:customers,id',
            'deal_id' => 'nullable|exists:deals,id',
            'content' => 'required|string',
        ]);

        Note::create($validated);

        return redirect()->route('notes.index')->with('success', 'Note created successfully!');
    }

    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);
        
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'nullable|exists:customers,id',
            'deal_id' => 'nullable|exists:deals,id',
            'content' => 'required|string',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')->with('success', 'Note updated successfully!');
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Note deleted successfully!');
    }
}
