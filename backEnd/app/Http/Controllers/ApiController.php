<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllStudents() {
        $students = Student::get()->toJson(JSON_PRETTY_PRINT);
        return response($students, 200);
        // logic to get all students goes here
      }
  
      public function createStudent(Request $request) {

        $student = new Student;
        $student->name = $request->name;
        $student->course = $request->course;
        $student->save();

        return response()->json([
            "message" => "student record created"
        ], 201);
        // logic to create a student record goes here
      }
  
      public function getStudent($id) {
        if (Student::where('id', $id)->exists()) {
            $student = Student::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }
        // logic to get a student record goes here
      }
  
      public function updateStudent(Request $request, $id) {
        if (Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->name = is_null($request->name) ? $student->name : $request->name;
            $student->course = is_null($request->course) ? $student->course : $request->course;
            $student->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);

        // logic to update a student record goes here
      }
    }


      public function deleteStudent ($id) {
        if(Student::where('id', $id)->exists()) {
          $student = Student::find($id);
          $student->delete();
  
          return response()->json([
            "message" => "records deleted"
          ], 202);
        } 
        else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }
    }
  
    }
      
      

