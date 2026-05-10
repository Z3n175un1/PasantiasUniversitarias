<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Auth::user()->student->applications()->with('offer.company')->get();
        return view('student.applications', compact('applications'));
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
        $request->validate([
            'offer_id' => 'required|exists:ofertas,id',
        ]);

        $student = Auth::user()->student;

        if (!$student) {
            return back()->with('error', 'You must have a student profile to apply.');
        }

        // Check if already applied
        $existing = Application::where('estudiante_id', $student->id)
            ->where('oferta_id', $request->offer_id)
            ->first();

        if ($existing) {
            return back()->with('info', 'You have already applied to this offer.');
        }

        Application::create([
            'estudiante_id' => $student->id,
            'oferta_id' => $request->offer_id,
            'fecha_postulacion' => now(),
            'estado' => 'pendiente',
        ]);

        return back()->with('success', 'Application sent successfully!');
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
