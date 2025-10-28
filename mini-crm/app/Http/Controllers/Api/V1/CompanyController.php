<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
 
    class CompanyController extends Controller
    {
    public function index()
    {
        return response()->json(Company::paginate(15), 200);
        }
    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
        
        $company=Company::create($validatedData);
        return response()->json([
            'success'=> true,
            'data'=>$company
        ], 201);
    }   
    public function update(Request $request, string $id)
    {
        
            $validatedData = $request->validate([
                'name' => 'sometimes|string|max:255',
                'number' => 'sometimes|string|max:255',
                'website' => 'sometimes|string|max:255',
                'address' => 'sometimes|string|max:255',
            ]);
            
    
        $company = Company::find($id);
        if (!$company) {
            return response()->json([
                'success'=> false,
                'message'=> 'Company not found'
            ], 404);
        }
        $company->update($validatedData);
        return response()->json([
            'success'=> true,
            'data'=>$company
        ], 200);
    }
    public function show(string $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }
        return response()->json($company, 200);
    }
    public function destroy(string $id){
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }
        $company->delete();
        return response()->json(['message' => 'Company deleted successfully'], 200);
    }
    }   
    