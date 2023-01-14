<?php

namespace App\Http\Livewire\Counties;

use App\Http\Livewire\Counties\Actions\EditCountyAction;
use App\Http\Livewire\Counties\Actions\RestoreCountyAction;
use App\Http\Livewire\Counties\Actions\SoftDeleteCountyAction;
use App\Models\County;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use App\Http\Livewire\Filters\SoftDeleteFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;


class CountiesTableView extends TableView
{
    use Actions;
    
    /**
     * Sets a model class to get the initial data
     */
    protected $model = User::class;

    public $searchBy = [
        'name',
        'code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function repository(): Builder {
        return County::query()->withTrashed();
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
            Header::title('Code')->sortBy('code'),
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
            $model->code,
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
            new EditCountyAction('counties.edit', 'Edit'),
            new RestoreCountyAction,
            new SoftDeleteCountyAction,
        ];
    }

    public function softDelete(int $id) {
        $county = County::find($id);
        $county->delete();
        $this->notification()->success(
            $title = 'Successfully delted',
            $description = 'Deleted ' . $county->name . ' element'
        );
    }

    public function restore(int $id) {
        $county = County::withTrashed()->find($id);
        $county->restore();
        $this->notification()->success(
            $title = 'Successfully restored',
            $description = 'Restored' . $county->name . ' element'
        );
    }
}
