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
        $earned_salary = $request->working_days * ($employee->basic_salary / 30);
        // dd($earned_salary);

        $allowances = Allowance::all();
        // dd($allowances);
        $allowanceCollection = [];

        foreach ($allowances as $allowance) {
                
            if ($employee->position == "ceo" && $allowance->ceo != NULL) {
                $allowanceValue = AllowanceValue::where('allowances_name', $allowance->allowances_name)->first();
                // dd($allowanceValue);
                if($allowance->isPercent){
                    $netAllowance = $allowanceValue->ceo - ($allowance->ceo * $employee->basic_salary / 100);
                }
                else{
                    $netAllowance = $allowanceValue->ceo - $allowance->ceo;
                }
                $allowanceCollection[] = [
                    "allowances_name" => $allowance->allowances_name,
                    "taxable" => $netAllowance > 0 ? $netAllowance : 0,
                    "non_taxable" => $netAllowance <= 0 ? $allowanceValue->ceo : $allowanceValue->ceo - $netAllowance,
                ];
            }
           else if ($employee->position == "coo" && $allowance->coo != NULL) {
                $allowanceValue = AllowanceValue::where('allowances_name', $allowance->allowances_name)->first();
                if($allowance->isPercent){
                    $netAllowance = $allowanceValue->coo - ($allowance->coo * $employee->basic_salary / 100);
                }
                else{
                    $netAllowance = $allowanceValue->coo - $allowance->coo;
                }
                $allowanceCollection[] = [
                    "allowances_name" => $allowance->allowances_name,
                    "taxable" => $netAllowance > 0 ? $netAllowance : 0,
                    "non_taxable" => $netAllowance <= 0 ? $allowanceValue->coo : $allowanceValue->coo - $netAllowance,
                ];
            }
           else if ($employee->position == "cto" && $allowance->cto != NULL) {
                $allowanceValue = AllowanceValue::where('allowances_name', $allowance->allowances_name)->first();
                if($allowance->isPercent){
                    $netAllowance = $allowanceValue->cto - ($allowance->cto * $employee->basic_salary / 100);
                }
                else{
                    $netAllowance = $allowanceValue->cto - $allowance->cto;
                }
                $allowanceCollection[] = [
                    "allowances_name" => $allowance->allowances_name,
                    "taxable" => $netAllowance > 0 ? $netAllowance : 0,
                    "non_taxable" => $netAllowance <= 0 ? $allowanceValue->cto : $allowanceValue->cto - $netAllowance,
                ];
            }
           else if ($employee->position == "ciso" && $allowance->ciso != NULL) {
                $allowanceValue = AllowanceValue::where('allowances_name', $allowance->allowances_name)->first();
                if($allowance->isPercent){
                    $netAllowance = $allowanceValue->ciso - ($allowance->ciso * $employee->basic_salary / 100);
                }
                else{
                    $netAllowance = $allowanceValue->ciso - $allowance->ciso;
                }
                $allowanceCollection[] = [
                    "allowances_name" => $allowance->allowances_name,
                    "taxable" => $netAllowance > 0 ? $netAllowance : 0,
                    "non_taxable" => $netAllowance <= 0 ? $allowanceValue->ciso : $allowanceValue->ciso - $netAllowance,
                ];
            }
           else if ($employee->position == "director" && $allowance->director != NULL) {
                $allowanceValue = AllowanceValue::where('allowances_name', $allowance->allowances_name)->first();
                if($allowance->isPercent){
                    $netAllowance = $allowanceValue->director - ($allowance->director * $employee->basic_salary / 100);
                }
                else{
                    $netAllowance = $allowanceValue->director - $allowance->director;
                }
                $allowanceCollection[] = [
                    "allowances_name" => $allowance->allowances_name,
                    "taxable" => $netAllowance > 0 ? $netAllowance : 0,
                    "non_taxable" => $netAllowance <= 0 ? $allowanceValue->director : $allowanceValue->director - $netAllowance,
                ];
            }
           else if ($employee->position == "dept_lead" && $allowance->dept_lead != NULL) {
                $allowanceValue = AllowanceValue::where('allowances_name', $allowance->allowances_name)->first();
                if($allowance->isPercent){
                    $netAllowance = $allowanceValue->dept_lead - ($allowance->dept_lead * $employee->basic_salary / 100);
                }
                else{
                    $netAllowance = $allowanceValue->dept_lead - $allowance->dept_lead;
                }
                $allowanceCollection[] = [
                    "allowances_name" => $allowance->allowances_name,
                    "taxable" => $netAllowance > 0 ? $netAllowance : 0,
                    "non_taxable" => $netAllowance <= 0 ? $allowanceValue->dept_lead : $allowanceValue->dept_lead - $netAllowance,
                ];
            }
           else if ($employee->position == "normal_employee" && $allowance->normal_employee != NULL) {
                $allowanceValue = AllowanceValue::where('allowances_name', $allowance->allowances_name)->first();
                if($allowance->isPercent){
                    $netAllowance = $allowanceValue->normal_employee - ($allowance->normal_employee * $employee->basic_salary / 100);
                }
                else{
                    $netAllowance = $allowanceValue->normal_employee - $allowance->normal_employee;
                }
                $allowanceCollection[] = [
                    "allowances_name" => $allowance->allowances_name,
                    "taxable" => $netAllowance > 0 ? $netAllowance : 0,
                    "non_taxable" => $netAllowance <= 0 ? $allowanceValue->normal_employee : $allowanceValue->normal_employee - $netAllowance,
                ];
            }
        }
        return response()->json([
            'status' => 'success',
            'allowances' => $allowanceCollection,
        ]);
        
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
        ]);
    }

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
