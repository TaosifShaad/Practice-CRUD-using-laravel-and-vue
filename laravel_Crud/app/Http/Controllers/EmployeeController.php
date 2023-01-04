<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index() {
        return Employee::paginate(5);
    }
    public function store(Request $request) {
        Employee::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'), 
            'address'=> $request->input('address'), 
            'phone'=> $request->input('phone')
        ]);
        return response()->json(['success' => true]);
    }
    public function update(Request $request, $id) {
        // $employee = Employee::find($id);
        // $employee->update([
            // 'name' => $request->input('name'),
            // 'email' => $request->input('email'), 
            // 'address'=> $request->input('address'), 
            // 'phone'=> $request->input('phone')
        // ]);
        Employee::where('id', $id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'), 
            'address'=> $request->input('address'), 
            'phone'=> $request->input('phone')
        ]);
        return response()->json(['success' => true]);
    }
    public function delete($id) {
        Employee::where('id', $id)->delete();
        return response()->json(['deleted!']);
    }
}
