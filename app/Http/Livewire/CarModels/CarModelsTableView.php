<?php

namespace App\Http\Livewire\CarModels;

use App\Http\Livewire\Filters\SoftDeleteFilter;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class CarModelsTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = CarModel::class;
    protected $paginate = 25;

    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
        // TODO Klucz obcy
    ];

    // ? Repo
    public function repository(): Builder {
        $query = CarModel::query()
            ->with('make');

        if (request()->user()->can('manage', CarModel::class)) {
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
            Header::title('Make'),
            Header::title('Model')->sortBy('name'),
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
            $model->make->name,
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
