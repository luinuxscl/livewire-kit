<?php

namespace App\Livewire;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridAction;
use Illuminate\View\View;

final class RoleTable extends PowerGridComponent
{
    protected $listeners = [
        'roleUpdated' => '$refresh',
        'roleCreated' => '$refresh',
    ];

    public string $tableName = 'role-table';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                // ->showSearchInput()
                // ->showToggleColumns()
                ,
            PowerGrid::footer()
                // ->showPerPage()
                // ->showRecordCount()
                ,
        ];
    }

    public function datasource(): Builder
    {
        // Agregar el conteo de usuarios con el rol
        return Role::query()->withCount('users');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('guard_name')
            ->add('created_at')
            ->add('updated_at')
            ->add('users_count'); // Nueva columna para el conteo de usuarios
    }

    public function columns(): array
    {
        return [
            Column::make(__('Rol'), 'name'),
            Column::make(__('Users'), 'users_count'),
            Column::action('')
        ];
    }

    public function filters(): array
    {
        return [
            // Filter::inputText('name')->operators(['contains']),
        ];
    }

    public function actionsFromView($row): View
    {
        return view('partials.tables.roles-actions', ['row' => $row]);
    }
}
