<?php

namespace App\Http\Livewire\Fuels\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RestoreFuelAction extends Action {
    public $title = '';
    public $icon = 'corner-down-left';

    public function __construct() {
        parent::__construct();
        $this->title = 'Restore';
    }

    public function handle($model, View $view) {
        $view->dialog()->confirm([
            'title' => 'Restore element?',
            'description' => 'Would you like restore ' . $model->name . ' element?',
            'icon' => 'question',
            'iconColor' => 'text-green-500',
            'accept' => [
                'label' => 'Yes',
                'method' => 'restore',
                'params' => $model->id,
            ],
            'reject' => [
                'label' => 'No',
            ]
        ]);
    }

    public function renderIf($model, View $view) {
        return request()->user()->can('restore', $model);
    }
}
