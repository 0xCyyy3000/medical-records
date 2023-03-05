<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Patient;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};

final class PatientTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Patient>
     */
    public function datasource(): Builder
    {
        return Patient::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('first_name')
            ->addColumn('middle_name')
            ->addColumn('last_name')
            ->addColumn('gender')
            ->addColumn('civil_status')
            ->addColumn('age')
            ->addColumn('city');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('FIRST NAME', 'first_name')
                ->sortable()
                ->searchable(),
            Column::make('MIDDLE NAME', 'middle_name')
                ->sortable()
                ->searchable(),
            Column::make('LAST NAME', 'last_name')
                ->sortable()
                ->searchable(),
            Column::make('GENDER', 'gender')
                ->sortable()
                ->searchable()
                ->makeInputSelect(Patient::distinct()->get('gender'), 'gender', 'gender'),
            Column::make('CIVIL STATUS', 'civil_status')
                ->sortable()
                ->searchable()
                ->makeInputSelect(Patient::distinct()->get('civil_status'), 'civil_status', 'civil_status'),
            Column::make('AGE', 'age')
                ->sortable()
                ->makeInputRange('age'),
            Column::make('City/Municipality', 'city')
                ->makeInputSelect(
                    Patient::distinct()->get('city'),
                    'city',
                )->sortable()
                ->searchable()
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Patient Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('edit', 'View details')
                ->class('primary text-decoration-none table-link')
                ->route('patient.select', ['patient' => 'id'])
                ->target('_self'),
        ];
    }

    public function header(): array
    {
        return [
            Button::make('create', 'Add patient')
                ->class('btn btn-my-primary text-white border-0 text-decoration-none table-link')
                ->route('add.patient', [])
                ->target('_self'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Patient Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($patient) => $patient->id === 1)
                ->hide(),
        ];
    }
    */
}
