<?php

namespace App\Http\Controllers;
use App\Models\Status;
class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('status', compact('statuses'));
    }

    public function create()
    {
        $status = [
            'name' => 'exampl 3'
        ];
        
        Status::create($status);
        dd('create');
    }

    public function update()
    {
        $status = Status::find(1);
        $status->update([
            'name' => 'kek'
        ]);

        dd('update');
    }

    public function delete()
    {
        $status = Status::find(1);
        $status->delete();

        dd('delete');
    }
}
