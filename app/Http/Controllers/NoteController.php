<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Documents;
use App\Models\Instructor;

class NoteController extends Controller
{
    public function index(){
        
           return view('note.index');
       
    }

     public function uploadfile(Request $request ){
       $data=new Documents;
        if($request->file('file')){
            $file=$request->file('file');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $request->file->move('storage/',$filename);
            $data->file=$filename;
        }
        $data->c_id=$request->c_id;
        $data->title=$request->title;
        $data->description=$request->description;
        $data->save();
        return redirect()->back();

        }



        // $req->upload->store('public');
       /* if ($request->file('upload') == null) {
            $file = "";
        }else{
           $file = $request->file('upload')->store('public');  
           return "uploaded";*/

           //$path = $request->file('upload')->store('upload');

           public function show($id){
            $data=Documents::find($id);
        return view('note.details',compact('data'));
        }
     
    public function view(){
       $file=Documents::all();
       return view('note.list',compact('file'));
    }
    /*public function show($id){
        $data=Documents::find($id);
        return view('note.view',compact('data'));
     }*/

     public function download($file){
        //$data=Documents::find($id);
       // return ('note.view',compact('data'));
       return response()->download('storage/'.$file);
     }

    
}
