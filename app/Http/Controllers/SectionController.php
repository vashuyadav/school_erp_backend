<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SectionController extends Controller
{
    public function index()
    {
        $records = Section::all();

        return response()->json($records);
    }

    // Store new record
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'section_name' => 'required|string|max:255|regex:/^[A-Za-z0-9\s]+$/',            
            'is_active'  => 'boolean',
        ]);

        $addData = Section::create($validatedData);
        
        return response()->json([
            'status' => true,
            'message' => 'Section created successfully',
            'data' => $addData
        ]);
    }

    // Show single
    public function show($id)
    {
        $record = Section::findOrFail($id);
        return response()->json($record);
    }

    // Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'section_name' => 'required|string|max:255|regex:/^[A-Za-z0-9\s]+$/',
            'is_active'  => 'boolean',
        ]);

        $record = Section::findOrFail($id);

        $record->section_name = $request->section_name;
        $record->is_active = $request->is_active;
        $record->save();

        return response()->json([
            'status' => true,
            'message' => 'Section updated successfully',
            'data' => $record
        ]);
    }

    public function destroy($id)
    {
        $record = Section::findOrFail($id);
        // $record->delete();

        return response()->json(['status' => true,'message' => 'Section deleted successfully']);
    }
}
