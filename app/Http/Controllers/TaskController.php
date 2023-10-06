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
        $this->authorizeResource(Task::class, 'task');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('user_author_id'),
                AllowedFilter::exact('user_executor_id'),
                ])
            ->orderBy('id', 'desc')
            ->paginate(5);

        $statuses = TaskStatus::all();
        $users = User::all();

        return view('task.index', compact('tasks', 'statuses', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task();
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('task.create', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:tasks',
            'description' => 'required|required',
            'status_id' => 'required|integer',
            'assigned_to_id' => 'required|integer',
            'label' => '',
        ]);
        $label = $data['label'] ?? [];
        unset($data['label']);

        $task = new Task();
        // Заполнение статьи данными из формы
        $task->fill($data);
        $task->created_by_id = Auth::id();
        $task->save();
        
        $task->labels()->attach($label);
        // При ошибках сохранения возникнет исключение
        
        flash(__('messages.The task was successfully created'))->success();
        // Редирект на указанный маршрут
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('task.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:tasks,name,' . $task->id,
            'description' => 'required|required:tasks,description' . $task->id,
            'status_id' => 'required|integer:tasks,status_id' . $task->id,
            'assigned_to_id' => 'required|integer:tasks,assigned_to_id' . $task->id,
            'label' => '',
        ]);
        $label = $data['label'] ?? [];
        unset($data['label']);

        $task->fill($data);
        $task->created_by_id = Auth::id();
        $task->save();

        $task->labels()->sync($label);
        flash(__('messages.The task has been successfully updated'))->success();
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        flash(__('messages.The task was successfully deleted'))->success();
        return redirect()->route('task.index');
    }
}
