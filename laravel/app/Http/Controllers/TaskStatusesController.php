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
            'name' => 'required|unique:statuses',
        ]);

        $status = new TaskStatus();
        // Заполнение статьи данными из формы
        $status->fill($data);
        // При ошибках сохранения возникнет исключение
        $status->save();
        flash('Статус успешно создан')->success();
        // Редирект на указанный маршрут
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
            // У обновления немного измененная валидация. В проверку уникальности добавляется название поля и id текущего объекта
            // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
            'name' => 'required|unique:statuses,name,' . $status->id,
        ]);

        $status->fill($data);
        $status->save();
        flash('Статус успешно изменен')->success();
        return redirect()->route('status.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        $id = $taskStatus->id;

        $status = TaskStatus::find($id);
        $statuses = Task::where('status_id', $id)->first();

        if (empty($statuses)) {
            $status->delete();
            flash('Статус успешно удален')->success();
            return redirect()->route('status.index');
        }

        flash('Не удалось удалить статус')->error();
        return redirect()->route('status.index');
    }
}
