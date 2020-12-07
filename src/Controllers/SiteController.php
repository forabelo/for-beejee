<?php

namespace App\Controllers;

use App\Models\Task;
use Core\Controller;
use Core\Request;
use Core\Validation;
use Core\Response;

class SiteController extends Controller
{
    /**
     * @return \Core\Router
     */
    public function index(): \Core\Router
    {
        $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
        $sortedBy = isset($_GET["sort"]) ? $_GET["sort"] : 'name';
        $orderedBy = isset($_GET["order"]) && $_GET["order"] === 'desc' ? $_GET["order"] : 'asc';
        $pageLimit = 3;

        $tasks = Task::with('user')->orderBy($sortedBy, $orderedBy)->get();
        if (!$tasks) {
            $tasks = Task::with('user')->orderBy('name', $orderedBy)->get();
        }

        $paginatedTasks = $tasks->skip(($currentPage - 1) * $pageLimit)->take($pageLimit);
        $tasksCount = $tasks->count();

        return $this->view('main', ['tasks' => $paginatedTasks, 'sort' => [
            'sortedBy' => $sortedBy,
            'orderedBy' => $orderedBy,
        ], 'pagination' => [
            'totalRecords' => $tasksCount,
            'limit' => $pageLimit,
            'totalPages' => ceil($tasksCount / $pageLimit),
            'currentPage' => isset($_GET["page"]) ? $_GET["page"] : 1
        ]]);
    }

    /**
     * @return \Core\Router
     */
    public function login(): \Core\Router
    {
        return $this->view('login');
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function createTask(Request $request): bool
    {
        $data = $request->getBody();
        $validator = new Validation($data, [
            'name' => ['required', ['unique' => Task::class]],
            'email' => ['required', 'email'],
            'description' => ['required']
        ]);

        $validator->validate();

        if ($validator->isFailed()) {
            return Response::json(['errors' => $validator->getErrors()], 406);
        }
        Task::create([
           'name' => htmlspecialchars($data["name"]),
           'email' => $data["email"],
           'description' => $data["description"]
        ]);
        return Response::json(['message' => 'Вы успешно добавили новую задачу'], 200);
    }
}