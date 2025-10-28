<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Deal::paginate(15), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'status' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id',
            'company_id' => 'required|exists:companies,id',
        ]);
        $deal = Deal::create($validatedData);
        return response()->json([
            'success'=> true,
            'data'=>$deal
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $deal = Deal::find($id);
        if (!$deal) {
            return response()->json(['error' => 'Deal not found'], 404);
        }
        return response()->json($deal, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:255',
            'amount' => 'sometimes|numeric',
            'status' => 'sometimes|string|max:255',
            'customer_id' => 'sometimes|exists:customers,id',
            'company_id' => 'sometimes|exists:companies,id',
        ]);
        $deal = Deal::find($id);
        if (!$deal) {
            return response()->json(['error' => 'Deal not found'], 404);
        }
        $deal->update($validatedData);
        return response()->json([
            'success'=> true,
            'data'=>$deal
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deal = Deal::find($id);
        if (!$deal) {
            return response()->json(['error' => 'Deal not found'], 404);
        }
        $deal->delete();
        return response()->json(['message' => 'Deal deleted successfully'], 200);
    }
}
