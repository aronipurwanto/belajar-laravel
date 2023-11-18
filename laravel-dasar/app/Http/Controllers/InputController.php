<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input('name', 'Roni');
        return "Hello $name";
    }

    public function first(Request $request): string
    {
        $firstName = $request->input('name.first');
        $lastName = $request->input('name.last');

        return "Hello $firstName";
    }

    public function input(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }

    public function inputArray(Request $request): string
    {
        $inputs = $request->input('product.*.name');
        return json_encode($inputs);
    }

    public function inputType(Request $request):string {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthDate = $request->date('birth_date','Y-m-d');

        return json_encode([
            'name' => $name,
            'married' => $married,
            'birth_date' => $birthDate->format('Y-m-d')
        ]);
    }

    public function inputOnly(Request $request): string{
        $name = $request->only("name.first","name.last");
        return json_encode($name);
    }

    public function inputExcept(Request $request): string{
        $user = $request->except("admin");
        return json_encode($user);
    }
}
