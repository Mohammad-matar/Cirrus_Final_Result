<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class HomeworkController extends Controller
{


    // GET All Homeworks
    public function getAll()
    {
        $homework = Homework::all();
        $respond = [
            'status' => 200,
            'message' => 'get all homework successufully',
            'data' => $homework
        ];
        return $respond;
    }

    //Get Homework By ID
    public function getById($id)
    {
        $homework = Homework::find($id);
        if (isset($homework)) {
            $respond = [
                "status" => 200,
                "data" => $homework
            ];
            return $respond;
        }
        return $respond = [
            "status" => 404,
            "message" => "homework not found"
        ];
    }


    // Add a new homework
    public function create(Request $request)
    {
        $homework = new Homework();
        $validation = Validator::make($request->all(), [
            'teacher_id' => 'required | integer',
            'title' => 'required |string ',
            'content' => 'required |string ',

        ]);

        if ($validation->fails()) {
            $respond = [
                "status" => 401,
                "message" => $validation->errors()->first(),
            ];
            return $respond;
        }

        $homework->title =  $request->title;
        $homework->content =  $request->content;
        $homework->teacher_id =  $request->teacher_id;



        $homework->save();
        $student = Student::find(4);
        echo $student;
        $homework->student()->attach($student);

        return $respond = [
            'status' => 200,
            'message' => 'New homework is added',
            'data' => $homework
        ];
    }

    // update homeworks 

    public function update(Request $request, $id)
    {
        $homework = Homework::find($id);

        if (isset($homework)) {
            $validation = Validator::make($request->all(), [
                'teacher_id' => 'required | integer',
                'title' => 'required |string ',
                'content' => 'required |string ',
            ]);

            if ($validation->fails()) {
                $respond = [
                    "status" => 401,
                    "message" => $validation->errors()->first(),
                ];
                return $respond;
            };

            $homework->title =  $request->title;
            $homework->content =  $request->content;
            $homework->teacher_id =  $request->teacher_id;

            $homework->save();
            $student = Student::find(1);
            echo $student;
            $homework->student()->attach($student);


            return $respond = [
                'status' => 200,
                'message' => 'the homework updated',
                'data' => $homework,
            ];
        }
        return $respond = [
            'status' => 404,
            'message' => 'the homework isnt updated',
        ];
    }

    //Delete a homework
    public function delete($id)
    {
        $homework = Homework::find($id);
        if (isset($homework)) {
            $homework->delete();
            $respond = [
                'status' => 200,
                'message' => 'homework is deleted',

            ];
            return $respond;
        }
        return $respond = [
            'status' => 404,
            'message' => 'the homework isnt deleted',
        ];
    }
}
