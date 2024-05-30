<?php

namespace App\Http\Controllers;

use App\Models\Student;
use DataTables;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    public function getEmails()
    {
        $emails = Student::pluck('email');

        return response()->json($emails);
    }


    public function data(Request $request)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $email = $request->input('email');

        $studentsQuery = Student::select(['id', 'name', 'email', 'price']);

        if ($email) {
            $studentsQuery->where('email', $email);
        }

        if ($minPrice !== null && $maxPrice !== null) {
            $studentsQuery->whereBetween('price', [$minPrice, $maxPrice]);
        } elseif ($minPrice !== null) {
            $studentsQuery->where('price', '>=', $minPrice);
        } elseif ($maxPrice !== null) {
            $studentsQuery->where('price', '<=', $maxPrice);
        }

        return DataTables::of($studentsQuery)->make(true);
    }
}
