<?php

namespace App\Http\Controllers;

use App\Http\Resources\DashboardResource;
use App\Models\Task;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    use ResponseTrait;

    public function index()
    {
        $lastDayWeek = date('Y-m-d', strtotime('+7 days'));
        $weekTasks = Task::getTasksByPeriod(date('Y-m-d'), $lastDayWeek);

        $resource = [
            'weekTasks' => $weekTasks->get(),
            'weekTasksLength' => count($weekTasks->get()),
            'tste' => [$lastDayWeek, date('Y-m-d')]
        ];

        return $this->setResponseWithResource($resource, 'teste');
    }
}
