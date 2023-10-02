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
            'name' => 'required|unique:tasks', //--------------------добавить валидоцию описания до 255 символов
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
        
        flash('Задача успешно создана')->success();
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
            // У обновления немного измененная валидация. В проверку уникальности добавляется название поля и id текущего объекта
            // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
            'name' => 'required|unique:tasks,name,' . $task->id, //--------------------dobavit
            'description' => 'required|required:tasks,description' . $task->id, //--------------------добавить валидоцию описания до 255 символов
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
        flash('Задача успешно обновлена')->success();
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        flash('Задача успешно удалена')->success();
        return redirect()->route('task.index');
    }
}
