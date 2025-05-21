<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\AllowanceValue;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payrolls = Payroll::with('employee')->get();

        return response()->json([
            'status' => 'success',
            'payrolls' => $payrolls,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        
        $earned_salary = $request->working_days * ($employee->basic_salary/30);
        
        $allowances = Allowance::all();
        dd($allowances);
        $allowanceCollection = [];
        foreach($allowances as $allowance){
            
            
            
            if($employee->position == "ceo" && $allowance->ceo != NULL){
                $allowanceValue = AllowanceValue::where('allowances_name', $allowance->allowances_name)->first();
                dd($allowanceValue, $allowance);
                // $allowances = $allowances->where('ceo', '!=', 0)->sum('ceo');
            }
            
        }
        $other_commissions = $request->other_commissions;
        // if($employee->position == "ceo"){
        //     $allowanceValue = AllowanceValue::where('allowances_name', 'ceo')->first();
        //     $allowances = $allowances->where('ceo', '!=', 0)->sum('ceo');
        // }else if($employee->position == "cto"){ 
        //     $allowances = $allowances->where('cto', '!=', 0)->sum('cto');
        // }else if($employee->position == "coo"){
        //     $allowances = $allowances->where('coo', '!=', 0)->sum('coo');
        // }else if($employee->position == "ciso"){
        //     $allowances = $allowances->where('ciso', '!=', 0)->sum('ciso');
        // }else if($employee->position == "director"){
        //     $allowances = $allowances->where('director', '!=', 0)->sum('director');
        // }else if($employee->position == "dept_lead"){
        //     $allowances = $allowances->where('dept_lead', '!=', 0)->sum('dept_lead');
        // }else if($employee->position == "normal_employee"){
        //     $allowances = $allowances->where('normal_employee', '!=', 0)->sum('normal_employee');
        // }else if($employee->position == "positioned"){
        //     $allowances = $allowances->where('positioned', '!=', 0)->sum('positioned');
        // }else if($employee->position == "non_positioned"){
        //     $allowances = $allowances->where('non_positioned', '!=', 0)->sum('non_positioned');
        // }else{
        //     $allowances = 0;
        // }
        // $gross_pay = $earned_salary + $allowances + $other_commissions;
        // $taxable_income = $gross_pay - ($employee->account->balance ?? 0);

        // $validated = $request->validate([
        //     'employee_id' => 'required|exists:employees,id',
        //     'working_days' => 'required|integer',
        //     'earned_salary' => 'required|numeric',
        //     'allowances' => 'required|numeric',
        //     'other_commissions' => 'required|numeric',
        //     'gross_pay' => 'required|numeric',
        //     'taxable_income' => 'required|numeric',
        //     'income_tax' => 'required|numeric',
        //     'employee_pension' => 'required|numeric',
        //     'employer_pension' => 'required|numeric',
        //     'loan_or_penality' => 'required|numeric',
        //     'total_deductions' => 'required|numeric',
        //     'net_pay' => 'required|numeric',
        // ]);

        // $payroll = Payroll::create($validated);

        // return response()->json([
        //     'status' => 'success',
        //     'payroll' => $payroll,
        // ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        return response()->json([
            'status' => 'success',
            'payroll' => $payroll,
        ]);}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payroll $payroll)
    {
        $validated = $request->validate([
            'employee_id' => 'sometimes|required|exists:employees,id',
            'working_days' => 'sometimes|required|integer',
            'earned_salary' => 'sometimes|required|numeric',
            'allowances' => 'sometimes|required|numeric',
            'other_commissions' => 'sometimes|required|numeric',
            'gross_pay' => 'sometimes|required|numeric',
            'taxable_income' => 'sometimes|required|numeric',
            'income_tax' => 'sometimes|required|numeric',
            'employee_pension' => 'sometimes|required|numeric',
            'employer_pension' => 'sometimes|required|numeric',
            'loan_or_penality' => 'sometimes|required|numeric',
            'total_deductions' => 'sometimes|required|numeric',
            'net_pay' => 'sometimes|required|numeric',
        ]);

        $payroll->update($validated);

        return response()->json([
            'status' => 'success',
            'payroll' => $payroll,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        //
    }
}
