<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', [
            'educations' => Education::all()
        ]);
    }

    public function fetch()
    {   
        return view('dataUser', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create', [
            'educations' => Education::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $data = [
            'fullname' => $request->input('fullname'),
            'education_id' => $request->input('education_id'),
            'message' => $request->input('message'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('genderAdd'),
            'hobby'  => implode(', ', $request->hobby),
        ];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $path = public_path('uploads/user');
            
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $request->image->move($path, $imageName);

            $data['image'] = $imageName;
        }
       
        $result = User::create($data);

        if ($result) {
            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 500,
            ]);
        }
    }


    public function show(Request $request)
    {
		$id = $request->id;
		$data = User::find($id);
		return response()->json([
            'user' => $data,
            'education' =>$data->education->title,
        ]);
    }

    public function edit(Request $request)
    {
		$id = $request->id;
		$data = User::find($id);
		return response()->json($data);
    }


    public function update(Request $request)
    {   
        $datas = [
            'fullname' => $request->input('fullname'),
            'education_id' => $request->input('education_id'),
            'message' => $request->input('message'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('genderEdit'),
            'hobby'  => implode(', ', $request->hobby),
        ];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $path = public_path('uploads/user');
            $request->image->move($path, $imageName);

            $datas['image'] = $imageName;
        }
        
        //$user   = User::find($request->idEdit);
        $result = User::where('id',$request->idEdit)->update($datas);

        if ($result) {
            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 500,
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

		$result = User::destroy($id);

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
