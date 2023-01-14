<?php

namespace App\Http\Livewire\Users\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class AssignWorkerRoleAction extends Action{
    public $title = '';
    public $icon = 'droplet';

    public function __construct() {
        parent::__construct();
        $this->title = 'grant worker';
    }

    public function handle($model, View $view) {
        $model->assignRole(config('auth.roles.worker'));
        // $this->success('Grant admin worker');
        $view->notification()->success(
            $title = 'Granted Worker role',
            $description = 'user ' . $model->name . ' has worker role'
        );

    }

    public function renderIf($model, View $view)
    {
        return Auth::user()->isAdmin()
            && !$model->hasRole(config('auth.roles.worker'));
    }

}
