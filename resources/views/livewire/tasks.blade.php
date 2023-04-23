<div>
    <div class="col-md-8" style="margin: auto;">        
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Lista de Tareas</h3>
            </div>
            <div class="card-body">
                {{-- <h5 class="card-title">Special title treatment</h5> --}}
                <br>
                <form class="mb-5">
                    <div class="form-group row mr-0">
                        <div class="col-md-10">
                            <input type="text" class="form-control @error('task') alert alert-danger  @enderror" 
                                placeholder="Crear Contenido del Blog"  
                                wire:model.defer="task" wire:keydown.enter="addTask()">
                            @error('task') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" wire:loading.attr="disabled" 
                                wire:click.prevent="addTask()">
                                <i class="fas fa-plus-circle" aria-hidden="true"></i> Agregar
                            </button>
                        </div>                        
                    </div>
                </form>
                <hr>
                <ul class="list-group" style="list-style:none;">
                    @foreach ($tasks as $k => $task)
                        <li class="my-2 {{-- justify-content-between align-items-center --}}"> 
                            <div class="input-group mt-3">
                                <div class="my-2">
                                    <i class="fas fa-plus" aria-hidden="true"></i>
                                </div>                                
                                <input class="form-control mx-2 @error('tasks.'.$k.'.title') alert alert-danger @enderror" 
                                    type="text" {{ $task->editing ? '' : 'disabled'}} 
                                    style="{{ $task->completed ? 'text-decoration: line-through;' : '' }}"
                                    wire:key="{{$k}}" wire:model.defer="tasks.{{ $k }}.title" >
                                <div>
                                    <button class="btn btn-md btn-outline-danger" {{ $task->editing ? 'disabled readonly' : ''}} 
                                        onclick="confirm('¿Está seguro?') || event.stopImmediatePropagation()"
                                        wire:loading.attr="disabled" 
                                        wire:click.prevent="deleteTask({{ $task->id }})">
                                        <i class="fas fa-times-circle" aria-hidden="true"></i>
                                    </button>
                                    @if ( $task->editing ) 
                                        <button class="btn btn-md btn-outline-info"
                                            wire:loading.attr="disabled" 
                                            wire:click.prevent="saveTask({{ $task->id }})">
                                            <i class="fas fa-save" aria-hidden="true"></i>
                                        </button>
                                    @else                                       
                                        <button class="btn btn-md btn-outline-info"
                                            wire:loading.attr="disabled" 
                                            wire:click.prevent="editTask({{ $task->id }})">
                                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                        </button>
                                    @endif
                                    <button class="btn btn-md btn-outline-success" 
                                        {{ ($task->completed || $task->editing) ? 'disabled readonly' : ''}}                                    
                                        wire:loading.attr="disabled" 
                                        wire:click.prevent="completeTask({{ $task->id }})">
                                        <i class="fas fa-check" aria-hidden="true"></i>
                                    </button>
                                </div>                                    
                            </div>
                            @error('tasks.'.$k.'.title') <span class="error mt-0 ml-4" style="color:red;">{{ $message }}</span> @enderror
                        </li>            
                    @endforeach
                </ul>
            </div>
        </div> 
    </div>
</div>