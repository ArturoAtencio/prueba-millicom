<div>

    <h2 class="text-center">Lista de Tareas</h2>
    <br>

    <form class="">
        <div class="form-group row">
            <div class="col-md-10">
                <input type="text" name="addTodo" class="form-control form-control-lg" id="addTodo" placeholder="Crear Contenido del Blog"  
                    wire:model="title" wire:keydown.enter="addTodo">
                @if ($errors->has('title'))
                    <div style="color:red;">{{ $errors->first('title') }}</div>
                @endif
            </div>
            
            <button class="btn btn-primary col-md-2" wire:click="addTodo" type="submit">Agregar</button>
        </div>
    </form>


    <ul class="list-group">
        @foreach ($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{$task->title}}
            </li>

        @endforeach
    </ul>

</div>