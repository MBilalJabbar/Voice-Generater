<?php

namespace App\Http\Controllers;

use App\Models\TaskHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function taskhistory()
    {
        $userTask = TaskHistory::where('user_id', Auth::id())->get();
        return view('taskhistory.index', compact('userTask'));
    }
    public function taskDeleted($id){
        try {
        $task = TaskHistory::find($id);
         if (!$task) {
                return response()->json(['error' => 'Task not found'], 404);
            }

            $task->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function TaskShowModal($id){
        try {
            $task = TaskHistory::find($id);
             if (!$task) {
                    return response()->json(['error' => 'Task not found'], 404);
                }

                return response()->json(['success' => true, 'data' => $task]);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
    }
}
