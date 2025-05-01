<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridAction;
use Illuminate\View\View;
use Illuminate\Support\Facades\Blade;

final class UserTable extends PowerGridComponent
{
    protected $listeners = [
        'editUserUpdated' => '$refresh',
        'userDeleted' => '$refresh',
    ];
    public string $tableName = 'user-table-7qes5c-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput()
                ->showToggleColumns(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
                
        ];
    }

    public function datasource(): Builder
    {
        return User::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('role', function(User $user) {
                return Blade::render('<x-role-badge :role=$role />',
                [
                    'role' => $user->getRoleNames()->first(),
                ]);
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make(__('Name'), 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make(__('Rol'), 'role'),

            Column::action('')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert("Editando usuario con ID: " + ' . $rowId . ')');
    }

    public function actionsFromView($row): View
    {
        return view('partials.tables.users-actions', ['row' => $row]);
    }
}
