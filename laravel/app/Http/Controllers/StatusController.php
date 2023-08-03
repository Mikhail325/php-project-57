<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    public function index()
    {
        $statuses = Status::all();
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
        return redirect()
            ->route('status.index');
    }

    public function destroy($id)
    {
        $status = status::find($id);
    if ($status) {
      $status->delete();
    }
    return redirect()->route('status.index');
    }
}
