<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Offer;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $student = Student::with(['career.faculty'])->where('usuario_id', $user->id)->first();

        // Fetch recommended offers (e.g., same career as student)
        $recommendedOffers = Offer::with(['company', 'career'])

            ->when($student && $student->carrera_id, function($query) use ($student) {
                return $query->where('carrera_id', $student->carrera_id);
            })
            ->latest()
            ->take(3)
            ->get();

        return view('dash_est', [
            'student' => $student,
            'offers' => $recommendedOffers
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
