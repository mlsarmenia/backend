<?php

namespace App\Http\Controllers\Admin\Traits;

use Illuminate\Support\Facades\Gate;

trait CrudPermissionTrait
{
    public array $operations = ['list', 'show', 'create', 'update', 'delete'];

    public function setAccessUsingPermissions(string $modelName): void
    {
        $this->crud->denyAccess($this->operations);
        $mapping = [
            'view' => ['list', 'show'],
            'create' => ['create'],
            'update' => ['update'],
            'delete' => ['delete'],
        ];

        foreach ($mapping as $level => $operations) {
            if (Gate::allows($level, $modelName)) {
                $this->crud->allowAccess($operations);
            }
        }
    }
}
