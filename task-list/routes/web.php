<?php
use Illuminate\Http\Response;
//use Symfony\Component\HttpFoundation\Response;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

 Route::get('/', function () {
    return redirect()->route('tasks.index');
}); 

//LISTAR
Route::get('/tasks', function (){
    return view('index', [
        
        'tasks' => \App\Models\Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

//CREAR FORMULARIO
Route::view('/tasks/create','create')
    ->name('tasks.create');


//EDITAR FORMULARIO
    Route::get('/tasks/{task}/edit',function (Task $task) {
    return view('edit', [
        'task'=> $task
    ]);
})->name('tasks.edit');


//MOSTRAR DETALLE
    Route::get('/tasks/{task}',function (Task $task) {
    return view('show', [
        'task'=>$task
    ]);
})->name('tasks.show');

//GUARDAR NUEVA TAREA 
Route::post('/tasks', function(TaskRequest $request) {
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show',['task'=>$task->id])
    ->with('success', 'Task created successfully!');
})->name('tasks.store');

// ACTUALIZAR TAREA EXISTENTE
Route::put('/tasks/{task}', function (TaskRequest $request, Task $task ) {
    $data = $request->validated();
    $task ->update($request->validated());
    return redirect()
        ->route('tasks.show',  $task)
        ->with('success', 'Task updated successfully!');
})->name('tasks.update'); 

//BORRAR  REGISTRO
Route::delete('/tasks/{task}', function(Task $task){
    $task->delete();
    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');
