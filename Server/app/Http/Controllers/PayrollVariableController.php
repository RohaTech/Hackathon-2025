<?php

namespace App\Http\Controllers;

use App\Models\PayrollVariable;
use Illuminate\Http\Request;


class PayrollVariableController extends Controller
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
            'position' => 'required|max:255',
            'transport_allowance' => 'numeric',
            'position_allowance' => 'numeric',

        ]);

        $payroll_variable = PayrollVariable::create([
            'position' => $validatedData['position'],
            'transport_allowance' => $validatedData['transport_allowance'],
            'position_allowance' => $validatedData['position_allowance'],
        ]);

        return response()->json([
            'payroll_variable' => $payroll_variable,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PayrollVariable $payrollVariable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request  $request, PayrollVariable $payrollVariable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayrollVariable $payrollVariable)
    {
        //
    }
}
