<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;
use Core\Application;
use Core\Controller;
use Core\Request;
use Core\Validation;
use Core\Response;

class LoginController extends Controller
{
    public function login(Request $request): bool
    {
        $data = $request->getBody();

        $validator = new Validation($data, [
            'login' => ['required'],
            'password' => ['required']
        ]);
        $validator->validate();

        if ($validator->isFailed()) {
            return Response::json(['errors' => $validator->getErrors()], 401);
        }

        $user = User::where('login', $data["login"])->first();
        if (!$user || !password_verify($data["password"], $user->password)) {
            $validator->setErrors('login', 'unique', 'Неверный логин или пароль');
            return Response::json(['errors' => $validator->getErrors()], 401);
        }

        User::login($user);

        return Response::json(['message' => 'Вы успешно авторизовались'], 200);
    }
}