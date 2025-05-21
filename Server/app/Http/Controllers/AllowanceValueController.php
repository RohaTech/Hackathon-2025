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
        $allowances = AllowanceValue::all();
        return response()->json($allowances);
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
    public function update(Request $request,   $id)
    {

        $allowanceValue = AllowanceValue::find($id);

        $validatedData = $request->validate([
            'allowances_name' => 'sometimes|string|required|max:255',
            'ceo' => 'sometimes|numeric|nullable',
            'coo' => 'sometimes|numeric|nullable',
            'cto' => 'sometimes|numeric|nullable',
            'ciso' => 'sometimes|numeric|nullable',
            'director' => 'sometimes|numeric|nullable',
            'dept_lead' => 'sometimes|numeric|nullable',
            'normal_employee' => 'sometimes|numeric|nullable',
            'positioned' => 'sometimes|numeric|nullable',
            'non_positioned' => 'sometimes|numeric|nullable',

        ]);

        $allowanceValue->update($validatedData);

        return response()->json([
            'message' => 'Allowance updated successfully',
            'allowance' => $allowanceValue
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $allowanceValue = AllowanceValue::find($id);
        return $allowanceValue->delete();
    }
}
