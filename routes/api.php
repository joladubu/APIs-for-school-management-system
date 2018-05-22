<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sms', function () {
    $response["school"] = "my school";
    $response ["state"] = "Lagos";
    $response ["LGA"] = "Yaba";
    return response()->json($response, 200); // returning a response in json format
});

Route::get('/display', function (Request $request) {
    $state = "Yaba";
    $id = 22;
    if ($request->has("state")) {
        $state = $request->state;
    } 
    if ($request->has("id")) {
        $id = $request->id;
    }
    $response ["state"] = $state;
    $response ["id"] = $id;
    return response()->json($response, 200); // returning a response in json format and 
});

// test url http://127.0.0.1:8000/api/display?state=yaba&id=27777


Route::get('/students', function () {
    $students = array();
    $student1["id"] = 1;
    $student1["name"] = 'ade';
    array_push($students, $student1);
    
    $student2["id"] = 2;
    $student2["name"] = 'tomi';
    array_push($students, $student2);

    $student3["id"] = 3;
    $student3["name"] = 'Tade';
    array_push($students, $student3);
    $response = [
        'success' => true,
        "data" => $students
    ];
    return response()->json($response, 200); // returning a response in json format and 
});

Route::get('/students/{id}', 'StudentController@getStudent'); //passing the route to the StudentController controller to
// execute the getStudent method

// POST Request
Route::post('/faculties', 'FacultyController@create'); //passing the route to the Faculty controller to execute the create method

//GET All Faculties -> Faculty::all();
Route::get('/faculties', 'FacultyController@getFaculties');

//GET Single Faculty -> Faculty:: findFirst(id);
Route::get('/faculties/{id}', 'FacultyController@getFaculty');

//Update Single Faculty -> Faculty::findFirst(id);
Route::put('/faculties', 'FacultyController@updateFaculty');

//Delete Single Faculty -> Faculty::delete(id);
Route::delete('/faculties', 'FacultyController@deleteFaculty');

// ROUTES FOR DEPARTMENTS

// POST Request
Route::post('/departments', 'DepartmentController@create'); //passing the route to the Faculty controller to execute the create method

//GET All Departments ->
Route::get('/departments', 'DepartmentController@getDepartments');

//GET Single Faculty ->
Route::get('/departments/{id}', 'DepartmentController@getDepartment');

//Update Single Faculty -> Faculty::findFirst(id);
Route::put('/departments', 'DepartmentController@updateDepartment');

//Delete Single Faculty -> Faculty::delete(id);
Route::delete('/departments', 'DepartmentController@deleteDepartment');


// ROUTES FOR STUDENT

// POST Request
Route::post('/students', 'StudentController@create'); //passing the route to the Faculty controller to execute the create method

//GET All Students ->
Route::get('/students', 'StudentController@getStudents');

//GET Single Student ->
Route::get('/students/{id}', 'StudentController@getStudent');

//Update Student -> Faculty::findFirst(id);
Route::put('/students', 'StudentController@updateStudent');

//Delete Single Student -> Faculty::delete(id);
Route::delete('/students', 'StudentController@deleteStudent');


//Route::get('/students/{id}', function ($id) { //make a get request to fetch deatils of a students based on his id
    // Required parameters = {}
    // Optional parameter = ?

    // $students = array();
    // $student1["id"] = 1;
    // $student1["name"] = 'ade';
    // array_push($students, $student1);
    
    // $student2["id"] = 2;
    // $student2["name"] = 'tomi';
    // array_push($students, $student2);

    // $student3["id"] = 3;
    // $student3["name"] = 'Tade';
    // array_push($students, $student3);

    // $studentObj = [];
    // //Looping through the student array
    // foreach($students as $student){
    //     if($student["id"] == $id) {  //assigning the passed in student id to $id
    //         $studentObj = $student; // assigning the $student to $studentObj
    //         // break; // break out of loop
    //     }
    // }
    // $response = [
    //     'success' => true,
    //     "data" => $studentObj
    // ];
    // return response()->json($response, 200); // returning a response in json format and 
    //test url http://127.0.0.1:8000/api/students/1
// });  

//Create a controller in laravel
    // php artisan make:controller StudentController - capital S coz its a class
    //located in app/http/controller