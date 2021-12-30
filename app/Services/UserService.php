<?php

namespace App\Services;

use App\Helpers\View;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Jobs\SendMailResetPassword;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;


class UserService
{
    public static function findById(?int $userId)
    {
        return $userId ? UserRepository::findById($userId) : null;
    }

    public static function getDetailUserById(string $id)
    {
        if (!$user = UserRepository::findById($id)) {
            return ['error' => __('message.server_error')];
        }
        $roleOptions = View::getListRoleOptions();
        $user->role = $roleOptions[$user->role_id];
        $user->created_time = $user->created_at ? Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d H:i:s') : '';
        $user->updated_time = $user->updated_at ? Carbon::createFromFormat('Y-m-d H:i:s', $user->updated_at)->format('Y-m-d H:i:s') : '';
        return ['user' => $user];
    }

    public static function getList()
    {
        return UserRepository::getList();
    }

    public static function store(UserRequest $request)
    {
        $dataInsert = $request->only(['username', 'name', 'phone_number', 'email', 'is_active', 'role_id']);
        return UserRepository::store($dataInsert);
    }

    public static function update(User $user,UserRequest $request)
    {
        if (auth()->user()->id == $request->id) {
            $dataUpdate = $request->only(['name', 'phone_number', 'role_id']);
        } else {
            $dataUpdate = $request->only(['name', 'phone_number', 'is_active', 'role_id']);
        }
        if (!UserRepository::update($user, $dataUpdate))
        {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => __('message.update_user_successfully'),
            'view' => \View::make('admin.users.table', [
                'users' => UserService::getList(),
                'activeOptions' => View::getListActiveOptions(),
                'roleOptions' => View::getListRoleOptions()
            ])->render()
        ];

    }
    public static function updatePassword(User $user, ChangePasswordRequest $request): array
    {
        /* Validate change password form */
        $dataUpdate = ["password" => Hash::make($request->get('new_password'))];
        if (!UserRepository::update($user, $dataUpdate)) {
            return ['error' => __('message.server_error')];
        }

        return ['success' => __('message.change_password_successfully')];
    }

    public static function sendMailResetPassword(string $email, string $token): bool
    {
        if (!(UserRepository::createTokenPasswordReset($email, $token))) {
            return false;
        }
        SendMailResetPassword::dispatch($token, $email);
        return true;
    }

    public static function resetPassword(Request $request)
    {
        if (!$passwordReset = UserRepository::findPasswordReset($request->token)) {
            return [
                'error' => __('message.token_invalid')
            ];
        }
        if (!$user = UserRepository::findByEmail($passwordReset->email)) {
            return ['error' => __('message.server_error')];
        }
        $dataUpdate = ["password" => Hash::make($request->get('password'))];
        if (!UserRepository::update($user, $dataUpdate))
        {
            return ['error' => __('message.server_error')];
        }
        if (!UserRepository::deletePasswordReset($user->email))
        {
            return ['error' => __('message.server_error')];
        }
        return ['success' => __('message.change_password_successfully')];
    }
}
