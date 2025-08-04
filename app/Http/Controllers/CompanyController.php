<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Company::with('user')->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'employees' => 'required|integer',
        ]);

        $company = $request->user()->companies()->create($request->only('name', 'employees'));

        return response()->json(['message' => 'Company created', 'company' => $company]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'employees' => 'required|integer',
        ]);

        $company->update($request->only('name', 'employees'));

        return response()->json(['message' => 'Company updated', 'company' => $company]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(['message' => 'Company deleted']);
    }
}
