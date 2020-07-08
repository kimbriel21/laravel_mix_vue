<?php
use App\Models\Employee;
use Illuminate\Http\Client\Request;

interface EmployeeService
{
    public function index();
    public function store(Request $request);
    public function show(Employee $employee);
    public function update(Request $request, Employee $employee);
    public function destroy(Employee $employee);
}