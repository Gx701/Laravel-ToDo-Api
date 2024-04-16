<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->completed = $request->input('completed', false); // Valor por defecto false si no se proporciona
        $task->created_at = now(); // Opcional, si deseas establecer la fecha de creación manualmente
        $task->updated_at = now(); // Opcional, si deseas establecer la fecha de actualización manualmente
        $task->save();

        return response()->json($task, 201); // Devuelve la tarea creada con el código de estado 201 (creado)
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $task = Task::findOrFail($id);

        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $task = Task::findOrFail($id);

        $task->title = $request->input('title', $task->title);
        $task->description = $request->input('description', $task->description);
        $task->completed = $request->input('completed', $task->completed);
        $task->updated_at = now(); // Actualiza la fecha de actualización

        $task->save();

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 204); // Devuelve una respuesta vacía con el código de estado 204 (sin contenido) para indicar que se ha eliminado correctamente
    }
}
