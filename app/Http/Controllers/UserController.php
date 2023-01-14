<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function index() {
        // $users = User::with('roles')->get();
        // // dd($users);
        // foreach($users as $user) {
        //     dump($user->roles);
        // }
        // dd('a');
        
        return view(
            'users.index',
            [
                'users' => User::with('roles')->get()
            ]
        );
    }
// 11 miunta
    public function async(Request $request) {
        $this->authorize('viewAny', User::class);
        return User::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query) 
                    => $query->where('name', 'like', "%{$request->search}%")
            )->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn(
                    'id',
                    array(
                        fn(array $item) => $item['id'],
                        array_filter(
                            $request->input('selected', []),
                            fn ($item) => (is_array($item) && isset($item['id']))
                        )
                    )
                ),
                fn (Builder $query) => $query->limit(10)
            )->get();
    }
}
