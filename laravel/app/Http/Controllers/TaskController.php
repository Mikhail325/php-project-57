<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task();
        $statuses = Status::all();
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
            'name' => 'required|unique:tasks', //--------------------dobavit
            'description' => 'required|required',
            'status_id' => 'required|integer',
            'user_executor_id' => 'required|integer',
            'label' => '',
        ]);
        $label = $data['label'] ?? [];
        unset($data['label']);

        $task = new Task();
        // Заполнение статьи данными из формы
        $task->fill($data);
        $task->user_author_id = Auth::id();
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
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $statuses = Status::all();
        $users = User::all();
        $labels = Label::all();
        return view('task.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $this->validate($request, [
            // У обновления немного измененная валидация. В проверку уникальности добавляется название поля и id текущего объекта
            // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
            'name' => 'required|unique:tasks,name,' . $task->id, //--------------------dobavit
            'description' => 'required|required:tasks,description' . $task->id,
            'status_id' => 'required|integer:tasks,status_id' . $task->id,
            'user_executor_id' => 'required|integer:tasks,user_executor_id' . $task->id,
            'label' => '',
        ]);
        $label = $data['label'] ?? [];
        unset($data['label']);

        $task->fill($data);
        $task->user_author_id = Auth::id();
        $task->save();

        $task->labels()->sync($label);
        flash('Задача успешно обновлена')->success();
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
        }
        flash('Задача успешно удалена')->success();
        return redirect()->route('task.index');
    }
}
