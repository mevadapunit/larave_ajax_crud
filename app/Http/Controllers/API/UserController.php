<?php
 
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Education;
use Illuminate\Http\Request;
use Validator;
 
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return response()->json([
                "success" => false,
                "message" => "No users found.",
            ], 404);
        } else {
            return response()->json([
                "success" => true,
                "message" => "User List",
                "data" => $users
            ], 200);
        }
    }

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


    public function store(Request $request)
    {
        $customMessages = [
            'fullname.required' => 'The fullname field is required.',
            'education_id.required' => 'The education field is required.',
            'message.required' => 'The message field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'phone.required' => 'The phone field is required.',
            'genderAdd.required' => 'The gender field is required.',
            'hobby.required' => 'Please select at least one hobby.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size should not exceed 2MB.',
        ];

        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'education_id' => 'required',
            'message' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'genderAdd' => 'required',
            'hobby' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!is_array($value) && !is_string($value)) {
                        $fail('The ' . $attribute . ' must be an array or a string.');
                    }
                },
            ],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $customMessages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = [
            'fullname' => $request->input('fullname'),
            'education_id' => $request->input('education_id'),
            'message' => $request->input('message'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('genderAdd'),
            'hobby' => is_array($request->input('hobby')) ? implode(', ', $request->input('hobby')) : $request->input('hobby'),

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

        $user = User::create($data);

        if ($user) {
            return response()->json(['status' => 'success', 'message' => 'User created successfully'], 201); 
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to create user'], 500);
        }
    }

    public function getuserdata(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User data retrieved successfully',
            'user' => $user,
            'education' => $user->education->title,
        ]);
    }

     public function updateuserdata(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'education_id' => 'required',
            'message' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'genderEdit' => 'required',
            'hobby' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!is_array($value) && !is_string($value)) {
                        $fail('The ' . $attribute . ' must be an array or a string.');
                    }
                },
            ],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $data = [
            'fullname' => $request->input('fullname'),
            'education_id' => $request->input('education_id'),
            'message' => $request->input('message'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('genderEdit'),
        ];

        if ($request->has('hobby')) {
            $data['hobby'] = is_array($request->input('hobby')) ? implode(', ', $request->input('hobby')) : $request->input('hobby');
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $path = public_path('uploads/user');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $request->image->move($path, $imageName);

            $data['image'] = $imageName;
        }

        $result = $user->update($data);

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'User data updated successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update user data',
            ], 500);
        }
    }

    public function deleteuserdata(Request $request)
    {
        $id = $request->id;

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found',
            ]);
        }

        // Soft delete the user
        $user->delete();

        return response()->json([
            'status' => 200,
            'message' => 'User soft deleted',
        ]);
    }

    public function educationadddata(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'title' => 'required|max:255'
        ]);

        // Attempt to create a new Education record
        $result = Education::create($validatedData);

        // Check if the creation was successful
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