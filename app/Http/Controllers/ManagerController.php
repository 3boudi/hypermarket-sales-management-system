<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cashRegister;
use Illuminate\Support\Facades\Validator;

<?php

namespace App\Http\Controllers;

use App\Models\CashRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    /**
     * Add new cash register
     * POST /user/addCacheRegister
     */
    public function AddCacheRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supermarket_id' => 'required|exists:supermarkets,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $cashRegister = CashRegister::create([
            'supermarket_id' => $request->supermarket_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cash register added successfully',
            'data' => $cashRegister
        ]);
    }

    /**
     * Add new cashier and assign to cash register
     * POST /user/addCachier
     */
    public function AddCachier(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            'cash_register_id' => 'required|exists:cash_registers,id'
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one number and one special character'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $cashier = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'cashier'
        ]);

        // Assign to cash register through shifts table
        $cashier->cashRegisters()->attach($request->cash_register_id, [
            'start_at' => now(),
            'end_at' => null
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cashier added successfully',
            'data' => $cashier->load('cashRegisters')
        ]);
    }

    /**
     * Get all cashiers with their cash registers
     * GET /user/cashiers
     */
    public function showAllCashiers()
    {
        $cashiers = User::where('role', 'cashier')
                      ->with(['cashRegisters' => function($query) {
                          $query->with('supermarket');
                      }])
                      ->get();

        return response()->json([
            'status' => true,
            'data' => $cashiers
        ]);
    }

    /**
     * Delete cashier
     * DELETE /user/cashiers/{id}
     */
    public function deleteCashier($id)
    {
        $cashier = User::where('role', 'cashier')->find($id);

        if (!$cashier) {
            return response()->json([
                'status' => false,
                'message' => 'Cashier not found'
            ], 404);
        }

        // Remove from shifts table first
        $cashier->cashRegisters()->detach();
        $cashier->delete();

        return response()->json([
            'status' => true,
            'message' => 'Cashier deleted successfully'
        ]);
    }

    /**
     * Update cashier information
     * PUT /user/cashiers/{id}
     */
    public function editCashier(Request $request, $id)
    {
        $cashier = User::where('role', 'cashier')->find($id);

        if (!$cashier) {
            return response()->json([
                'status' => false,
                'message' => 'Cashier not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,'.$id,
            'password' => 'sometimes|string|min:8|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            'cash_register_id' => 'sometimes|exists:cash_registers,id'
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one number and one special character'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $updateData = $request->only(['name', 'email']);
        
        if ($request->has('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $cashier->update($updateData);

        // Update cash register assignment if provided
        if ($request->has('cash_register_id')) {
            $cashier->cashRegisters()->sync([$request->cash_register_id => [
                'start_at' => now(),
                'end_at' => null
            ]]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Cashier updated successfully',
            'data' => $cashier->load('cashRegisters')
        ]);
    }
}





















/*----OLD VRS----
class ManagerController extends Controller
{
    public function AddCacheRegister(Request $request)
    {
        $validation = Validator::make($request->only('supermarket_id'), [
            'supermarket_id' => ['required', 'exists:supermarkets,id'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'message' => "wiiiw",
            ], 422);
        }

        $supermarket_id = $request->supermarket_id;
        cashRegister::create(["supermarket_id" => $supermarket_id]);

        return response()->json([
            'status' => true,
            'message' => "Cash register added successfully!"
        ]);
    }

    public function AddCachier(Request $request)
    {
        $validation = Validator::make($request->only('name', 'email', 'password'), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:cash_registers,email'],
            'password' => ['required', 'string']
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'message' =>"if there is error is hicham mistake not main",
            ], 422);
        }

        $name = $request->name;
        $email = $request->email;
        $password = bcrypt($request->password);
        $role = "cachier";

        cashRegister::create([
            "name"     => $name,
            "email"    => $email,
            "password" => $password,
            "role"     => $role
        ]);

        return response()->json([
            'status' => true,
            'message' => "Cashier added successfully!"
        ]);
    }

    public function showAllCashiers()
    {
        $cashiers = cashRegister::where('role', 'cachier')->get();
        return response()->json([
            'status' => true,
            'data' => $cashiers
        ]);
    }

    public function deleteCashier($id)
    {
        $cashier = cashRegister::where('role', 'cachier')->find($id);

        if (!$cashier) {
            return response()->json([
                "status" => false,
                "message" => "Cashier not found"
            ], 404);
        }

        $cashier->delete();

        return response()->json([
            "status" => true,
            "message" => "Cashier deleted successfully"
        ]);
    }

    public function editCashier(Request $request, $id)
    {
        $cashier = cashRegister::where('role', 'cachier')->find($id);

        if (!$cashier) {
            return response()->json([
                "status" => false,
                "message" => "Cashier not found"
            ], 404);
        }
        if ($request->has('password')) {
            $request['password'] = bcrypt($request->password);
        }

        $cashier->update($request->all());

        return response()->json([
            "status" => true,
            "message" => "Cashier updated successfully",
            "data" => $cashier
        ]);
    }
}
*/
