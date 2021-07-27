<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Companie;
use DB;

class EmployeesController extends Controller
{
    public function index(){

        $employee = Employee::latest()->paginate(5);
        $companies = Companie::get();
        return view('employees.index',compact('employee','companies'));

    }

    public function store(Request $request){

        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
        ]);


        try {
            
            DB::beginTransaction();
            
            $employees = new Employee;
            $employees->first_name = $request->first_name;
            $employees->last_name = $request->last_name;
            $employees->email = $request->email;
            $employees->phone = $request->phone;
            $employees->companie_id = $request->company;
            $employees->save();
 
            DB::commit();
            
        }catch(\Exception $e){
         
            DB::rollback();
            return back()->with(["error" => $e->getmessage()]);
   
        }

        return back()->with(["success"=>"Data Berhasil Ditambahkan !"]);
    }


    
    public function destroy($id){

        $employee = Employee::findOrFail($id);
        $employee->delete();

    }

    public function getId($id){

        $employe = Employee::findOrFail($id);

        $data_employe = new \stdClass();
        $data_employe->id = $employe->id;
        $data_employe->first_name = $employe->first_name;
        $data_employe->last_name = $employe->last_name;
        $data_employe->email = $employe->email;
        $data_employe->company = $employe->companie_id;
        $data_employe->phone = $employe->phone;
    
        echo json_encode($data_employe);

    }

    public function update(Request $request){

        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        
        try {
            
            DB::beginTransaction();

            $employee = Employee::findOrFail($request->id);
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->companie_id = $request->company;
            $employee->update();
 
            DB::commit();
            

        }catch(\Exception $e){
         
            DB::rollback();
            return back()->with(["error" => $e->getmessage()]);
   
        }

        return back()->with(["success"=>"Data Berhasil Di Ubah !"]);


    }


}
