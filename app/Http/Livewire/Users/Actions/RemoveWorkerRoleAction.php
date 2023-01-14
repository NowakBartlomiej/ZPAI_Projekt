<?php

namespace App\Http\Livewire\Users\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RemoveWorkerRoleAction extends Action{
    public $title = '';
    public $icon = 'x-square';

    public function __construct() {
        parent::__construct();
        $this->title = 'remove worker';
    }

    public function handle($model, View $view) {
        $model->removeRole(config('auth.roles.worker'));
        // $this->success('Remove worker role');
        $view->notification()->success(
            $title = 'Removed Worker role',
            $description = 'user ' . $model->name . ' has not worker role'
        );
    }

    public function renderIf($model, View $view)
    {
        return Auth::user()->isAdmin()
            && $model->hasRole(config('auth.roles.worker'));
    }

}
