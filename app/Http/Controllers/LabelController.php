<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\LabelTask;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = QueryBuilder::for(Label::class)
        ->orderBy('id', 'desc')
        ->paginate(9);
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
    
        flash(__('messages.The label was created successfully'))->success();
        // Редирект на указанный маршрут
        return redirect()->route('label.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        $id = $label->id;
        $label = Label::findOrFail($id);
        $data = $this->validate($request, [
            // У обновления немного измененная валидация. В проверку уникальности добавляется название поля и id текущего объекта
            // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
            'name' => 'required|unique:labels,name,' . $label->id,
            'description' => 'required|unique:labels,description,' . $label->id,
        ]);

        $label->fill($data);
        $label->save();
        flash(__('messages.Label changed successfully'))->success();
        return redirect()->route('label.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        $id = $label->id;
        $label = Label::find($id);
        $labels = LabelTask::where('label_id', $id)->first();

        if (empty($labels)) {
            $label->delete();
            flash(__('messages.The label was successfully deleted'))->success();
            return redirect()->route('label.index');
        }

        flash(__('messages.Failed to delete label'))->error();
        return redirect()->route('label.index');
    }
}
