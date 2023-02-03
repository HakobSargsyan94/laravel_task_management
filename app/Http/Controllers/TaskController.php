<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->paginate(10);

        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();

        return view('task.create', ['projects' => $projects]);
    }

    /**
     * @param $request
     * @return bool
     */
    private function uploadFiles ($request) {
        $file = $request->file('file');
        if ($file) {
            $destinationPath = 'uploads';
            $res = $file->move($destinationPath,$file->getClientOriginalName());

            if ($res) {
                return true;
            }

            return false;
        } else {
            return true;
        }
    }

    /**
     * @param StoreTaskRequest $request
     * @param Task $model
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function store(StoreTaskRequest $request, Task $model)
    {
        $validated = $request->validated();

        if (!$validated) {
            return redirect()->back()->withInput();
        }

        try {
            $this->uploadFiles($request);
            $model::create([
                'title' => $request->title,
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
                'status' => $request->status,
                'file' => $request->file('file') ? $request->file('file')->getClientOriginalName() : ''
            ]);

            return redirect(route('task.index'));
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Task $task)
    {
        return view('task.show', ['task' => $task]);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('task.edit', ['task' => $task, 'projects' => $projects]);
    }

    /**
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validated();

        if (!$validated) {
            return redirect()->back()->withInput();
        }

        try {
            $tasks = Task::find($request->id);
            $tasks->update([
                'title' => $request->title,
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
                'status' => $request->status,
                'file' => $request->file('file') ? $request->file('file')->getClientOriginalName() : $tasks->file
            ]);

            return redirect(route('task.index'));
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect(route('task.index'));
    }
}
