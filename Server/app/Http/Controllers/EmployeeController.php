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
        
        $employees = Employee::all();
        return response()->json($employees);
    }
    public function show($id)
    {
        $employee = Employee::find($id);
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
}
