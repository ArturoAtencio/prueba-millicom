<div>
    <div class="col-md-8" style="margin: auto;">        
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Lista de Tareas</h2>
            </div>
            <div class="card-body ">
                {{-- <h5 class="card-title">Special title treatment</h5> --}}
                <br>
                <form class="">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="text" name="addTodo" class="form-control form-control-lg" id="addTodo" placeholder="Crear Contenido del Blog"  
                                wire:model.defer="title" wire:keydown.enter="addTodo">
                            @if ($errors->has('title'))
                                <div style="color:red;">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        
                        <button class="btn btn-primary col-md-2" wire:click="addTodo" type="submit">Agregar</button>
                    </div>
                </form>
                <br><br>
                <ul class="list-group">
                    @foreach ($tasks as $k => $task)
                        <li class="my-2 d-flex justify-content-between align-items-center"> 
                            <div class="input-group mb-3">
                                <div class="my-2">
                                    <i class="fas fa-plus" aria-hidden="true"></i>
                                </div>                                
                                <input class="form-control mx-2" type="text" {{ $task->editing ? '' : 'disabled'}} 
                                    wire:model.defer="tasks.{{ $k }}.title" 
                                    style="{{ $task->completed ? 'text-decoration: line-through;' : '' }}">
                                <div>
                                    <button class="btn btn-md btn-outline-danger" {{ $task->editing ? 'disabled readonly' : ''}} 
                                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                        wire:click.prevent="deleteTask({{ $task->id }})">
                                        <i class="fas fa-times-circle" aria-hidden="true"></i>
                                    </button>
                                    @if ( $task->editing ) 
                                        <button class="btn btn-md btn-outline-info"
                                            wire:click.prevent="saveTask({{ $task->id }})">
                                            <i class="fas fa-save" aria-hidden="true"></i>
                                        </button>
                                    @else                                       
                                        <button class="btn btn-md btn-outline-info"
                                            wire:click.prevent="editTask({{ $task->id }})">
                                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                        </button>
                                    @endif
                                    <button class="btn btn-md btn-outline-success" {{ ($task->completed || $task->editing) ? 'disabled readonly' : ''}}                                    
                                        wire:click.prevent="completeTask({{ $task->id }})">
                                        <i class="fas fa-check" aria-hidden="true"></i>
                                    </button>
                                </div>                                    
                            </div>
                        </li>            
                    @endforeach
                </ul>
            </div>
        </div> 
    </div>


    <script>
        let todoUpdated = '';
        function updateTodoPrompt(title) {
          event.preventDefault();
          todoUpdated = '';
          const todo = prompt('Update Todo', title);
          if (todo === null || todo.trim() === '') {
            console.log('cancel or empty');
            todoUpdated = '';
            return false;
          }
          todoUpdated = todo;
          return true;
        }
    </script>

</div>