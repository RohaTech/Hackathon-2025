<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        $accounts = Account::all();
        return response()->json($accounts);
    }

    public function show($id){
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }
        return response()->json($account);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'account_number' => 'required|string|max:255',
            'balance' => 'required|string|max:255',
        ]);

        $account = Account::create($validated);
        return response()->json($account, 201);
    }
    public function update(Request $request, $id){
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        $request->validate([
            'account_number' => 'sometimes|required|string|max:255',
            'balance' => 'sometimes|required|string|max:255',
        ]);

        $account->update($request->all());
        return response()->json($account);
    }
    public function destroy($id){
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }
        $account->delete();
        return response()->json(['message' => 'Account deleted successfully']);
    }
    
}
