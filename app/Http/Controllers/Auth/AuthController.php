<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\EmployerLoginRequest;
use App\Http\Requests\Auth\EmployerRegisterRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\User;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AuthController extends Controller
{
    public function __construct(private readonly AuthRepository $authRepository)
    {
    }

    /**
     * @throws UnknownProperties
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $dataTransferObject = $request->dataTransferObject();

        $token = $this->authRepository->register($dataTransferObject);

        return response()->json(['token' => $token], 200);
    }


    /**
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }

    /**
     * @throws UnknownProperties
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        return $this->authRepository->changePassword($request->dataTransferObject());
    }
}
