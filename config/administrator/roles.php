<?php

use Spatie\Permission\Models\Role;

return [
    'title' => '角色',
    'single' => '角色',
    'model' => Role::class,

    'permission' => function()
    {
        return Auth::user()->can('manage_users');
    },

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '权限',
        ],
        'permissions' => [
            'title' => '权限',
            'output' => function($value, $model)
            {
                $model->load('permissions');
                $result = [];
                foreach ($model->permissions as $permission){
                    $result[] = $permission->name;
                }
                return empty($result) ? 'N/A' : implode($result, ' | ');
            },
            'sortable' => false,
        ],
        'operation' => [
            'title' => '管理',
            'output' => function($value, $model)
            {
                return $value;
            },
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => '标识',
        ],
        'permissions' => [
            'type' => 'relationship',
            'title' => '权限',
            'name_field' => 'name',
        ],
    ],

    'filters' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '标识',
        ],
    ],

    'rules' => [
        'name' => 'required|max:15|unique:roles,name',
    ],

    'message' => [
        'name.required' => '标识不能为空',
        'name.unique' => '标识已存在',
    ],
];