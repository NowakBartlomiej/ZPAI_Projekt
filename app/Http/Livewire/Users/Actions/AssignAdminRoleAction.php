<?php

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;


class AssignAdminRoleAction extends Action {
    public $title = '';
    public $icon = 'shield';

    public function __construct() {
        parent::__construct();
        $this->title = 'grant admin';
    }

    public function handle($model, View $view) {
        $model->assignRole(config('auth.roles.admin'));
        // $this->success('Grant admin role');
        $view->notification()->success(
            $title = 'Granted Admin role',
            $description = 'user ' . $model->name . ' has admin role'
        );
    }

    public function renderIf($model, View $view)
    {
        return Auth::user()->isAdmin()
            && !$model->hasRole(config('auth.roles.admin'));
    }
}
