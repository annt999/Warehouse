<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use DB;
use Log;

class UserRepository
{
    public static function findById($useId)
    {
        try {
            return User::query()
                ->where('id', $useId)
                ->where('warehouse_id', auth()->user()->warehouse_id)
                ->first();
        } catch (\Exception $ex) {
            return null;
        }
    }
    public static function findByEmail(string $email)
    {
        try {
            return User::query()
                ->where('email', $email)
                ->first();
        } catch (\Exception $ex) {
            Log::error($ex);
            return null;
        }
    }

    public static function getList()
    {
        return User::query()
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->paginate(config('common.records_per_page'));
    }

    public static function store(array $dataInsert)
    {
        $dataInsert['password'] = \Hash::make('password');
        $dataInsert['warehouse_id'] = auth()->user()->warehouse_id;
        DB::beginTransaction();
        try {
            $user = User::create($dataInsert);
            Log::error("user", [$user]);
            DB::commit();
            return $user;
        } catch (\Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return null;
        }
    }

    public static function update(User $user, array $dataUpdate)
    {
        DB::beginTransaction();
        try {
            $user->update($dataUpdate);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            return false;
        }
    }

    public static function createTokenPasswordReset(string $email, string $token): ?bool
    {
        DB::beginTransaction();
        try {
            $passwordResset = DB::table('password_resets')->updateOrInsert([
                 'email' => $email,
                 'token' => $token,
                 'created_at' => Carbon::now()
             ]);

            DB::commit();
            return $passwordResset;
        } catch (\Exception $ex) {
            DB::rollBack();
            return null;
        }
    }

    public static function findPasswordReset(string $token)
    {
        try {
            return DB::table('password_resets')
                ->where([
                            'token' => $token
                        ])
                ->first();
        } catch (\Exception $ex) {
            return null;
        }
    }
    public static function deletePasswordReset(string $email)
    {
        try {
            return DB::table('password_resets')
                ->where([
                            'email' => $email
                        ])
                ->delete();
        } catch (\Exception $ex) {
            return null;
        }
    }

}
