<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Informacion;
use App\Models\Student;  // Importamos el modelo Student

class TestController extends Controller
{
    // Obtener todos los usuarios
    public function getUsers() {
        $res = User::all();
        return response()->json($res);
    }

    // Obtener un usuario por ID
    public function getUser($id) {
        $res = User::find($id);
        return response()->json($res);
    }

    // Insertar un nuevo usuario
    public function insertUser(Request $request) {
        $user = new User();
        $user->name = $request->nombre;
        $user->email = $request->correo;
        $user->password = $request->password;
        $user->save();
        return response()->json($user);
    }

    // Obtener todos los estudiantes
    public function getStudents() {
        $students = Student::all();  // Obtenemos todos los estudiantes
        return response()->json($students);
    }

    // Obtener un estudiante por ID
    public function getStudent($id) {
        $student = Student::find($id);  // Buscamos el estudiante por su ID
        return response()->json($student);
    }

    // Insertar un nuevo estudiante
    public function insertStudent(Request $request) {
        $student = new Student();  // Creamos una nueva instancia de Student
        $student->name = $request->name;
        $student->course = $request->course;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();  // Guardamos el estudiante en la base de datos
        return response()->json($student);  // Retornamos el estudiante insertado
    }
}
