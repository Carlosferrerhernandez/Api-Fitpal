<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'usuarios' => [
        'name' => 'Usuarios',
        'index_title' => 'Lista de Usuarios',
        'new_title' => 'Nuevo Usuario',
        'create_title' => 'Crear Usuario',
        'edit_title' => 'Editar Usuario',
        'show_title' => 'Ver Usuario',
        'inputs' => [
            'name' => 'Nombre',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'gimnasios' => [
        'name' => 'Gimnasios',
        'index_title' => 'Lista de Gimnasios',
        'new_title' => 'Nuevo Gimnasio',
        'create_title' => 'Crear Gimnasio',
        'edit_title' => 'Editar Gimnasio',
        'show_title' => 'Ver Gimnasio',
        'inputs' => [
            'name' => 'Nombre',
            'phone' => 'Teléfono',
            'address' => 'Dirección',
        ],
    ],

    'categor_as' => [
        'name' => 'Categorías',
        'index_title' => 'Lista de Categorías',
        'new_title' => 'Nueva Categoría',
        'create_title' => 'Crear Categoría',
        'edit_title' => 'Editar Categoría',
        'show_title' => 'Ver Categoría',
        'inputs' => [
            'name' => 'Nombre',
        ],
    ],

    'entrenadores' => [
        'name' => 'Entrenadores',
        'index_title' => 'Lista de Entrenadores',
        'new_title' => 'Nuevo Entrenador',
        'create_title' => 'Crear Entrenador',
        'edit_title' => 'Editar Entrenador',
        'show_title' => 'Ver Entrenador',
        'inputs' => [
            'first_name' => 'Nombres',
            'last_name' => 'Apellidos',
            'phone' => 'Teléfono',
        ],
    ],

    'lessons' => [
        'name' => 'Lessons',
        'index_title' => 'Lessons List',
        'new_title' => 'New Lesson',
        'create_title' => 'Create Lesson',
        'edit_title' => 'Edit Lesson',
        'show_title' => 'Show Lesson',
        'inputs' => [
            'category_id' => 'Clase',
            'type' => 'Modalidad',
            'trainer_id' => 'Entrenador',
            'gym_id' => 'Gimnasio',
            'limit' => 'Límite de participantes',
        ],
    ],

    'lesson_schedulers' => [
        'name' => 'Lesson Schedulers',
        'index_title' => 'Schedulers List',
        'new_title' => 'New Scheduler',
        'create_title' => 'Create Scheduler',
        'edit_title' => 'Edit Scheduler',
        'show_title' => 'Show Scheduler',
        'inputs' => [
            'start_at' => 'Inicio',
            'end_at' => 'Fin',
        ],
    ],
];
