<?php

namespace App\Http\Controllers;

use App\Department;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
//    public function getStudent($id)
//    {
//        $students = array();
//        $student1["id"] = 1;
//        $student1["name"] = 'ade';
//        array_push($students, $student1);
//
//        $student2["id"] = 2;
//        $student2["name"] = 'tomi';
//        array_push($students, $student2);
//
//        $student3["id"] = 3;
//        $student3["name"] = 'Tade';
//        array_push($students, $student3);
//
//        $studentObj = [];
//        //Looping through the student array
//        foreach($students as $student){
//            if($student["id"] == $id) {  //assigning the passed in student id to $id
//                $studentObj = $student; // assigning the $student to $student  break;  break out of loop
//            }
//        }
//        $response = [
//            'success' => true,
//            "data" => $studentObj
//        ];
//        return response()->json($response, 200); // returning a response in json format and
//        //test url http://127.0.0.1:8000/api/students/1
//    }

    public function create(Request $request)
    {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $mat_no = $request->mat_no;
        $gender = $request->gender;
        $level = $request->level;
        $department_id = $request->department_id;
        if($first_name && $last_name && $mat_no && $gender && $level && $department_id)    //validating if name and faculty_id exist from payload
        {
            $department = Department::find($department_id); // Faculty model a representation of faculty table
            if($department) {
                $student = Student::firstOrNew(["mat_no"=>$mat_no]);
                $student->first_name = $first_name;
                $student->last_name = $last_name;
                $student->mat_no = $mat_no;
                $student->gender = $gender;
                $student->level = $level;
                $student->department_id = $department_id;
                $student->save(); // persisting to the Database
                $response = [
                    "success" => true,
                    "student" => $student
                ];
                return response()->json($response, 200);
            }
            $response = [
                "success" => false,
                "message" => "Departmant id does not exist"
            ];
            return response()->json($response, 200);

        }
        $response = [
            "success" => false,
            "message" => "Incomplete parameters"
        ];
        return response()->json($response, 200);
    }

    // get student method
    public function getStudents()
    {
        $students = Student::all();
        $response = [
            'success' => true,
            "students" => $students
        ];
        return response()->json($response, 200);
    }

    // get single Student method
    public function getStudent($id)
    {
        $student = Student::find($id);
        $response = [
            'success' => true,
            "student" => $student
        ];
        return response()->json($response, 200);
    }

    // update department
    public function updateStudent(Request $request)
    {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $mat_no = $request->mat_no;
        $gender = $request->gender;
        $level = $request->level;
        $department_id = $request->department_id;
        if($first_name && $last_name && $mat_no && $gender && $level && $department_id)    //validating if name and faculty_id exist from payload
        {
            $department = Department::find($department_id); // Faculty model a representation of faculty table
            if($department) {
                $student = Student::firstOrNew(["mat_no"=>$mat_no]);
                $student->first_name = $first_name;
                $student->last_name = $last_name;
                $student->mat_no = $mat_no;
                $student->gender = $gender;
                $student->level = $level;
                $student->department_id = $department_id;
                $student->save(); // persisting to the Database
                $response = [
                    "success" => true,
                    "student" => $student,
                    "message" => "Updated successfully"
                ];
                return response()->json($response, 200);
            }
            $response = [
                "success" => false,
                "message" => "Departmant id does not exist"
            ];
            return response()->json($response, 200);
        }
        $response = [
            "success" => false,
            "message" => "Incomplete parameters"
        ];
        return response()->json($response, 200);
    }

    // Delete Student
    public function deleteStudent(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $student = Student::find($id);
            $student->delete();
            $response = [
                "success" => true,
                "message" => "Student ".$id." Deleted"
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
