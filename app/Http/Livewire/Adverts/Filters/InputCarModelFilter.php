<?php

namespace App\Http\Livewire\Adverts\Filters;

use LaravelViews\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class InputCarModelFilter extends Filter {
    public $type = 'input';
    public $view = 'input-filter';
    public $title = '';

    public function __construct() {
        parent::__construct();
        $this->title = 'Model name';
    }

    public function apply(Builder $query, $value, $request): Builder {
        return $query->whereHas('carModel', function ($query) use ($value) {
            $query->where('name', 'like', '%' . $value . '%');
        });
    }
}
