<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ClassSessionController extends Controller
{
    // List all sessions
    public function index()
    {
        $sessions = ClassSession::orderBy('id', 'DESC')->get();
        // $sessions = ClassSession::orderBy('id', 'DESC')->paginate(10);

        return response()->json($sessions);
    }

    // Store new session
    public function store(Request $request)
    {
        // return response()->json(['message' => 'Class session deleted successfully']);
        // dd("hi i am in store fucntion");
        // $request->validate([
        //     'session_name' => 'required|string|max:255',
        //     'start_date'   => 'nullable|date',
        //     'end_date'     => 'nullable|date|after_or_equal:start_date',
        // ]);

        $validator = Validator::make($request->all(), [
            'session_name' => 'required|string|max:255',
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $session = ClassSession::create([
            'session_name' => $request->session_name,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
        ]);

        return response()->json([
            'message' => 'Class session created successfully',
            'data' => $session
        ]);
    }

    // Show single session
    public function show($id)
    {
        $session = ClassSession::findOrFail($id);
        return response()->json($session);
    }

    // Update session
    public function update(Request $request, $id)
    {
        Log::info('Updated session', $request->all());

        // $request->validate([
        //     'session_name' => 'required|string|max:255',
        //     'start_date'   => 'nullable|date',
        //     'end_date'     => 'nullable|date|after_or_equal:start_date',
        // ]);

        // $session = ClassSession::findOrFail($id);
        // $session->update($request->only(['session_name', 'start_date', 'end_date']));

        $session = ClassSession::findOrFail($id);
        // Fill fields manually to ensure change detection works
        $session->session_name = $request->session_name;
        $session->start_date = date('Y-m-d', strtotime($request->start_date));
        $session->end_date   = date('Y-m-d', strtotime($request->end_date));
        // $session->save();
        $da = date('Y-m-d', strtotime($request->start_date));
        if ($session->save()) {
            Log::info('Session saved successfully',[$da]);
        } else {
            Log::error('Session not saved');
        }

        return response()->json([
            'message' => 'Class session updated successfully',
            'data' => $session
        ]);
    }

    // Delete session
    public function destroy($id)
    {
        $session = ClassSession::findOrFail($id);
        // $session->delete();

        return response()->json(['message' => 'Class session deleted successfully']);
    }
}
