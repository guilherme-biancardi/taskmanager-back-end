<?php

// english messages

return [
    'created_task' => 'Task :name was created successfully!',
    'removed_task' => 'Task :name has been deleted successfully!',
    'updated_task' => 'Task :name was successfully edited!',
    'not_found_task' => 'The task with id :id cannot be found.',
    'removed_tasks' => 'Tasks have been deleted!',
    'not_found_tasks' => 'There are no tasks to be excluded.',
    'completed_task' => 'The task :name has been successfully completed!',
    'canceled_task' => 'The task :name has been successfully canceled!',
    'not_found_status' => 'The status :status does not exist.',
    'invalid_date' => 'The informed dates are invalid.',
    'validation' => [
        'name' => [
            'required' => 'The name field is required.',
            'min' => 'The name must be at least :min characters long',
            'max' => 'The name must not be greater than :max characters.'
        ],
        'description' => [
            'required' => 'The description field is required.',
            'min' => 'The description must be at least :min characters long',
            'max' => 'The description must not be greater than :max characters.'
        ],
        'starts_at' => [
            'date' => 'The date entered is not valid.'
        ],
        'deliver_at' => [
            'date' => 'The date entered is not valid.',
            'after_or_equal' => 'The delivery date shall be equal to or after the start date.'
        ]
    ]
];
