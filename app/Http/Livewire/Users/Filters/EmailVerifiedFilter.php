<?php 

namespace App\Http\Livewire\Users\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class EmailVerifiedFilter extends Filter{
    public $title = '';

    public function __construct() {
        $this->title = 'Email Verified';
        // $this->title = __('users.attributes.email_verified_at');
    }

    public function apply(Builder $query, $value, $request): Builder {
        if ($value == 1) {
            return $query->whereNotNull('email_verified_at');
        }
        return $query->whereNull('email_verified_at');
    }

    public function options() :Array {
        return [
            'yes' => 1,
            'no' => 0,
        ];
    }
}