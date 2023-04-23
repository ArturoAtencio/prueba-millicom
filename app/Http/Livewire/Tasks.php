<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Task;

class Tasks extends Component
{
    public $tasks = [];

    protected $rules = [
        'tasks.*.title' => 'required|string|min:6',
        'tasks.*.completed' => 'required|string|max:500',
    ];

    public function mount()
    {
        $this->tasks = Task::all();
    }

    public function render()
    {
        return view('livewire.tasks');
    }

    public function storeTask($id)
    {
        
    }

    public function completeTask($id)
    {
        $v = $this->tasks->filter(function($item) use ($id){

            return $item->id == $id;

        })->first();

        $v->completed = true;

        $v->save();
    }

    public function editTask($id)
    {
        $task = Task::find($id);        
            
        $v = $this->tasks->filter(function($item) use ($id){

            return $item->id == $id;

        })->first();

        if ( $task->completed ) { $v->completed = false; }
        
        $v->editing = true;
    }

    public function saveTask($id)
    {
        $task = Task::find($id);

        $v = $this->tasks->filter(function($item) use ($id){

            return $item->id == $id;

        })->first();        
        
        $v->editing = false;
        
        $task->title = $v->title;
        $task->completed = false;

        $task->save();
    }

    public function deleteTask($id)
    {
        dd(36, $id);
    }
}
