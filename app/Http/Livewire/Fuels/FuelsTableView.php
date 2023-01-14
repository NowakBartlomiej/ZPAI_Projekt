<?php

namespace App\Http\Livewire\Fuels;

use App\Models\Fuel;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use App\Http\Livewire\Filters\SoftDeleteFilter;
use App\Http\Livewire\Fuels\Actions\EditFuelAction;
use App\Http\Livewire\Fuels\Actions\RestoreFuelAction;
use App\Http\Livewire\Fuels\Actions\SoftDeleteFuelAction;
use Illuminate\Contracts\Database\Eloquent\Builder;

class FuelsTableView extends TableView
{
    use Actions;
    /**
     * Sets a model class to get the initial data
     */
    protected $model = User::class;

    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function repository(): Builder {
        return Fuel::query()->withTrashed();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('Name')->sortBy('name'),
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
            $model->name,
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
        return [
            new EditFuelAction('fuels.edit', 'Edit'),
            new SoftDeleteFuelAction,
            new RestoreFuelAction,
        ];
    }

    public function softDelete(int $id) {
        $fuel = Fuel::find($id);
        $fuel->delete();
        $this->notification()->success(
            $title = 'Successfully delted',
            $description = 'Deleted ' . $fuel->name . ' element'
        );
    }

    public function restore(int $id) {
        $fuel = Fuel::withTrashed()->find($id);
        $fuel->restore();
        $this->notification()->success(
            $title = 'Successfully restored',
            $description = 'Restored' . $fuel->name . ' element'
        );
    }
}
