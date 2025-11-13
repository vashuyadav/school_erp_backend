<?php

namespace App\Http\Controllers;

use App\Models\SubjectType;
use Illuminate\Http\Request;

class SubjectTypeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $records = SubjectType::orderBy('name', 'asc')->paginate($perPage);

        return response()->json($records);
    }

    // Store new record
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string',            
            'status'  => 'boolean',
        ]);

        $addData = SubjectType::create($validatedData);
        
        return response()->json([
            'status' => true,
            'message' => 'Subject type created successfully',
            'data' => $addData
        ]);
    }

    // Show single
    public function show($id)
    {
        $record = SubjectType::findOrFail($id);
        return response()->json($record);
    }

    // Update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',            
            'status'  => 'boolean',
        ]);

        $record = SubjectType::findOrFail($id);

        $record->fill($validatedData);
        $record->save();

        return response()->json([
            'status' => true,
            'message' => 'Subject type updated successfully',
            'data' => $record
        ]);
    }

    public function destroy($id)
    {
        $record = SubjectType::findOrFail($id);
        $record->delete();

        return response()->json(['status' => true,'message' => 'Subject type deleted successfully']);
    }
}
