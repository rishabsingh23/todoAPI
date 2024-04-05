<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        return $this->todoService->getAllTodos();
    }

    public function store(AddTodoRequest $request)
    {
        $todo = $this->todoService->createTodo($request->all());
        return response()->json($todo, Response::HTTP_CREATED);
    }

    public function show(Todo $todo)
    {
        return $this->todoService->getTodoById($todo);
    }

    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo = $this->todoService->updateTodo($todo, $request->only(['title', 'description', 'completed','status']));
        return response()->json($todo, Response::HTTP_OK);
    }

    public function destroy(Todo $todo)
    {
        $todo = $this->todoService->deleteTodo($todo);
        return response()->json($todo, Response::HTTP_OK);
    }
}
