<?php

namespace App\Livewire;

use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class TokenTable extends PowerGridComponent
{
    public string $tableName = 'token-table-zyq9l8-table';

    public function setUp(): array
    {
        return [
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return PersonalAccessToken::query()->where('tokenable_id', auth()->id());
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('name')
            ->add('created_at')
            ->add('created_at_formatted', fn (PersonalAccessToken $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i'))
            ->add('expires_in', function (PersonalAccessToken $model) {
                if ($model->expires_at) {
                    $expires = Carbon::parse($model->expires_at)->startOfDay();
                    $diff = now()->startOfDay()->diffInDays($expires, false);
                    if ($diff > 0) {
                        return $diff . ' días';
                    } elseif ($diff === 0) {
                        return 'Expira hoy';
                    } else {
                        return 'Expirado';
                    }
                }
                return '-';
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Nombre', 'name'),
            Column::make('Creado', 'created_at_formatted'),
            Column::make('Expiración', 'expires_in'),
            Column::action('Acciones'),
        ];
    }

    public function filters(): array
    {
        return [
            // Filter::datetimepicker('expires_at'),
            // Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(PersonalAccessToken $row): array
    {
        return [
            Button::add('revocar')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg> <span class="align-middle">Revocar</span>')
                ->class('bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs flex items-center gap-1')
                ->dispatch('revokeToken', ['id' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
