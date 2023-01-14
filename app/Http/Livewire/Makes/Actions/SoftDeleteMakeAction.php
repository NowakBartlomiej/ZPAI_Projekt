<?php

namespace App\Http\Livewire\Makes\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class SoftDeleteMakeAction extends Action {
    public $title = '';
    public $icon = 'trash-2';

    public function __construct() {
        parent::__construct();
        $this->title = 'Delete';
    }

    public function handle($model, View $view) {
        $view->dialog()->confirm([
            'title' => 'Delete element?',
            'description' => 'Would you like delete ' . $model->name . ' element?',
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => 'Yes',
                'method' => 'softDelete',
                'params' => $model->id,
            ],
            'reject' => [
                'label' => 'No',
            ]
        ]);
    }

    public function renderIf($model, View $view) {
        return request()->user()->can('delete', $model);
    }
}
