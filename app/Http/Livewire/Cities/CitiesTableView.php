<?php

namespace App\Http\Livewire\Cities;

use App\Http\Livewire\Filters\SoftDeleteFilter;
use App\Models\City;
use App\Models\County;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use WireUi\Traits\Actions;

class CitiesTableView extends TableView
{
    use Actions;
    
    /**
     * Sets a model class to get the initial data
     */
    protected $model = City::class;
    protected $paginate = 25;

    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
        // TODO Klucz obcy
    ];

    public function repository(): Builder {
        $query = City::query()
            ->with('county');
        if (request()->user()->can('manage', City::class)) {
            $query->withTrashed();
        }
        return $query;
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            // TODO jak sortowac county
            Header::title('County'),
            Header::title('City')->sortBy('name'),
            Header::title('Created At')->sortBy('created_at'),
            Header::title('Updated At')->sortBy('updated_at'),
            Header::title('Deleted At')->sortBy('deleted_at')
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->county->name,
            $model->name,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    public function filters() {
        return [
            new SoftDeleteFilter,
        ];
    }
}
