<?php

namespace App\Http\Controllers;

use App\Models\SubjectMapping;
use Illuminate\Http\Request;

class SubjectMappingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $records = SubjectMapping::with(['class', 'section', 'subject'])
            ->orderBy('class_id', 'asc')
            ->orderBy('section_id', 'asc')
            ->orderBy('subject_id', 'asc')
            ->paginate($perPage);

        return response()->json($records);
    }

    // Store new record
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'class_id' => 'required|integer',            
            'section_id' => 'required|integer',            
            'subject_id' => 'required|integer',            
            'status'  => 'boolean',
        ]);

        $addData = SubjectMapping::create($validatedData);
        
        return response()->json([
            'status' => true,
            'message' => 'Subject mapping created successfully',
            'data' => $addData
        ]);
    }

    // Show single
    public function show($id)
    {
        $record = SubjectMapping::findOrFail($id);
        return response()->json($record);
    }

    // Update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'class_id' => 'required|integer',            
            'section_id' => 'required|integer',            
            'subject_id' => 'required|integer',            
            'status'  => 'boolean',
        ]);

        $record = SubjectMapping::findOrFail($id);

        $record->fill($validatedData);
        $record->save();

        return response()->json([
            'status' => true,
            'message' => 'Subject mapping updated successfully',
            'data' => $record
        ]);
    }

    public function destroy($id)
    {
        $record = SubjectMapping::findOrFail($id);
        // $record->delete();

        return response()->json(['status' => true,'message' => 'Subject mapping deleted successfully']);
    }
}
