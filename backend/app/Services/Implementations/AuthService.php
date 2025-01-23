<?php

namespace App\Services\Implementations;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Repositories\Specifications\IUserRepository;
use App\Services\Specifications\IAuthService;
use Exception;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService implements IAuthService
{
    private IUserRepository $iUserRepository;

    public function __construct(protected IUserRepository $userRepository)
    {
        $this->iUserRepository = $userRepository;
    }

    public function register(UserCreateRequest $data)
    {
        try {
            $cloudinaryImage = $data->file('image')->storeOnCloudinary('samenu');
            $url = $cloudinaryImage->getSecurePath();
            $public_id = $cloudinaryImage->getPublicId();
            $data['image_url']=$url;
            $data['image_public_id']=$public_id;
            $user = $this->iUserRepository->register($data->all());
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Registration failed',
                    'erure'=>$user
                ], 400);
            }
            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'data' => $user
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(array $data)
    {
        try {
            
            $user = $this->iUserRepository->findByEmail($data['email']);

            if (!$user || !Hash::check($data['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            $user->tokens()->delete();
            
            $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 200);

        } catch (Exception $e) {
            Log::error('An error occurred while logging in: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
       auth()->user()->tokens()->delete();
    }

}