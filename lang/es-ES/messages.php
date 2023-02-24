<?php

// spanish messages

return [
    'created_task' => '¡La tarea :name se creó con éxito!',
    'removed_task' => '¡La tarea :name se ha eliminado con éxito!',
    'updated_task' => '¡La tarea :name se ha publicado con éxito!',
    'not_found_task' => 'La tarea con id :id no se puede encontrar.',
    'removed_tasks' => 'As tarefas foram excluídas!',
    'not_found_tasks' => 'No hay tareas para ser excluidas.',
    'completed_task' => '¡La tarea de nombre se ha completado con éxito!',
    'canceled_task' => 'La tarea :name se ha cancelado correctamente!',
    'not_found_status' => 'El estado :status no existe.',
    'invalid_date' => 'Las fechas ingresadas no son válidas.',
    'validation' => [
        'name' => [
            'required' => 'Se requiere el campo de nombre.',
            'min' => 'El nombre debe ser al menos :min caracteres.',
            'max' => 'El nombre no debe ser mayor que :max caracteres.'
        ],
        'description' => [
            'required' => 'Se requiere el campo de descripción.',
            'min' => 'La descripción debe ser al menos :min caracteres',
            'max' => 'La descripción no debe ser mayor que :max caracteres.'
        ],
        'starts_at' => [
            'date' => 'La fecha insertada no es válida.'
        ],
        'deliver_at' => [
            'date' => 'La fecha insertada no es válida.',
            'after_or_equal' => 'La fecha de vencimiento debe ser igual o posterior a la fecha de inicio.'
        ]
    ]
];
