<?php

namespace App\Http\Controllers;

use App\Department;

use App\Faculty;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Create Department
    public function create(Request $request)
    {
        $name = $request->name;
        $faculty_id = $request->faculty_id;
        if($name && $faculty_id)    //validating if name and faculty_id exist from payload
        {
            $faculty = Faculty::find($faculty_id); // Faculty model a representation of faculty table
            if($faculty) {
                $department = Department::firstOrNew(["name"=>$name]);
                $department->name = $name;
                $department->faculty_id = $faculty_id;
                $department->save(); // persisting to the Database
                $response = [
                    "success" => true,
                    "department" => $department
                ];
                return response()->json($response, 200);
            }
            $response = [
                "success" => false,
                "message" => "Faculty id does not exist"
            ];
            return response()->json($response, 200);

        }
        $response = [
            "success" => false,
            "message" => "No name or faculty id supplied"
        ];
        return response()->json($response, 200);
    }

    // get department method
    public function getDepartments()
    {
        $departments = Department::all();
        $response = [
            'success' => true,
            "departments" => $departments
        ];
        return response()->json($response, 200);
    }

    // get single Department
    public function getDepartment($id)
    {
        $department = Department::find($id);
        $response = [
            'success' => true,
            "department" => $department
        ];
        return response()->json($response, 200);
    }
    // update department
    public function updateDepartment(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $faculty_id = $request->faculty_id;
        if ($id && $name && $faculty_id) {
            $faculty = Faculty::find($faculty_id);
            $department = Department::find($id);
            if($faculty && $department) {
                $department->name = $name;
                $department->faculty_id = $faculty_id;
                $department->save();
                $response = [
                    "success" => true,
                    "department" => $department
                ];
                return response()->json($response, 200);
            }
            $response = [
                "success" => false,
                "message" => "ids found no match"
            ];
            return response()->json($response, 200);
        }
        $response = [
            "success" => false,
            "message" => "Incomplete parameters"
        ];
        return response()->json($response, 504);
    }

    // Delete Department
    public function deleteDepartment(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $faculty = Faculty::find($id);
            $faculty->delete();
            $response = [
                "success" => true,
                "message" => "Faculty ".$id." Deleted"
            ];
            return response()->json($response, 200);
        }
        $response2 = [
            "success" => false,
            "message" => "ID not supplied"
        ];
        return response()->json($response2, 504);
    }
}

