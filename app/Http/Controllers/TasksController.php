<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeTaskRequest;
use App\Http\Requests\updateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Traits\DatetimeTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TasksController extends Controller
{
    use ResponseTrait;
    use DatetimeTrait;

    public function index()
    {
        $tasks = Task::getAllTasks();

        return response()->json($tasks);
    }

    public function store(storeTaskRequest $request)
    {
        App::setLocale($request->header('language'));

        $taskCreated = Task::create($request->validated());
        $task = Task::getTaskById($taskCreated->id);

        if (!$taskCreated->starts_at) {
            $task->update([
                'starts_at' => date('Y-m-d H:i:s')
            ]);
        }

        $task->update([
            'starts' => $this->convertDateToTimezone(
                $task->starts_at,
                'Y-m-d H:i:s',
                $request->header('timezone')
            )->format('Y-m-d')
        ]);

        return $this->setResponseWithResource(
            new TaskResource($task),
            __('messages.created_task', ['name' => $task->name]),
            201
        );
    }

    public function update(updateTaskRequest $request, $id)
    {
        App::setLocale($request->header('language'));

        $task = Task::getTaskById($id);

        if (isset($task)) {
            $validated = $request->validated();

            foreach ($validated as $key => $value) {
                $task[$key] = $value;

                if ($key == 'starts_at') {
                    $task->starts = $this->convertDateToTimezone(
                        $value,
                        'Y-m-d H:i:s',
                        $request->header('timezone')
                    )->format('Y-m-d');
                }
            }

            $task->save();

            return $this->setResponseWithResource(
                new TaskResource($task),
                __('messages.updated_task', ['name' => $task->name])
            );
        }

        return $this->setResponse(__('messages.not_found_task', ['id' => $id]), 400);
    }

    public function remove(Request $request, $id)
    {
        App::setLocale($request->header('language'));

        $task = Task::getTaskById($id);

        if (isset($task)) {
            $task->delete();
            return $this->setResponse(__('messages.removed_task', ['name' => $task->name]));
        }

        return $this->setResponse(__('messages.not_found_task', ['id' => $id]), 400);
    }

    public function removeAllTasks(Request $request)
    {
        App::setLocale($request->header('language'));

        $tasks = Task::getAllTasks();

        if (count($tasks->toArray()) > 0) {
            $tasks->toQuery()->delete();

            return $this->setResponse(__('messages.removed_tasks'));
        }

        return $this->setResponse(__('messages.not_found_tasks'));
    }

    public function completeTask(Request $request)
    {
        App::setLocale($request->header('language'));

        $id = $request->input('id');

        $task = Task::getTaskById($id);

        if (isset($task)) {
            $task->update([
                'finished_at' => now(),
                'status' => 'completed'
            ]);

            return $this->setResponse(__('messages.completed_task', ['name' => $task->name]));
        }

        return $this->setResponse(__('messages.not_found_task', ['id' => $id]), 400);
    }

    public function cancelTask(Request $request)
    {
        App::setLocale($request->header('language'));

        $id = $request->input('id');

        $task = Task::getTaskById($id);

        if (isset($task)) {
            $task->update([
                'status' => 'canceled'
            ]);

            return $this->setResponse(__('messages.canceled_task', ['name' => $task->name]));
        }

        return $this->setResponse(__('messages.not_found_task', ['id' => $id]), 400);
    }

    public function removeByStatus(Request $request, $status)
    {
        App::setLocale($request->header('language'));

        $statusAccepted = ['all', 'canceled', 'completed'];

        if (in_array($status, $statusAccepted)) {
            if ($status == 'all') {
                $tasks = Task::getTasksAllNotPendingTasks();
            } else {
                $tasks = Task::getTasksByStatus($status);
            }

            if (count($tasks->get()) == 0) {
                return $this->setResponse(__('messages.not_found_tasks'));
            }

            $tasks->delete();

            return $this->setResponse(__('messages.removed_tasks'));
        }

        return $this->setResponse(__('messages.not_found_status', ['status' => $status]), 400);
    }

    public function removeByDate(Request $request, $date)
    {
        App::setLocale($request->header('language'));

        if ($this->validateDate($date)) {
            $tasks = Task::getTasksByDate($date);

            if (count($tasks->get()) > 0) {
                $tasks->delete();

                return $this->setResponse(__('messages.removed_tasks'));
            }

            return $this->setResponse(__('messages.not_found_tasks'));
        }

        return $this->setResponse(__('messages.invalid_date'), 400);
    }

    public function removeByPeriod(Request $request, $start, $end)
    {
        App::setLocale($request->header('language'));

        if ($this->validateDate($start) && $this->validateDate($end)) {
            $tasks = Task::getTasksByPeriod($start, $end);

            if (count($tasks->get()) > 0) {
                $tasks->delete();

                return $this->setResponse(__('messages.removed_tasks'));
            }

            return $this->setResponse(__('messages.not_found_tasks'));
        }

        return $this->setResponse(__('messages.invalid_date'), 400);
    }

    public function removeByYear(Request $request, $year)
    {
        App::setLocale($request->header('language'));

        $tasks = Task::getTasksByYear($year);

        if (count($tasks->get()) > 0) {
            $tasks->delete();

            return $this->setResponse(__('messages.removed_tasks'));
        }

        return $this->setResponse(__('messages.not_found_tasks'));
    }
}
