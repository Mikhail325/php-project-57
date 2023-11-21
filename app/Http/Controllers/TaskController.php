<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\User;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('assigned_to_id'),
                AllowedFilter::exact('created_by_id')
                ])
            ->orderBy('id')
            ->paginate(5);

        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        $filter = $request->filter ?? null;

        return view('task.index', compact('tasks', 'statuses', 'users', 'filter'));
    }

    public function create()
    {
        $task = new Task();
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('task.create', compact('task', 'statuses', 'users', 'labels'));
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Это обязательное поле',
            'name.unique' => 'Задача с таким именем уже существует',
            'status_id' => 'Это обязательное поле',
            'assigned_to_id' => 'Это обязательное поле',
        ];
        $data = $this->validate($request, [
            'name' => 'required|unique:tasks',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'required',
            'label' => '',
        ], $messages);

        $labels = $data['label'] ?? [];

        $task = new Task();
        $task->fill($data);
        $task->created_by_id = (int) Auth::id();
        $task->save();
        $task->labels()->attach($labels);

        flash(__('messages.The task was successfully created'))->success();
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('task.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    public function update(Request $request, Task $task)
    {
        $messages = [
            'name' => 'Это обязательное поле',
            'status_id' => 'Это обязательное поле',
        ];

        $data = $this->validate($request, [
            'name' => 'required:tasks,name,' . $task->id,
            'description' => 'nullable:tasks,description' . $task->id,
            'status_id' => 'required:tasks,status_id' . $task->id,
            'assigned_to_id' => 'required:tasks,assigned_to_id' . $task->id,
            'label' => '',
        ], $messages);
        $labels = $data['label'] ?? [];

        $task->fill($data);
        $task->save();

        $task->labels()->sync($labels);
        flash(__('messages.The task has been successfully updated'))->success();
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if ($task->created_by_id !== (int) Auth::id()) {
            flash(__('messages.Only the author can delete the task'))->error();
        } else {
            $task->delete();
            flash(__('messages.The task was successfully deleted'))->success();
        }
        return redirect()->route('tasks.index');
    }
}
