<?php

namespace App\Http\Controllers;

use App\Exports\GradesExport;
use App\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class GradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grade = Grade::all();

        return view('grade.index', compact('grade'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grade.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'maths' => 'required',
            'physics' => 'required',
            'chemistry' => 'required',
            'zoology' => 'required',
            'botany' => 'required'

        ]);

        $engineeringCutoff = ($request->maths/2) + ($request->physics/4) + ($request->chemistry/4);
        $medicalCutoff = ($request->botany/4) + ($request->zoology/4) + ($request->physics/4) + ($request->chemistry/4);
        $totalGrade = ($request->botany) + ($request->botany) + ($request->botany) + ($request->botany) + ($request->botany);
        $finalGrade = $totalGrade / 5;

        if($finalGrade > 0 && $finalGrade <= 40)
        {
            $class = 'Fail';

        } elseif ($finalGrade > 40 && $finalGrade <= 49) {

            $class = 'Pass';

        } elseif ($finalGrade > 49 && $finalGrade <= 59) {
            
            $class = 'Second Class';

        } elseif ($finalGrade > 59)
        {
            $class = 'First Class';
        }



        Grade::create([
            'student_id' => $request->student_id,
            'maths' => $request->maths,
            'physics' => $request->physics,
            'chemistry' => $request->chemistry,
            'zoology' => $request->zoology,
            'botany' => $request->botany,
            'engineering_cut_off' => $engineeringCutoff,
            'medical_cut_off' => $medicalCutoff,
            'class' => $class,
            'final' => $finalGrade
        ]);

        return redirect()->route('grade.index')->with('message', 'Grade added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade = Grade::findorFail($id);

        return view('grade.edit', compact('grade'));
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
        $grade = Grade::findorFail($id);

        $engineeringCutoff = ($request->maths/2) + ($request->physics/4) + ($request->chemistry/4);
        $medicalCutoff = ($request->botany/4) + ($request->zoology/4) + ($request->physics/4) + ($request->chemistry/4);
        $totalGrade = ($request->botany) + ($request->botany) + ($request->botany) + ($request->botany) + ($request->botany);
        $finalGrade = $totalGrade / 5;

        if($finalGrade > 0 && $finalGrade <= 140)
        {
            $class = 'Fail';

        } elseif($finalGrade > 140 && $finalGrade <= 149) {

            $class = 'Pass';

        } elseif($finalGrade > 149 && $finalGrade <= 159) {
            
            $class = 'Second Class';

        } elseif($finalGrade > 159)
        {
            $class = 'First Class';
        }

        $data = array();

        $data['student_id'] = $request->student_id;
        $data['maths'] = $request->maths;
        $data['physics'] = $request->physics;
        $data['chemistry'] = $request->chemistry;
        $data['zoology'] = $request->zoology;
        $data['botany'] = $request->botany;
        $data['engineering_cut_off'] = $engineeringCutoff;
        $data['medical_cut_off'] = $medicalCutoff;
        $data['class'] = $class;
        $data['final'] = $finalGrade;
        

        $grade->update($data);

        return redirect()->route('grade.index')->with('message', 'Grade updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::findorFail($id);

        Grade::where('id', $id)->first()->delete();

        return redirect()->back()->with('message', 'Grade Deleted Successfully');   
    }

    public function filter(Request $request)
    {
        $data = $request->search;

        $filterData = Grade::where('class', 'LIKE', "%{$data}%")
                    ->orWhere('engineering_cut_off', 'LIKE',  "%{$data}%")
                    ->orWhere('medical_cut_off', 'LIKE',  "%{$data}%")
                    ->orWhere('final', 'LIKE',  "%{$data}%")
                    ->get();

        $dataCount = $filterData->count();

        return view('grade.filter', compact('filterData', 'dataCount'));
    }

    public function exportIntoExcel()
    {
        return Excel::download(new GradesExport, 'gradelist.xlsx');
    }
}
