<?php
 
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Education;
use Illuminate\Http\Request;
use Validator;
 
class EducationController  extends Controller
{
    public function education()
    {
        $educations = Education::all();

        if ($educations->isEmpty()) {
            return response()->json([
                "success" => false,
                "message" => "No Education List found.",
            ], 404);
        } else {
            return response()->json([
                "success" => true,
                "message" => "Education List",
                "data" => $educations
            ], 200);
        }
    }

    public function educationadddata(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255'
        ]);

        $result = Education::create($validatedData);

        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => 'Education record created successfully'
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to create education record'
            ]);
        }
    }



}