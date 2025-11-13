<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $records = Subject::with('subjectType')
            ->orderBy('subject_name', 'asc')
            ->paginate($perPage);

        return response()->json($records);
    }

    // Store new record
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'subject_type_id' => 'required|integer',            
            'short_name' => 'required|string',            
            'subject_name' => 'required|string',            
            'status'  => 'boolean',
        ]);

        $addData = Subject::create($validatedData);
        
        return response()->json([
            'status' => true,
            'message' => 'Subject created successfully',
            'data' => $addData
        ]);
    }

    // Show single
    public function show($id)
    {
        $record = Subject::findOrFail($id);
        return response()->json($record);
    }

    // Update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'subject_type_id' => 'required|integer',            
            'short_name' => 'required|string',            
            'subject_name' => 'required|string',            
            'status'  => 'boolean',
        ]);

        $record = Subject::findOrFail($id);

        $record->fill($validatedData);
        $record->save();

        return response()->json([
            'status' => true,
            'message' => 'Subject updated successfully',
            'data' => $record
        ]);
    }

    public function destroy($id)
    {
        $record = Subject::findOrFail($id);
        $record->delete();

        return response()->json(['status' => true,'message' => 'Subject deleted successfully']);
    }
}
