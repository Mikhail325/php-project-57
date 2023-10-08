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
        $this->authorizeResource(Label::class);
    }
    
    public function index()
    {
        $labels = QueryBuilder::for(Label::class)
        ->orderBy('id')
        ->paginate(9);
        return view('label.index', compact('labels'));
    }

    public function create()
    {
        $labels = new Label();
        return view('label.create', compact('labels'));
    }

    public function store(Request $request)
    {
        $messages = [
            'name' => 'Это обязательное поле',
            'name.unique' => 'Метка с таким именем уже существует'
          ];

        $data = $this->validate($request, [
            'name' => 'required|unique:labels',
            'description' => 'nullable',
        ], $messages);
    
        $labels = new Label();
        $labels->fill($data)->save();
    
        flash(__('messages.The label was created successfully'))->success();
        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $messages = [
            'name' => 'Это обязательное поле'
        ];

        $data = $this->validate($request, [
            'name' => 'required:labels,name,' . $label->id,
            'description' => 'nullable:labels,description,' . $label->id,
        ], $messages);

        $label->fill($data)->save();

        flash(__('messages.Label changed successfully'))->success();
        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
    {
        $labels = LabelTask::where('label_id', $label->id)->first();

        if (empty($labels)) {
            $label->delete();
            flash(__('messages.The label was successfully deleted'))->success();
        } else {
            flash(__('messages.Failed to delete label'))->error();
        }

        
        return redirect()->route('labels.index');
    }
}
