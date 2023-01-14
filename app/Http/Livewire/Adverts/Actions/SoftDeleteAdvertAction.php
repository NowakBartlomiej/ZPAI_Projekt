<?php

namespace App\Http\Livewire\Adverts\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class SoftDeleteAdvertAction extends Action {
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
