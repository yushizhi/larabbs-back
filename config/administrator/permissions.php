<?php
use Spatie\Permission\Models\Permission;

return [
    'title' => '权限',
    'single' => '权限',
    'model' => Permission::class,

    'permission' => function () {
        return Auth::user()->can('manage_users');
    },

    'action_permissions' => [
        'create' => function($model){
            return true;
        },
        'update' => function($model){
            return true;
        },
        'delete' => function($model){
            return false;
        },
        'view' => function($model){
            return true;
        },
    ],

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '标识',
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => '标识（请慎重修改）',
            'hint' => '修改权限标识会影响代码的调用，请不要轻易修改。',
        ],
        'roles' => [
            'type' => 'relationship',
            'title' => '角色',
            'name_field' => 'name',
        ],
    ],

    'filters' => [
        'name' => [
            'title' => '标识',
        ],
    ],
];