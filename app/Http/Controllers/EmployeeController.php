<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\Designation;
use App\Service\EmployeeService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Session;
use Mail;


class EmployeeController extends Controller
{

    protected $employeeService;
    public function __construct(EmployeeService $employeeService){

        $this->employeeService=$employeeService;
    }
    public function addEmployee(){
        $designations=Designation::orderBy('designation','asc')->get();
        return view('backpanel.employee.add-employee')->with('designations',$designations);
    }

    public function editEmployee($id){
        $data['designations']=Designation::orderBy('designation','asc')->get();
        $data['employee']=User::find($id);
        return view('backpanel.employee.edit-employee')->with('data',$data);
    }

    public function listEmployee(){
        $employees=User::orderBy('id','desc')->get();
        return view('backpanel.employee.list-employee')->with('employees',$employees);
    }

     /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEmployee(Request $request,User $employee){
       
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$employee->id,
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'designation' => 'required',
        ]);
        $result=$this->employeeService->saveEmployee($request);
        if($result){
            $email=$result->email;
            Mail::to($email)->send(new NotifyMail($result));
        }
       
        return redirect('employee/list-employee')->with('success','Created Successfully');
    }

    public function updateEmployee(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'designation' => 'required',
        ]);
        $result=$this->employeeService->saveEmployee($request,$id);
        return redirect('employee/list-employee')->with('success','Updated Successfully');
    }

    public function deleteEmployee($id){
        User::destroy($id); 
        return redirect('employee/list-employee')->with('success','Deleted Successfully');
   }
}
