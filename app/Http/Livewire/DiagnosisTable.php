<?php

namespace App\Http\Livewire;

use App\Models\Diagnosis;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class DiagnosisTable extends PowerGridComponent
{
    use ActionButton;

    public int $patient;
    public ?array $diagnosis = null;
    public ?array $prescription = null;
    public ?array $doctor = null;
    public ?array $date = null;

    protected array $rules = [
        'diagnosis.*' => ['required'],
        'prescription.*' => ['required'],
        'doctor.*' => ['required'],
        'date.*' => ['required'],
    ];

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
     * @return Builder<\App\Models\Diagnosis>
     */
    public function datasource(): Builder
    {
        return Diagnosis::query()->where('patient', $this->patient);
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
    | ??? IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('diagnosis')
            ->addColumn('prescription')
            ->addColumn('date')
            ->addColumn('doctor');
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
            Column::make('ID', 'id')->sortable(),
            Column::add()
                ->title('DIAGNOSIS')
                ->field('diagnosis')
                ->sortable()
                ->searchable()
                ->editOnClick(true, 'diagnosis', null, true),
            Column::add()
                ->title('PRESCRIPTION')
                ->field('prescription')
                ->sortable()
                ->searchable()
                ->editOnClick(true, 'prescription', null, true),
            Column::add()
                ->title('ISSUED DATE')
                ->field('date')
                ->makeInputDatePicker()
                ->editOnClick(true, 'date', null, true)
                ->searchable()
                ->sortable(),
            Column::add()
                ->title('DOCTOR/CONSULTANT')
                ->field('doctor')
                ->makeInputSelect(
                    Diagnosis::distinct()->get('doctor'),
                    'doctor'
                )
                ->sortable()
                ->searchable()
                ->editOnClick(true, 'doctor', null, true)
        ];
    }

    public function onUpdatedEditable($id, $field, $value): void
    {
        $this->validate();
        Diagnosis::query()->find($id)->update([$field => $value]);
    }

    public function header(): array
    {
        return [
            Button::add('add-record')
                ->caption('Add Record')
                ->class('btn btn-my-primary text-white border-0 text-decoration-none table-link')
                ->emit(
                    'showModal',
                    [
                        'editing' => false,
                        'title' => 'Add Medical Record',
                        'patient' => $this->patient
                    ]
                ),
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
     * PowerGrid Diagnosis Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('primary border-0 bg-transparent mb-1 text-sm m-auto w-auto')
                ->emit(
                    'showModal',
                    [
                        'editing' => true,
                        'title' => 'Editing Medical Record',
                        'id' => 'id',
                        'date' => 'date',
                        'diagnosis' => 'diagnosis',
                        'doctor' => 'doctor',
                        'prescription' => 'prescription'
                    ]
                ),
            Button::make('destroy', 'Delete')
                ->class('danger border-0 bg-transparent text-sm m-auto w-auto')
                ->emit(
                    'showWarningModal',
                    [
                        'id' => 'id',
                    ]
                ),
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
     * PowerGrid Diagnosis Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($diagnosis) => $diagnosis->id === 1)
                ->hide(),
        ];
    }
    */
}
