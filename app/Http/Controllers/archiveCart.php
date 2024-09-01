<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArchiveCart;

class ArchiveCartController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $archiveCarts = ArchiveCart::all(); // Retrieve all records
        return view('archiveCart.index', compact('archiveCarts')); // Pass records to the view
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('archiveCart.create'); // Show the form to create a new record
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'string1' => 'required|string|max:255',
            'string2' => 'required|string|max:255',
            'string3' => 'required|string|max:255',
            'string4' => 'required|string|max:255',
            'string5' => 'required|string|max:255',
            'string6' => 'required|string|max:255',
            'string7' => 'required|string|max:255',
            'string8' => 'required|string|max:255',
            'string9' => 'required|string|max:255',
            'string10' => 'required|string|max:255',
            'string11' => 'required|string|max:255',
            'string12' => 'required|string|max:255',
            'string13' => 'required|string|max:255',
        ]);

        ArchiveCart::create($request->all()); // Create a new record

        return redirect()->route('archiveCart.index')->with('success', 'Record created successfully.');
    }
}
