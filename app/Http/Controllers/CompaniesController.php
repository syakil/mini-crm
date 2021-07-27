<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companie;
use File;
use DB;
use Redirect;
use App\Events\Companies\CompaniesEmail;

class CompaniesController extends Controller
{
    public function index(){
    
        return view('companies/index');
    
    }

    public function listData(){

        $companies = Companie::get();
        
        $data = array();
        $no = 1;
    
        foreach($companies as $list){
        
            $row = array();
            $row[] = $no++;
            $row[] = $list->name;
            $row[] = $list->email;
            $row[] = "<img  style='width:100px;height:100px;' src='".asset('storage/'.$list->logo)."' alt=''>";
            $row[] = $list->website;
            $row[] = '<div class="btn-group">
                        <a onclick="edit('.$list->id.')" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        <a onclick="deleteItem('.$list->id.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[] = $row;
        
        }   
    
        
        $output = array("data" => $data);
        return response()->json($output);     
       
    }

    public function store(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'logo' => 'dimensions:min_width=100,min_height=100'
        ]);


        try {
            
            DB::beginTransaction();

            
            $companies = new Companie;
            $companies->name = $request->name;
            $companies->email = $request->email;

            if($request->hasFile('logo')){

                // Get filename with the extension
                $filenameWithExt = $request->file('logo')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('logo')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // File Storage
                $folder = 'public';
                // Upload Image
                $path = $request->file('logo')->storeAs($folder,$fileNameToStore);
                
                $companies->logo = $fileNameToStore;

            }

            $companies->website = $request->website;
            $companies->save();
 
            DB::commit();
            
            event(new CompaniesEmail($companies));

        }catch(\Exception $e){
         
            DB::rollback();
            return back()->with(["error" => $e->getmessage()]);
   
        }

        return back()->with(["success"=>"Data Berhasil Ditambahkan !"]);
    }


    public function destroy($id){

        $companies = Companie::findOrFail($id);
        $destinationPath = 'storage/';
        File::delete($destinationPath.$companies->logo);
        $companies->delete();

    }

    public function getId($id){

        $companies = Companie::findOrFail($id);

        $data_companies = new \stdClass();
        $data_companies->id = $companies->id;
        $data_companies->name = $companies->name;
        $data_companies->email = $companies->email;
        $data_companies->website = $companies->website;
    
        echo json_encode($data_companies);

    }

    public function update(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'logo' => 'dimensions:min_width=100,min_height=100'
        ]);


        
        try {
            
            DB::beginTransaction();

            
            $companies = Companie::findOrFail($request->id);
            $companies->name = $request->name;
            $companies->email = $request->email;

            if($request->hasFile('logo')){

                $destinationPath = 'storage/';
                File::delete($destinationPath.$companies->logo);
        
                // Get filename with the extension
                $filenameWithExt = $request->file('logo')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('logo')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // File Storage
                $folder = 'public';
                // Upload Image
                $path = $request->file('logo')->storeAs($folder,$fileNameToStore);
                
                $companies->logo = $fileNameToStore;

            }

            $companies->website = $request->website;
            $companies->update();
 
            DB::commit();
            

        }catch(\Exception $e){
         
            DB::rollback();
            return back()->with(["error" => $e->getmessage()]);
   
        }

        return back()->with(["success"=>"Data Berhasil Di Ubah !"]);


    }

}
