<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use LaravelViews\Views\TableView;
use Illuminate\Contracts\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;

class CategoriesTableView extends TableView
{
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
        return Category::query()->withTrashed();
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
}
