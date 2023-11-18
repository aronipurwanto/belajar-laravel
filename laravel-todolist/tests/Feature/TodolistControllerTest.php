<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            'user'=>'ahmadroni',
            'todolist'=>[
                [
                    'id'=>'1',
                    'todo'=>'todo 1'
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText('1')
            ->assertSeeText('todo 1');
    }

    public function testAddTodoFailed(){
        $this->withSession([
            'user'=>'ahmadroni',
        ])->post('/todolist',[
            'todo'=>''
        ])->assertSeeText('Todo is required');
    }

    public function testAddTodoSuccess(){
        $this->withSession([
            'user'=>'ahmadroni',
        ])->post('/todolist',[
            'todo'=>'Test todo'
        ])->assertRedirect('/todolist');
    }

    public function testRemoveTodoSuccess()
    {
        $this->withSession([
            'user'=>'ahmadroni',
            'todolist'=>[
                [
                    'id'=>'1',
                    'todo'=>'todo 1'
                ]
            ]
        ])->post('/todolist/1/delete')
            ->assertRedirect('/todolist');
    }

}
