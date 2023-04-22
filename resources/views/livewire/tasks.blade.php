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
              <div>
                <input type="checkbox" wire:change="toggleTodo({{$task->id}})" class="mr-4" {{$task->completed ? 'checked' : ''}}>
                <a
                    href="#"
                    class="{{ $task->completed ? 'completed' : ''}}"
                    onclick="updateTodoPrompt('{{$task->title}}') || event.stopImmediatePropagation()"
                    wire:click="updateTodo({{$task->id}}, todoUpdated)"
                >
                    {{ $task->title }}
                </a>
              </div>
              <div>

                  <button
                    class="btn btn-sm btn-danger"
                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                    wire:click="deleteTodo({{ $task->id }})">
                &times;</button>

              </div>
            </li>

        @endforeach
    </ul>


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