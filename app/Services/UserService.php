<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use ModelHelper;

    public function getAll()
    {
        return User::with(['specialization', 'doctorSchedules'])->get();
    }

    public function specializationsDoctors($id)
    {
        return User::where('specialization_id', $id)
            ->where('role', 'doctor')
            ->with(['specialization', 'doctorSchedules'])->get();
    }

    public function find($userId)
    {
        return $this->findByIdOrFail(User::class, 'User', $userId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'user';

        $user = User::create($validatedData);

        $user->assignRole($validatedData['role']);

        if (isset($validatedData['image'])) {
            $user->addMedia($validatedData['image'])->toMediaCollection('image');
        }

        DB::commit();

        return $user;
    }

    public function update($validatedData, $userId)
    {
        $user = $this->find($userId);

        DB::beginTransaction();

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user->update($validatedData);

        $user->assignRole($validatedData['role']);

        if (isset($validatedData['image'])) {
            $user->addMedia($validatedData['image'])->toMediaCollection('image');
        }

        DB::commit();

        return true;
    }

    public function delete($userId)
    {
        $user = $this->find($userId);

        DB::beginTransaction();

        $user->delete();

        DB::commit();

        return true;
    }

    public function register($validatedData)
    {
        DB::beginTransaction();

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'user';

        $user = User::create($validatedData);

        $user->assignRole($validatedData['role']);

        if (isset($validatedData['image'])) {
            $user->addMedia($validatedData['image'])->toMediaCollection('image');
        }

        DB::commit();

        $accessToken = $user->createToken('auth');
        return [
            'user' => $user,
            'token' => $accessToken->plainTextToken
        ];
    }

    public function login($validatedData)
    {
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            throw new Exception(__('messages.credentialsError'), 401);
        }

        $attemptedData = [
            'email'    => $user->email,
            'password' => $validatedData['password']
        ];

        if (!Auth::attempt($attemptedData)) {
            throw new Exception(__('messages.incorrect_password'), 401);
        }

        $token = Auth::attempt($attemptedData);

        $accessToken = $user->createToken('auth');

        return [
            'user' => $user,
            'token' => $accessToken->plainTextToken
        ];
    }

    public function logout()
    {
        Auth::guard('web')->logout();
    }
}
