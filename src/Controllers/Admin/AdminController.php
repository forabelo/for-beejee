<?php


namespace App\Controllers\Admin;


use App\Models\Task;
use Core\Application;
use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Validation;

class AdminController extends Controller
{

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        if (Application::$app->request->isAuthenticated() === false) {
            Application::$app->response->redirect('/');
            exit();
        }
    }

    public function logout(): void
    {
        unset($_SESSION["user"]);
        Application::$app->response->redirect('/login');
    }

    /**
     * @param Request $request
     * @return \Core\Router
     */
    public function index(Request $request): \Core\Router
    {
        $task = Task::where('id', $_GET["id"])->first();
        return $this->view('edit', ['task' => $task]);
    }

    /**
     * @param Request $request
     */
    public function edit(Request $request)
    {
        $data = $request->getBody();

        Task::where('id', $data["id"])->update([
            'name' => $data["name"],
            'email' => $data["email"],
            'description' => $data["description"],
            'status' => 1
        ]);

        Application::$app->response->redirect('/');
        return 0;
    }
}