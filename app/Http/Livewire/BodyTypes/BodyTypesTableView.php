<?php

namespace App\Http\Livewire\BodyTypes;

use App\Http\Livewire\BodyTypes\Actions\EditBodyTypeAction;
use App\Models\BodyType;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use App\Http\Livewire\Filters\SoftDeleteFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;

use App\Http\Livewire\BodyTypes\Actions\RestoreBodyTypeAction;
use App\Http\Livewire\BodyTypes\Actions\SoftDeleteBodyTypeAction;

class BodyTypesTableView extends TableView
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
        return BodyType::query()->withTrashed();
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
            new EditBodyTypeAction('bodyTypes.edit', 'Edit'),
            new SoftDeleteBodyTypeAction,
            new RestoreBodyTypeAction
        ];
    }

    public function softDelete(int $id) {
        $bodyType = BodyType::find($id);
        $bodyType->delete();
        $this->notification()->success(
            $title = 'Successfully delted',
            $description = 'Deleted ' . $bodyType->name . ' element'
        );
    }

    public function restore(int $id) {
        $bodyType = BodyType::withTrashed()->find($id);
        $bodyType->restore();
        $this->notification()->success(
            $title = 'Successfully restored',
            $description = 'Restored' . $bodyType->name . ' element'
        );
    }
}
