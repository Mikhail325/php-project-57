<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\LabelTask;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::all();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labels = new Label();
        return view('label.create', compact('labels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:labels',
            'description' => 'required|unique:labels',
        ]);
    
        $labels = new Label();
        // Заполнение статьи данными из формы
        $labels->fill($data);
        // При ошибках сохранения возникнет исключение
        $labels->save();
    
        flash('Метка успешно создана')->success();
        // Редирект на указанный маршрут
        return redirect()->route('label.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $label = Label::findOrFail($id);
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $label = Label::findOrFail($id);
        $data = $this->validate($request, [
            // У обновления немного измененная валидация. В проверку уникальности добавляется название поля и id текущего объекта
            // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
            'name' => 'required|unique:labels,name,' . $label->id,
            'description' => 'required|unique:labels,description,' . $label->id,
        ]);

        $label->fill($data);
        $label->save();
        flash('Метка успешно изменена')->success();
        return redirect()->route('label.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $label = Label::find($id);
        $labels = LabelTask::where('label_id', $id)->first();

        if (empty($labels)) {
            $label->delete();
            flash('Метка успешно удалена')->success();
            return redirect()->route('label.index');
        }

        flash('Не удалось удалить метку')->error();
        return redirect()->route('label.index');
    }
}
