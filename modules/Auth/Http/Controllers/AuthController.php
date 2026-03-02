<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Actions\AuthLoginAction;
use Modules\Auth\Http\Requests\AuthLoginRequest;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly AuthLoginAction $authLoginAction
    ) {}

    #[OA\Post(
        path: '/auth/login',
        summary: 'Iniciar sesión',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'admin@polar.com'),
                    new OA\Property(property: 'password', type: 'string', example: 'password'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Login exitoso', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'status', type: 'string', example: 'success'),
                    new OA\Property(property: 'message', type: 'string', example: 'Login successful'),
                    new OA\Property(property: 'data', type: 'object', properties: [
                        new OA\Property(property: 'token', type: 'string'),
                        new OA\Property(property: 'token_type', type: 'string', example: 'Bearer'),
                        new OA\Property(property: 'user', type: 'object', properties: [
                            new OA\Property(property: 'id', type: 'integer'),
                            new OA\Property(property: 'name', type: 'string'),
                            new OA\Property(property: 'email', type: 'string'),
                        ]),
                    ]),
                ]
            )),
            new OA\Response(response: 422, description: 'Credenciales inválidas'),
        ]
    )]
    public function login(AuthLoginRequest $request): JsonResponse
    {
        $data = $this->authLoginAction->execute($request->validated());
        return $this->success(new \Modules\Auth\Http\Resources\AuthResource($data), 'Login successful');
    }

    #[OA\Post(
        path: '/auth/logout',
        summary: 'Cerrar sesión',
        tags: ['Auth'],
        security: [['sanctum' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Logout exitoso', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'status', type: 'string', example: 'success'),
                    new OA\Property(property: 'message', type: 'string', example: 'Logout successful'),
                ]
            )),
            new OA\Response(response: 401, description: 'No autenticado'),
        ]
    )]
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success(null, 'Logout successful');
    }

    #[OA\Get(
        path: '/auth/me',
        summary: 'Obtener perfil del usuario autenticado',
        tags: ['Auth'],
        security: [['sanctum' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Datos del usuario', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'status', type: 'string', example: 'success'),
                    new OA\Property(property: 'message', type: 'string', example: 'User data retrieved'),
                    new OA\Property(property: 'data', type: 'object', properties: [
                        new OA\Property(property: 'id', type: 'integer'),
                        new OA\Property(property: 'name', type: 'string'),
                        new OA\Property(property: 'email', type: 'string'),
                    ]),
                ]
            )),
            new OA\Response(response: 401, description: 'No autenticado'),
        ]
    )]
    public function me(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->load('roles');
        return $this->success(new \Modules\User\Http\Resources\UserResource($user), 'User data retrieved');
    }
}
