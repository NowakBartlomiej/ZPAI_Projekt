<?php

namespace App\Http\Livewire\Adverts;

use App\Http\Livewire\Adverts\Actions\EditAdvertAction;
use App\Http\Livewire\Adverts\Actions\RestoreAdvertAction;
use App\Http\Livewire\Adverts\Actions\SoftDeleteAdvertAction;
use App\Http\Livewire\Adverts\Filters\InputCarModelFilter;
use App\Http\Livewire\Adverts\Filters\InputMakeFilter;
use App\Models\Advert;
use LaravelViews\Views\GridView;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeleteFilter;
use WireUi\Traits\Actions;

class AdvertsGridView extends GridView
{
    use Actions;
    
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Advert::class;

    protected $paginate = 10;
    public $maxCols = 3;

    public $cardComponent = 'livewire.adverts.grid-view-item';

    public $searchBy = [
        'price',
        // 'car.make.name' <-- Nie dziala wyszukiwanie głębszych relacji
    ];

    public function repository(): Builder {
        $query = Advert::query()
            ->with(['car', 'city']);

        // TODO zoptymalizowac pozniej
        if (request()->user()->can('manage', Advert::class)) {
            $query->withTrashed();
        }
        return $query;
    }

    /**
     * Sets the data to every card on the view
     *
     * @param $model Current model for each card
     */
    public function card($model)
    {
        return [
            'image' => Storage::url('no-car-image.png'),
            'title' => $model->make->name . ' ' . $model->carModel->name,
            'subtitle' => $model->car->year . '・' . $model->car->odometer . ' km' . '・' . $model->car->fuel->name . '・' . $model->car->engine . ' dm3',
            'price' => $model->price . ' PLN'
        ];
    }

    public function getPaginatedQueryProperty() {
        return $this->query->paginate($this->paginate);
    }

    protected function filters() {
        return [
            new InputMakeFilter,
            new InputCarModelFilter,
            new SoftDeleteFilter,
        ];
    }

    protected function actionsByRow() {
        if (request()->user()->can('manage', Advert::class)) {
            return [
                new EditAdvertAction('adverts.edit', 'Edit'),
                new SoftDeleteAdvertAction,
                new RestoreAdvertAction,
            ];
        } else {
            return [];
        }
    }

    public function softDelete(int $id) {
        $advert = Advert::find($id);
        $advert->delete();
        $this->notification()->success(
            $title = 'Successfully delted',
            $description = 'Deleted ' . $advert->id . ' element'
        );
    }

    public function restore(int $id) {
        $advert = Advert::withTrashed()->find($id);
        $advert->restore();
        $this->notification()->success(
            $title = 'Successfully restored',
            $description = 'Restored' . $advert->id . ' element'
        );
    }
}

