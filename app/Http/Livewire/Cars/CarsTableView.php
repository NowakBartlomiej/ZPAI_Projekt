<?php

namespace App\Http\Livewire\Cars;

use App\Http\Livewire\Cars\Actions\EditCarAction;
use App\Http\Livewire\Cars\Actions\RestoreCarAction;
use App\Http\Livewire\Cars\Actions\SoftDeleteCarAction;
use App\Models\Car;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeleteFilter;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarsTableView extends TableView
{
    use Actions;

    /**
     * Sets a model class to get the initial data
     */
    protected $model = Car::class;

    public $searchBy = [
        'year',
        'odometer',
        'VIN',
        'engine',
        'power',
        'created_at',
        'updated_at',
        'deleted_at',
        'carModel.name',
        // 'make.name', <---- to nie chce dzialac
        'bodyType.name',
        'fuel.name'
        // TODO Klucz obcy
    ];

    public function repository(): Builder {
        $query = Car::query()
            ->with('fuel', 'bodyType', 'carModel');
           
        if (request()->user()->can('manage', Car::class)) {
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
            Header::title('Make'),
            Header::title('Model'), // <------ Jak sortowac 
            Header::title('Body Type'),
            Header::title('Fuel'),
            Header::title('Year')->sortBy('year'),
            Header::title('VIN')->sortBy('VIN'),
            Header::title('Engine')->sortBy('engine'),
            Header::title('Power')->sortBy('power'),
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
            $model->carModel->name,
            $model->bodyType->name,
            $model->fuel->name,
            $model->year,
            $model->VIN,
            $model->engine . ' l',
            $model->power . ' KM',
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    protected function filters() {
        return [
            new SoftDeleteFilter,
        ];
    }

    protected function actionsByRow() {
        if (request()->user()->can('manage', Car::class)) {
            return [
                new EditCarAction('cars.edit', 'Edit'),
                new SoftDeleteCarAction,
                new RestoreCarAction,
            ];
        } else {
            return [];
        }
    }

    public function softDelete(int $id) {
        $car = Car::find($id);
        $car->delete();
        $this->notification()->success(
            $title = 'Successfully delted',
            $description = 'Deleted ' . $car->name . ' element'
        );
    }

    public function restore(int $id) {
        $car = Car::withTrashed()->find($id);
        $car->restore();
        $this->notification()->success(
            $title = 'Successfully restored',
            $description = 'Restored' . $car->name . ' element'
        );
    }
}
