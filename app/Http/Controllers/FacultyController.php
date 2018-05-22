<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

use App\Faculty;

class FacultyController extends Controller
{
    //
    public function create(Request $request) //$request is an instance of the class Request
    {
        if ($request->has('name')) {
            $name = $request->name; //
            $faculty = new Faculty(); // creating an instance of the model Faculty assigning to $faculty
            $faculty->name = $name; //
            $faculty->save(); //
            $response = [
                'success' => true,
                "id" => $faculty->id
            ];
            return response()->json($response, 200);
        }
        $response2 = [
            'success' => false,
            "message" => "No faculty supplied"
        ];
        return response()->json($response2, 200);

    }

    // get faculties method
    public function getFaculties()
    {
        $faculties = Faculty::all();
        $response = [
            'success' => true,
            "faculties" => $faculties
        ];
        return response()->json($response, 200);
    }

    // get single Faculty
    public function getFaculty($id)
    {
        $faculty = Faculty::find($id);
        $response = [
            'success' => true,
            "faculty" => $faculty
        ];
        return response()->json($response, 200);
    }


    public function updateFaculty(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        if ($id && $name) {
            $faculty = Faculty::find($id);
            $faculty->name = $name;
            $faculty->save();
            $response = [
                "success" => true,
                "faculty" => $faculty
            ];
            return response()->json($response, 200);
        }
        $response2 = [
            "success" => false,
            "message" => "No faculty supplied"
        ];
        return response()->json($response2, 504);
    }

    // Delete Faculty
    public function deleteDepartment(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $department = Department::find($id);
            $department->delete();
            $response = [
                "success" => true,
                "message" => "Department ".$id." Deleted"
            ];
            return response()->json($response, 200);
        }
        $response = [
            "success" => false,
            "message" => "ID not supplied"
        ];
        return response()->json($response, 504);
    }
}
