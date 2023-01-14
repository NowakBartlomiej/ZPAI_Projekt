<?php

namespace App\Http\Livewire\Adverts\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class InputMakeFilter extends Filter {
    public $type = 'input';
    public $view = 'input-filter';
    public $title = '';

    public function __construct() {
        parent::__construct();
        $this->title = 'Make name';
    }

    public function apply(Builder $query, $value, $request): Builder {
        return $query->whereHas('make', function ($query) use ($value) {
            $query->where('name', 'like', '%' . $value . '%');
        });
    }
}
