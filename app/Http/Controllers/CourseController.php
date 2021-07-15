<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Exports\CoursesExport;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\Course;



class CourseController extends Controller
{
    public function index()
    {
          $course = Course::all();
          return view('course.list')->with('courseList', $course);
    }
    public function details($c_id)
    {
        
        $course = Course::find($c_id);
        return view('course.details')->with('course', $course);
    }
    public function create(){
        return view('course.create');
    }
    public function insert(Request $req)
    {
    

        $course = new Course;
        $course->c_name = $req->c_name;
        $course->img = 'abc';
        $course->status = $req->status;
        
        $course->save();
        return redirect()->route('course.index');
    }

    public function edit($c_id)
    {
        $course = Course::find($c_id);
        return view('course.edit')->with('course', $course);
    }

    public function update(Request $req, $c_id)
    {
        $course = Course::find($c_id);
        
        $course->c_name = $req->c_name;
        $course->img = 'abc';
        $course->status = $req->status;
        
        $course->save();
        return redirect()->route('course.index');
    }

    public function delete($id)
    {
        $course = Course::find($id);
        return view('course.delete')->with('course', $course);
    }
    public function destroy(Course $course, $c_id)
    {
        Course::destroy($c_id);
        return redirect()->route('course.index');
    }
    public function search(){
        return view('course.search');
    }

    public function course()

    {

        return Excel::download(new CoursesExport, 'Courses.xlsx');

    }

 

    public function searching(Request $req){
        $q = $req->q;
        $course = Course::where('c_id', 'LIKE', '%'.$q.'%')
                            ->orWhere('c_name', 'LIKE', '%'.$q.'%')
                            ->get();
        if (count($course)>0) {
            return view('course.searchresult')->withDetails($course)->withQuery($q);
        }else{
            return view ('course.searchresult')->withMessage('No Details found. Try to search again !');
        }
    }

}
