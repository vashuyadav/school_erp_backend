<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $records = SchoolClass::when($status !== null && $status !== '', function ($query) use ($status) {
            $query->where('is_active', $status);
        })
        ->get();
        // $records = SchoolClass::where('is_active', $status)->get();
        // $records = SchoolClass::orderBy('id', 'DESC')->get();

        return response()->json($records);
    }

    // Store new session
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'class_name' => 'required|string|max:255|regex:/^[A-Za-z0-9\s]+$/',
            'is_active'  => 'boolean',
        ]);

        $addData = SchoolClass::create($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'Class created successfully',
            'data' => $addData
        ]);
    }

    // Show single
    public function show($id)
    {
        $record = SchoolClass::findOrFail($id);
        return response()->json($record);
    }

    // Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'is_active'  => 'boolean',
        ]);

        $record = SchoolClass::findOrFail($id);

        $record->class_name = $request->class_name;
        $record->is_active = $request->is_active;
        $record->save();

        return response()->json([
            'status' => true,
            'message' => 'Class updated successfully',
            'data' => $record
        ]);
    }

    public function destroy($id)
    {
        $record = SchoolClass::findOrFail($id);
        $record->delete();

        return response()->json(['status' => true, 'message' => 'Class deleted successfully']);
    }
}
