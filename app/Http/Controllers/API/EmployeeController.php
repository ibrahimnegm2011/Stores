<?php

namespace App\Http\Controllers\API;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        return $this->sendResponse($employees->toArray(), 'Employees retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'salary' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $employee = Employee::create($input);


        return $this->sendResponse($employee->toArray(), 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);


        if (is_null($employee)) {
            return $this->sendError('Employee not found.');
        }


        return $this->sendResponse($employee->toArray(), 'Employee retrieved successfully.');
    }


    public function update(Request $request, Employee $employee)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $employee->name = $input['name'];
        $employee->detail = $input['detail'];
        $employee->save();


        return $this->sendResponse($employee->toArray(), 'Employee updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return $this->sendResponse($employee->toArray(), 'Employee deleted successfully.');
    }
}
