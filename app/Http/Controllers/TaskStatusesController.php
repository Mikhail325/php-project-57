<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use App\Models\Task;
use Spatie\QueryBuilder\QueryBuilder;

class TaskStatusesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'taskStatus');
    }

    public function index()
    {
        $statuses = QueryBuilder::for(TaskStatus::class)
        ->orderBy('id', 'desc')
        ->paginate(9);
        return view('status.index', compact('statuses'));
    }

    public function create()
    {
        $status = new TaskStatus();
        return view('status.create', compact('status'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
        ]);

        $status = new TaskStatus();
        $status->fill($data);
        $status->save();
        flash(__('messages.Status successfully created'))->success();
        return redirect()->route('status.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        $status = $taskStatus;
        return view('status.edit', compact('status'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $id = $taskStatus->id;
        $status = TaskStatus::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required:task_statuses,name,' . $status->id,
        ]);

        $status->fill($data);
        $status->save();
        flash(__('messages.Status successfully changed'))->success();
        return redirect()->route('status.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        $id = $taskStatus->id;

        $status = TaskStatus::find($id);
        $statuses = Task::where('status_id', $id)->first();

        if (empty($statuses)) {
            $status->delete();
            flash(__('messages.Status successfully deleted'))->success();
            return redirect()->route('status.index');
        }
        flash(__('messages.Failed to delete status'))->error();
        return redirect()->route('status.index');
    }
}
