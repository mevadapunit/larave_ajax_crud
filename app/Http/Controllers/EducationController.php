<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('education');
    }

    public function fetch()
    {
        return view('dataEducation', [
            'educations' => Education::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validateData = $request->validate([
            'title' => 'required|max:255'
        ]);

        $result = Education::create($validateData);

        if($result){
            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 500,
            ]);
        }
    }

    public function show(Education $education)
    {
        //
    }

    public function edit(Request $request)
    {  
		$id   = $request->id;
		$data = Education::find($id);

		return response()->json($data);
    }

    public function update(Request $request, Education $education)
    {
        $education = Education::find($request->idEdit);

        if (!$education) {
            return response()->json([
                'status' => 404, // Or any appropriate status code
                'message' => 'Education not found',
            ]);
        }

        $education->update($request->all());

        return response()->json([
            'status' => 200,
        ]);
    }


    public function destroy(Request $request)
    {
        $id     = $request->id;
		$result = Education::destroy($id);

        if($result){
            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 500,
            ]);
        }
    }
}
