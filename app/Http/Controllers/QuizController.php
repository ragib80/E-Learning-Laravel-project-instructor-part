<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quizes;
use App\Models\Questions;


class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizes=Quizes::orderBy('id')->paginate(50);
        return view('Exam.quiz.create',compact('quizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
       Quizes::create($data);
       
       return redirect()->back()->with('success','Data add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Quizes::find($id);
        $questions=Questions::where('quizes_id',$id)->get();
         return view('Exam.quiz.details',compact('data','questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $quizes = Quizes::find($id);
        return view('quiz.delete')->with('quizes', $quizes);
    }
    public function destroy($id)
    {
        Quizes::destroy($id);
        return redirect()->route('course.index');
        
    }
    public function AddQuestion($id)
    {
         
        $quizId=Quizes::find($id);
        return view('Exam.question.add_question',compact('quizId'));

    }
    public function status($id)
    {
        $quiz=Quizes::all();        $data=Quizes::find($id);
        if($data->status=="1"){
            $data->status=0;
        }else{
        $data->status=1;
        }
        $data->save();

    }
}
