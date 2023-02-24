<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'starts_at',
        'deliver_at',
        'finished_at',
        'starts',
        'status'
    ];

    public static function getAllTasks()
    {
        $task = Self::all();

        return $task;
    }

    public static function getTaskById($id)
    {
        $task = Self::find($id);

        return $task;
    }

    public static function getTasksByDate($date)
    {
        $task = Task::where('starts', $date);

        return $task;
    }

    public static function getTasksByPeriod($start, $end)
    {
        $task = Task::whereRaw("starts BETWEEN '$start' AND '$end'");

        return $task;
    }

    public static function getTasksByYear($year)
    {
        $task = Task::whereYear('starts', '=', $year);

        return $task;
    }

    public static function getTasksByStatus($status)
    {
        $task = Task::where('status', $status);

        return $task;
    }

    public static function getTasksAllNotPendingTasks()
    {
        $task = Task::where('status', '!=', 'pending');

        return $task;
    }
}
