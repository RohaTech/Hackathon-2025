<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EmployeeController extends Controller
{
    public function index()
    {
        
        $employees = Employee::with('account')->get();
        return response()->json($employees);
    }
    public function show($id)
    {
        $employee = Employee::with('account')->find($id);
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        return response()->json($employee);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            "gender" => 'required|string|max:255',
            "email" => 'required|email|max:255|unique:employees',
            'employement_type' => 'required|string|max:255|in:full_time,part_time',
            "position" => 'required|string|max:255|in:ceo,coo,cto,ciso,director,dept_lead,normal_employee',
            "employement_date" => 'required|date',
            "basic_salary" => 'required|numeric',
            "account_number" => 'required|string|max:255',
            "balance" => 'required|numeric',
        ]);
        
        return DB::transaction(function () use ($validatedData) {
            $account = Account::create([
                'account_number' => $validatedData['account_number'],
                'balance' => $validatedData['balance'],
            ]);
            $employee = Employee::create([
                'name' => $validatedData['name'],
                'gender' => $validatedData['gender'],
                'email' => $validatedData['email'],
                'employement_type' => $validatedData['employement_type'],
                'position' => $validatedData['position'],
                'employement_date' => $validatedData['employement_date'],
                'basic_salary' => $validatedData['basic_salary'],
                'bank_account_id' => $account->id,
            ]);
           
         return response()->json([
                    'account' => $account,
                    'employee' => $employee,
                ], 201);
        });
    }  
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'gender' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255|unique:employees,email,' . $id,
            'employement_type' => 'sometimes|required|string|max:255|in:full_time,part_time',
            'position' => 'sometimes|required|string|max:255|in:ceo,coo,cto,ciso,director,dept_lead,normal_employee',
            'employement_date' => 'sometimes|required|date',
            'basic_salary' => 'sometimes|required|numeric',
            'account_number' => 'sometimes|required|string|max:255',
            'balance' => 'sometimes|required|numeric',
        ]);
        // dd($request->all());
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        $account = Account::find($employee->bank_account_id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }
        $employee->update($validatedData);
        $account->update([
            'account_number' => $validatedData['account_number'] ?? $account->account_number,
            'balance' => $validatedData['balance'] ?? $account->balance,
        ]);
        return response()->json([
            'account' => $account,
            'employee' => $employee,
        ]);
    }
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        $account = Account::find($employee->bank_account_id);
        if ($account) {
            $account->delete();
        }
        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
