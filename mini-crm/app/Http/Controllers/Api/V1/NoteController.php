<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        return response()->json(Note::paginate(15));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'nullable|exists:customers,id',
            'deal_id' => 'nullable|exists:deals,id',
            'content' => 'required|string',
        ]);
        $note = Note::create($validated);
        return response()->json($note, 201);
    }

    public function show(string $id)
    {
        $note = Note::find($id);
        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }
        return response()->json($note, 200);
    }

    public function update(Request $request, string $id)
    {
        $note = Note::find($id);
        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'customer_id' => 'sometimes|nullable|exists:customers,id',
            'deal_id' => 'sometimes|nullable|exists:deals,id',
            'content' => 'sometimes|string',
        ]);
        $note->update($validated);
        return response()->json($note, 200);
    }

    public function destroy(string $id)
    {
        $note = Note::find($id);
        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }
        $note->delete();
        return response()->json(['message' => 'Note deleted successfully'], 200);
    }
}


