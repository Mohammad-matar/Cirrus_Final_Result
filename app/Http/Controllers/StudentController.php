<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;



class StudentController extends Controller
{
    // GET All Students
    public function getAll()
    {
        $student = Student::all();
        $respond = [
            'status' => 200,
            'message' => 'get all student successufully',
            'data' => $student
        ];
        return $respond;
    }

    //Get Student By ID
    public function getById($id)
    {
        $student = Student::find($id);
        if (isset($student)) {
            $respond = [
                "status" => 200,
                "data" => $student
            ];
            return $respond;
        }
        return $respond = [
            "status" => 404,
            "message" => "student not found"
        ];
    }

    // Add a new student
    public function create(Request $request)
    {
        $student = new Student();
        $validation = Validator::make($request->all(), [
            'name' => 'required |string | max:255',
            'email' => 'required |string ',
            'password' => 'required |string ',
            'date_of_birth' => 'required |string ',
            'phone_number' => 'required |string ',
            'class' => 'required |string ',
            'gender' => 'required |string ',
        ]);

        if ($validation->fails()) {
            $respond = [
                "status" => 401,
                "message" => $validation->errors()->first(),
            ];
            return $respond;
        }

        $student->name =  $request->name;
        $student->email =  $request->email;
        $student->password =  $request->password;
        $student->date_of_birth =  $request->date_of_birth;
        $student->phone_number =  $request->phone_number;
        $student->class = $request->class;
        $student->gender =  $request->gender;
        // $student->student_id = $request->student_id;


        $student->save();
        return $respond = [
            'status' => 200,
            'message' => 'New student is added',
            'data' => $student
        ];
    }
    //Updating student Info
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (isset($student)) {
            $validation = Validator::make($request->all(), [
                'name' => 'required |string | max:255',
                'email' => 'required |string ',
                'password' => 'required |string ',
                'date_of_birth' => 'required |string ',
                'phone_number' => 'required |string ',
                'class' => 'required |string ',
                'gender' => 'required |string ',
            ]);

            if ($validation->fails()) {
                $respond = [
                    "status" => 401,
                    "message" => $validation->errors()->first(),
                ];
                return $respond;
            };

            $student->name =  $request->name;
            $student->email =  $request->email;
            $student->password =  $request->password;
            $student->date_of_birth =  $request->date_of_birth;
            $student->phone_number =  $request->phone_number;
            $student->gender =  $request->gender;

            $student->save();



            return $respond = [
                'status' => 200,
                'message' => 'the stud$student updated',
                'data' => $student,
            ];
        }
        return $respond = [
            'status' => 404,
            'message' => 'the student isnt updated',
        ];
    }

    //Delete a Student
    public function delete($id)
    {
        $student = Student::find($id);
        if (isset($student)) {
            $student->delete();
            $respond = [
                'status' => 200,
                'message' => 'student is deleted',

            ];
            return $respond;
        }
        return $respond = [
            'status' => 404,
            'message' => 'the student isnt deleted',
        ];
    }
    //login function
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    //register function
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required |string | max:255',
            'email' => 'required |string ',
            'password' => 'required |string ',
            'date_of_birth' => 'required |string ',
            'phone_number' => 'required |string ',
            'class' => 'required |string ',
            'gender' => 'required |string ',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = Student::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'date_of_birth' => $request->get('date_of_birth'),
            'phone_number' => $request->get('phone_number'),
            'class' => $request->get('class'),
            'gender' => $request->get('gender'),

        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user', 'token'), 201);
    }
}
