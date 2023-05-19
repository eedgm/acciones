<?php

return [
    'common' => [
        'actions' => 'Acciones',
        'create' => 'Crear',
        'edit' => 'Editar',
        'update' => 'Actualizar',
        'new' => 'Nuevo',
        'cancel' => 'Cancelar',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Guardar',
        'delete' => 'Borrar',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'actions' => [
        'name' => 'Actions',
        'index_title' => 'Actions List',
        'new_title' => 'New Action',
        'create_title' => 'Create Action',
        'edit_title' => 'Edit Action',
        'show_title' => 'Show Action',
        'inputs' => [
            'numero' => 'Número',
            'fecha' => 'Fecha límite',
            'accion' => 'Acción',
            'descripcion' => 'Descripción',
            'statu_id' => 'Estatus',
            'prioridad_id' => 'Prioridad',
            'users' => 'Encargados',
            'agrupaciones' => 'Agrupaciones',
        ],
    ],

    'action_users' => [
        'name' => 'Action Users',
        'index_title' => ' List',
        'new_title' => 'New Action user',
        'create_title' => 'Create action_user',
        'edit_title' => 'Edit action_user',
        'show_title' => 'Show action_user',
        'inputs' => [
            'user_id' => 'User',
        ],
    ],

    'action_agrupacions' => [
        'name' => 'Action Agrupacions',
        'index_title' => ' List',
        'new_title' => 'New Action agrupacion',
        'create_title' => 'Create action_agrupacion',
        'edit_title' => 'Edit action_agrupacion',
        'show_title' => 'Show action_agrupacion',
        'inputs' => [
            'agrupacion_id' => 'Agrupación',
        ],
    ],

    'agrupacions' => [
        'name' => 'Agrupacions',
        'index_title' => 'Agrupacions List',
        'new_title' => 'New Agrupacion',
        'create_title' => 'Create Agrupacion',
        'edit_title' => 'Edit Agrupación',
        'show_title' => 'Show Agrupación',
        'inputs' => [
            'nombre' => 'Nombre',
        ],
    ],

    'prioridads' => [
        'name' => 'Prioridads',
        'index_title' => 'Prioridads List',
        'new_title' => 'New Prioridad',
        'create_title' => 'Create Prioridad',
        'edit_title' => 'Edit Prioridad',
        'show_title' => 'Show Prioridad',
        'inputs' => [
            'nombre' => 'Nombre',
            'color' => 'Color',
        ],
    ],

    'status' => [
        'name' => 'Status',
        'index_title' => 'Status List',
        'new_title' => 'New Statu',
        'create_title' => 'Create Statu',
        'edit_title' => 'Edit Statu',
        'show_title' => 'Show Statu',
        'inputs' => [
            'nombre' => 'Nombre',
            'color' => 'Color',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Nombre',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
