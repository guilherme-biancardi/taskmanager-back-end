<?php

// portuguese messages

return [
    'created_task' => 'A tarefa :name foi criada com sucesso!',
    'removed_task' => 'A tarefa :name foi excluída com sucesso!',
    'updated_task' => 'A tarefa :name foi editada com sucesso!',
    'not_found_task' => 'A tarefa com o id :id não pode ser encontrada.',
    'removed_tasks' => 'As tarefas foram excluídas!',
    'not_found_tasks' => 'Não há tarefas para serem excluídas.',
    'completed_task' => 'A tarefa :name foi concluída com sucesso!',
    'canceled_task' => 'A tarefa :name foi cancelada com sucesso!',
    'not_found_status' => 'O status :status não existe.',
    'invalid_date' => 'As datas informadas são inválidas.',
    'validation' => [
        'name' => [
            'required' => 'O campo nome é obrigatório.',
            'min' => 'O nome deve ter pelo menos :min caracteres.',
            'max' => 'O nome não deve ser maior que :max caracteres.'
        ],
        'description' => [
            'required' => 'O campo descrição é obrigatório',
            'min' => 'A descrição deve ter pelo menos :min caracteres',
            'max' => 'A descrição não deve ser maior que :max caracteres.'
        ],
        'starts_at' => [
            'date' => 'A data inserida não é válida.'
        ],
        'deliver_at' => [
            'date' => 'A data inserida não é válida.',
            'after_or_equal' => 'A data de entrega deve ser igual ou posterior a data de início.'
        ]
    ]
];
