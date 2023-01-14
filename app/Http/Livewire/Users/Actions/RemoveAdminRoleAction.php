<?php

namespace App\Http\Livewire\Users\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RemoveAdminRoleAction extends Action{
    public $title = '';
    public $icon = 'x-square';

    public function __construct() {
        parent::__construct();
        $this->title = 'Remove Admin';
    }

    public function handle($model, View $view) {
        $model->removeRole(config('auth.roles.admin'));
        // $this->success('Remove admin role');
        $view->notification()->success(
            $title = 'Removed Admin role',
            $description = 'user ' . $model->name . ' has not admin role'
        );
    }

    public function renderIf($model, View $view) {
        return Auth::user()->isAdmin()
            && $model->hasRole(config('auth.roles.admin'));
    }
}
