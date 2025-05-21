<?php

namespace App\Http\Controllers;

use App\Models\AllowanceValue;
use Illuminate\Http\Request;


class AllowanceValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'allowances_name' => 'string|required|max:255',
            'ceo' => 'numeric|nullable',
            'coo' => 'numeric|nullable',
            'cto' => 'numeric|nullable',
            'ciso' => 'numeric|nullable',
            'director' => 'numeric|nullable',
            'dept_lead' => 'numeric|nullable',
            'normal_employee' => 'numeric|nullable',
            'positioned' => 'numeric|nullable',
            'non_positioned' => 'numeric|nullable',

        ]);

        $allowanceValue = AllowanceValue::create(
            $validatedData
        );

        return response()->json([
            'allowanceValue' => $allowanceValue,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AllowanceValue $allowanceValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AllowanceValue $allowanceValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AllowanceValue $allowanceValue)
    {
        //
    }
}
