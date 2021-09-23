<?php

namespace App\Http\Controllers;

use App\Helpers\View;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static function index(Request $request)
    {
        if ($request->ajax()) {
            return [
                'view' => \View::make('admin.users.table', [
                    'users' => UserService::getList(),
                    'activeOptions' => View::getListActiveOptions(),
                    'roleOptions' => View::getListRoleOptions()
                ])->render()
            ];
        }
        return view('admin.users.index', [
            'users' => UserService::getList(),
            'activeOptions' => View::getListActiveOptions(),
            'roleOptions' => View::getListRoleOptions()
        ]);
    }

    public static function show(string $id)
    {
        return UserService::getDetailUserById($id);
    }
    public static function edit(string $id)
    {
        if (!($user = UserService::findById($id))) {
            return ['error' => __('message.user_is_not_exist')];
        }
        return ['user' => $user];
    }

    public static function store(UserRequest $request)
    {
        if (!UserService::store($request)) {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => __('message.create_user_successfully'),
            'view' => \View::make(
                'admin.users.table',
                [
                    'users' => UserRepository::getList(),
                    'activeOptions' => View::getListActiveOptions(),
                    'roleOptions' => View::getListRoleOptions()
                ]
            )->render()
        ];
    }

    public static function update(UserRequest $request)
    {
        $userId = $request->get('id');
        if (!($user = UserService::findById($userId))) {
            return ['error' => __('message.user_is_not_exist')];
        }
        return UserService::update($user, $request);
    }

    public static function getChangePassword()
    {
        return view('auth.change_password');
    }

    public static function changePassword(ChangePasswordRequest $request)
    {
        return UserService::updatePassword(auth()->user(), $request);
    }
}
