<?php

namespace App\Http\Livewire\Makes\Actions;

use LaravelViews\Actions\RedirectAction;
use LaravelViews\Views\View;

class EditMakeAction extends RedirectAction {
    public function __construct($to, string $title, string $icon='edit' ) {
        parent::__construct($to, $title, $icon);
    }

    public function renderIf($model, View $view) {
        return request()->user()->can('update', $model);
    }
}
