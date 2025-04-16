<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{




    public function index()
    {
        $user = auth()->user();

        return view('pages.dashboard.dashboard-student', [
            'todoAssessments' => $user->assessments()->wherePivot('status', 'todo')->get(),
            'doneAssessments' => $user->assessments()->wherePivot('status', 'done')->get(),
            'pendingTasks'    => $user->commonTasks()->whereNull('common_task_user.done_at')->get(),
            'doneTasks'       => $user->commonTasks()->whereNotNull('common_task_user.done_at')->get(),
        ]);
    }
}
