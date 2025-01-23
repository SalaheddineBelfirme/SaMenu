<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserCreateRequest;
use App\Services\Implementations\AuthService;
use App\Services\Specifications\IAuthService;


class AuthController extends Controller
{

       /**
     * @var AuthService The service responsible for contact-related operations.
     */
    private IAuthService $authService;

    /**
     * Dependency injection constructor, inject controller dependencies
     *
     * @param ContactService $contactService The service to be injected for contact-related operations.
     */
    public function __construct(IAuthService $AuthService)
    {
        $this->authService = $AuthService;
    }

    public function register(UserCreateRequest $request)
    {
      return $this->authService->register($request); 
    }
    public function login(request $request)
    {
        return $this->authService->login($request->all());
      
    }
    public function logout(Request $request )
    {
        return $this->authService->logout($request);
    }

}