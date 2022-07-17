<?php

return [
    'common' => [
        'actions' => 'Acciones',
        'create' => 'Crear',
        'edit' => 'Editar',
        'update' => 'Actualizar',
        'new' => 'Nuevo',
        'cancel' => 'Cancelar',
        'attach' => 'Adjuntar',
        'detach' => 'Soltar',
        'save' => 'Guardar',
        'delete' => 'Eliminar',
        'delete_selected' => 'Eliminar seleccionado',
        'search' => 'Buscar...',
        'back' => 'Regresar',
        'are_you_sure' => 'Estas seguro?',
        'no_items_found' => 'Sin registros',
        'created' => 'Creado satisfactoriamente',
        'saved' => 'Guardado con éxito',
        'removed' => 'Removido con éxito',
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
            'password' => 'Contraseña',
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
        'name' => 'Clases',
        'index_title' => 'Lista de Clases',
        'new_title' => 'Nueva Clase',
        'create_title' => 'Crear Clase',
        'edit_title' => 'Editar Clase',
        'show_title' => 'Ver Clase',
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
