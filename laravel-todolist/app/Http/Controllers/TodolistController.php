<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodolistController extends Controller
{
    private TodolistService $service;

    /**
     * @param TodolistService $service
     */
    public function __construct(TodolistService $service)
    {
        $this->service = $service;
    }


    public function getTodo(Request $request) : Response
    {
        $todolist = $this->service->getTodolist();

        return \response()->view('todolist.todolist',[
            'title' => 'Todolist',
            'todolist' => $todolist
        ]);
    }

    public function addTodo(Request $request) : Response | RedirectResponse
    {
        $todo = $request->input('todo');
        if(empty($todo)){
            $todolist = $this->service->getTodolist();
            return response()->view('todolist.todolist',[
                'title' => 'Todolist',
                'todolist' => $todolist,
                'error'=>'Todo is required'
            ]);
        }

        $this->service->saveTodo(uniqid(),$todo);
        return redirect()->action([TodolistController::class,'getTodo']);
    }

    public function removeTodo(Request $request, string $todoId) : RedirectResponse
    {
        $this->service->removeTodo($todoId);
        return redirect()->action([TodolistController::class,'getTodo']);
    }
}
