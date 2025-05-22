<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Allowance;
use App\Models\AllowanceValue;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'working_days' => 'required|integer',
            'other_commissions' => 'nullable|numeric',
            'loan_or_penality' => 'nullable|numeric',
            'month' => 'required|string|max:255',
        ]);
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
            }else if($employee->position == "normal_employee" && $allowance->non_positioned != NULL){
                $allowanceValue = AllowanceValue::where('allowances_name', $allowance->allowances_name)->first();
                if($allowance->isPercent){
                    $netAllowance = $allowanceValue->non_positioned - ($allowance->non_positioned * $employee->basic_salary / 100);
                }
                else{
                    $netAllowance = $allowanceValue->non_positioned - $allowance->non_positioned;
                }
                $allowanceCollection[] = [
                    "allowances_name" => $allowance->allowances_name,
                    "taxable" => $netAllowance > 0 ? $netAllowance : 0,
                    "non_taxable" => $netAllowance <= 0 ? $allowanceValue->non_positioned : $allowanceValue->non_positioned - $netAllowance,
                ];
            }else if($employee->position !== "normal_employee" && $allowance->positioned != NULL){
                $allowanceValue = AllowanceValue::where('allowances_name', $allowance->allowances_name)->first();
                if($allowance->isPercent){
                    $netAllowance = $allowanceValue->positioned - ($allowance->positioned * $employee->basic_salary / 100);
                }
                else{
                    $netAllowance = $allowanceValue->positioned - $allowance->positioned;
                }
                $allowanceCollection[] = [
                    "allowances_name" => $allowance->allowances_name,
                    "taxable" => $netAllowance > 0 ? $netAllowance : 0,
                    "non_taxable" => $netAllowance <= 0 ? $allowanceValue->positioned : $allowanceValue->positioned - $netAllowance,
                ];
            }
        }
        // return response()->json([
        //     'status' => 'success',
        //     'allowances' => $allowanceCollection,
        // ]);
        
        $taxable_income = 0;
        $non_taxable_income = 0;
        $other_commissions = $request->other_commissions;
        foreach ($allowanceCollection as $allowance) {
            if ($allowance['taxable'] > 0 && $allowance['non_taxable'] > 0) {
                $taxable_income += $allowance['taxable'];
                $non_taxable_income += $allowance['non_taxable'];
            } 
            else if ($allowance['taxable'] > 0) {
                $taxable_income += $allowance['taxable'];
            }
            else if ($allowance['non_taxable'] > 0) {
                $non_taxable_income += $allowance['non_taxable'];
            }else{
                $non_taxable_income += 0;
            }
        }

        // dd($earned_salary);
        $other_commissions = $request->other_commissions;
        $gross_pay = $earned_salary + $taxable_income + $non_taxable_income + $other_commissions;
        // dd($gross_pay);

        $taxable_income = $gross_pay - $non_taxable_income;
        // dd($taxable_income);

        if($employee->basic_salary >0 && $employee->basic_salary <= 600){
            $income_tax = 0;
        }else if($employee->basic_salary > 600 && $employee->basic_salary <= 1650){
            $income_tax = $taxable_income * 0.1;
        }else if($employee->basic_salary > 1650 && $employee->basic_salary <= 3200){
            $income_tax = $taxable_income * 0.15;
        }else if($employee->basic_salary > 3200 && $employee->basic_salary <= 5250){
            $income_tax = $taxable_income * 0.2;
        }else if($employee->basic_salary > 5250 && $employee->basic_salary <= 7800){
            $income_tax = $taxable_income * 0.25;
        }else if($employee->basic_salary > 7800 && $employee->basic_salary <= 10900){
            $income_tax = $taxable_income * 0.3;
        }else if($employee->basic_salary > 10900){
            $income_tax = $taxable_income * 0.35;
        }


        if($employee->employement_type == "full_time"){
            $employee_pension = $employee->basic_salary * 0.07;
        }else if($employee->employement_type == "part_time"){
            $employee_pension = 0;
        }else{
            $employee_pension = 0;
            $employer_pension = 0;
        }

        $employer_pension = $employee->basic_salary * 0.11;
        if($request->loan_or_penality){
            $loan_or_penality = $request->loan_or_penality;
        }else{
            $loan_or_penality = 0;
        }
        $total_deductions = $income_tax + $employee_pension + $loan_or_penality;
        $net_pay = $gross_pay - $total_deductions;
        $month = $request->month;

        $payroll = Payroll::create([
            'employee_id' => $employee->id,
            'working_days' => $request->working_days,
            'earned_salary' => $earned_salary,
            'allowances' => json_encode($allowanceCollection),
            'other_commissions' => $other_commissions,
            'gross_pay' => $gross_pay,
            'taxable_income' => $taxable_income,
            'income_tax' => $income_tax,
            'employee_pension' => $employee_pension,
            'employer_pension' => $employer_pension,
            'loan_or_penality' => $loan_or_penality,
            'total_deductions' => $total_deductions,
            'net_pay' => $net_pay,
            'month' => $month,
        ]);

        return response()->json([
            'status' => 'success',
            'payroll' => $payroll         
        ], 201);


    }

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

    public function pay(Request $request)
    {
        DB::beginTransaction();
        try{
        $employerAccount = Account::where('account_number', '10088009400')->first();
        $taxAuthorityAccount = Account::where('account_number', '1001111222211')->first();
        $payrolls = Payroll::with('employee.account')->get();
        $results = [];
        foreach ($payrolls as $payroll) {
            $employee = $payroll->employee;
            $netPay = $payroll->net_pay ?? 0;
            $incomeTax = $payroll->income_tax ?? 0;

            if ($employerAccount && $netPay > 0) {
                $employerAccount->balance -= $netPay;
                $employerAccount->save();
            }

            if ($employee && $employee->bank_account_id && $netPay > 0) {
                $employeeAccount = Account::where('id', $employee->bank_account_id)->first();
                // dd($employeeAccount);
                if ($employeeAccount) {
                    $employeeAccount->balance += $netPay;
                    $employeeAccount->save();
                }
            }

            if ($taxAuthorityAccount && $incomeTax > 0) {
                $employerAccount->balance -= $incomeTax;
                $taxAuthorityAccount->balance += $incomeTax;
                $employerAccount->save();
                $taxAuthorityAccount->save();
            }
            $results[] = [
                'payroll_id' => $payroll->id,
                'employee_id' => $employee->id ?? null,
                'net_pay' => $netPay,
                'income_tax' => $incomeTax,
            ];
        }
        DB::commit();
        return response()->json([
            'status' => 'success',
            'message' => 'Payroll processed for all employees, balances and tax updated',
            'results' => $results,
        ]);
        } catch (\Exception $e) {
        DB::rollBack();
        return $e->getMessage();
        }
    }
}
