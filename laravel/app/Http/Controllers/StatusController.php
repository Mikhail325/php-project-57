<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Task;
use Spatie\QueryBuilder\QueryBuilder;

class StatusController extends Controller
{

    public function index()
    {
        $statuses = QueryBuilder::for(Status::class)
        ->orderBy('id', 'desc')
        ->paginate(9);
        return view('status.index', compact('statuses'));
    }

    public function create()
    {
        $status = new Status();
        return view('status.create', compact('status'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:statuses',
        ]);

        $status = new Status();
        // Заполнение статьи данными из формы
        $status->fill($data);
        // При ошибках сохранения возникнет исключение
        $status->save();
        flash('Статус успешно создан')->success();
        // Редирект на указанный маршрут
        return redirect()->route('status.index');
    }

    public function edit($id)
    {
        $status = Status::findOrFail($id);
        return view('status.edit', compact('status'));
    }

    public function update(Request $request, $id)
    {
        $status = Status::findOrFail($id);
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

    public function destroy($id)
    {
        $status = status::find($id);
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
