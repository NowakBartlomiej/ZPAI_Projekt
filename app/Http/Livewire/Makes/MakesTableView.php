<?php

namespace App\Http\Livewire\Makes;


use App\Models\Make;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use App\Http\Livewire\Filters\SoftDeleteFilter;
use App\Http\Livewire\Makes\Actions\EditMakeAction;
use App\Http\Livewire\Makes\Actions\RestoreMakeAction;
use App\Http\Livewire\Makes\Actions\SoftDeleteMakeAction;
use Illuminate\Contracts\Database\Eloquent\Builder;
use WireUi\Traits\Actions;

class MakesTableView extends TableView
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
        return Make::query()->withTrashed();
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
            new EditMakeAction('makes.edit', 'Edit'),
            new SoftDeleteMakeAction,
            new RestoreMakeAction,
        ];
    }

    public function softDelete(int $id) {
        $make = Make::find($id);
        $make->delete();
        $this->notification()->success(
            $title = 'Successfully delted',
            $description = 'Deleted ' . $make->name . ' element'
        );
    }

    public function restore(int $id) {
        $make = Make::withTrashed()->find($id);
        $make->restore();
        $this->notification()->success(
            $title = 'Successfully restored',
            $description = 'Restored' . $make->name . ' element'
        );
    }
}
