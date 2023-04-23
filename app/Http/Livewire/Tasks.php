<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Task;

class Tasks extends Component
{
    public $task = '';

    public $tasks = [];

    protected $rules = [
        'tasks.*.title' => 'required|string|min:6|max:100',
    ];
    
    protected $messages = [
        
        'task.required' => 'Debe ser un texto entre 6 y 100 caracteres!',
        'task.min'      => 'Debe ser un texto de mínimo 6 caracteres!',
        'task.max'      => 'Debe ser un texto de máximo 100 caracteres!',
        
        'tasks.*.title.required' => 'El campo es requerido!',
        'tasks.*.title.min'      => 'Debe ser un texto de mínimo 6 caracteres!',
        'tasks.*.title.max'      => 'Debe ser un texto de máximo 100 caracteres!',
    ];

    public function mount()
    {
        $this->loader();
    }

    public function addTask()
    {
        $this->validate(['task' => 'required|string|min:6|max:100']);

        try {

            Task::create([
                'title'     => $this->task,
                'completed' => false,
                'user_id'   => 1,
            ]);
        
            $this->task = '';

        } catch (\Throwable $th) {

            dd(51, $th->getMessage());
        }

        $this->loader();
    }

    public function completeTask($id)
    {
        $v = $this->filter($id);

        try {
            
            $v->completed = true;
    
            $v->save();

        } catch (\Throwable $th) {
            
            dd(70, $th->getMessage());
        }
    }

    public function editTask($id)
    {       
        $v = $this->filter($id);

        $v->editing = true;
        
        try {
            
            $task = Task::find($id);

            if ( $task->completed ) { $v->completed = false; }
            
        } catch (\Throwable $th) {
            
            dd(88, $th->getMessage());
        }
    }

    public function saveTask($id)
    {
        $this->validate();

        $v = $this->filter($id);

        try {

            $task = Task::find($id);
            
            $task->title     = $v->title;
            $task->completed = false;
    
            $task->save();            
            
        } catch (\Throwable $th) {
            
            dd(109, $th->getMessage());
        }
        
        $v->editing = false;
    }

    public function deleteTask($id)
    {
        try {
            
            $task = Task::find($id);

            $task->delete();

        } catch (\Throwable $th) {
            
            dd(125, $th->getMessage());
        }

        $this->loader();
    }

    private function filter($id)
    {
        try {

            return $this->tasks->filter(function($item) use ($id){
    
                return $item->id == $id;
    
            })->first();

        } catch (\Throwable $th) {
            
            dd(143, $th->getMessage());
        }
    }

    private function loader()
    {
        try {
            
            $this->tasks = Task::orderBy('id', 'desc')->get();

        } catch (\Throwable $th) {
            
            dd(155, $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.tasks');
    }
}
