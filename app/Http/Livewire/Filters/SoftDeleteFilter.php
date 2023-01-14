<?php

namespace App\Http\Livewire\Filters;

use LaravelViews\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class SoftDeleteFilter extends Filter{
    public $title = '';

    public function __construct() {
        parent::__construct();
        $this->title = "Deleted";
    }

    public function apply(Builder $query, $value, $request): Builder {
        if ($value == 1) {
            return $query->whereNotNull('deleted_at');
        }
        return $query->whereNull('deleted_at');
    }

    public function options(): array
    {
        return [
            'Yes' => 1,
            'No' => 0,
        ];
    }
}

