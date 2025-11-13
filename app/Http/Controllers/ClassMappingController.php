<?php

namespace App\Http\Controllers;

use App\Models\ClassMapping;
use Illuminate\Http\Request;

class ClassMappingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $records = ClassMapping::with(['session', 'class', 'section'])
            ->orderBy('class_id', 'asc')
            ->orderBy('section_id', 'asc')
            ->paginate($perPage);

        return response()->json($records);
    }

    // Store new record
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'session_id' => 'required|integer',            
            'class_id' => 'required|integer',            
            'section_id' => 'required|integer',            
            'status'  => 'boolean',
        ]);

        $addData = ClassMapping::create($validatedData);
        
        return response()->json([
            'status' => true,
            'message' => 'Class mapping created successfully',
            'data' => $addData
        ]);
    }

    // Show single
    public function show($id)
    {
        $record = ClassMapping::findOrFail($id);
        return response()->json($record);
    }

    // Update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'session_id' => 'required|integer',            
            'class_id' => 'required|integer',            
            'section_id' => 'required|integer',            
            'status'  => 'boolean',
        ]);

        $record = ClassMapping::findOrFail($id);

        // $record->session_id = $request->session_id;
        // $record->class_id = $request->class_id;
        // $record->section_id = $request->section_id;
        // $record->status = $request->status;

        $record->fill($validatedData);
        $record->save();

        return response()->json([
            'status' => true,
            'message' => 'Class mapping updated successfully',
            'data' => $record
        ]);
    }

    public function destroy($id)
    {
        $record = ClassMapping::findOrFail($id);
        // $record->delete();

        return response()->json(['status' => true,'message' => 'Class mapping deleted successfully']);
    }
}
