<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    protected $model;
    public function __construct(Employee $model)
    {
       $this->middleware('auth');
        $this->model = $model;
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->model->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'employeeId' => 'required',
            'address' => 'required',
            'birthday' => 'required',
            'number' => 'required',
        ]);

        $this->model->create([
            "first_name" =>$request->firstName,
            "middle_name" =>$request->middleName,
            "last_name" =>$request->lastName,
            "employee_id" =>$request->employeeId,
            "address" =>$request->address,
            "birthday" =>$request->birthday,
            "number" =>$request->number,

        ]);

        return response($request->all(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $this->model = $this->model->find($id);
        return response($this->model, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'employeeId' => 'required',
            'address' => 'required',
            'birthday' => 'required',
            'number' => 'required',
        ]);
        $this->model->find($id)->fill([
            "first_name" =>$request->firstName,
            "middle_name" =>$request->middleName,
            "last_name" =>$request->lastName,
            "employee_id" =>$request->employeeId,
            "address" =>$request->address,
            "birthday" =>$request->birthday,
            "number" =>$request->number,
        ])->save();


        return response($request->all(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->model = $this->model->find($id);
        $data =  $this->model;
        $this->model->delete();
        return response($data,200);
    }
}
