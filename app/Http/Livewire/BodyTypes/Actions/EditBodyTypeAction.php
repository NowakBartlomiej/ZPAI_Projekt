<?php

namespace App\Http\Livewire\BodyTypes\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\RedirectAction;

class EditBodyTypeAction extends RedirectAction{
    public function __construct($to, string $title, string $icon='edit') {
        parent::__construct($to, $title, $icon);
    }

    public function renderIf($model, View $view) {
        return request()->user()->can('update', $model);
    }
}
