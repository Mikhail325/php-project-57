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
        $this->authorizeResource(TaskStatus::class);
    }

    public function index()
    {
        $statuses = QueryBuilder::for(TaskStatus::class)
        ->orderBy('id')
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
        $messages = [
            'name.required' => 'Это обязательное поле',
            'name.unique' => 'Статус с таким именем уже существует'
        ];

        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses',
        ], $messages);

        $status = new TaskStatus();
        $status->fill($data);
        $status->save();
        flash(__('messages.Status successfully created'))->success();
        return redirect()->route('task_statuses.index');
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

        $messages = [
            'name.required' => 'Это обязательное поле',
            'name.unique' => 'Статус с таким именем уже существует'
        ];

        $data = $this->validate($request, [
            'name' => 'unique:task_statuses|required:task_statuses,name,' . $status->id,
        ], $messages);

        $status->fill($data);
        $status->save();
        flash(__('messages.Status successfully changed'))->success();
        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        $id = $taskStatus->id;

        $status = TaskStatus::find($id);
        $statuses = Task::where('status_id', $id)->first();

        if (empty($statuses)) {
            $status->delete();
            flash(__('messages.Status successfully deleted'))->success();
            return redirect()->route('task_statuses.index');
        }
        flash(__('messages.Failed to delete status'))->error();
        return redirect()->route('task_statuses.index');
    }
}
