<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Specifications\IUserRepository;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserRepository implements IUserRepository
{
    public function register(array $data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $data['id'] = Str::uuid()->toString();
                        $user = User::create($data);
                        return $user;
            
        } catch (Exception $e) {            
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while creating a new user.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function findByEmail($email)
    {
        try {
            
         return   $user = User::where("email", "=", $email)->first();

            
        } catch (Exception $e) {
            Log::error('An error occurred searching for user by email: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while searching for user',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}