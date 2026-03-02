<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\User\Actions\UserDeleteAction;
use Modules\User\Actions\UserListAction;
use Modules\User\Actions\UserListAllAction;
use Modules\User\Actions\UserStoreAction;
use Modules\User\Actions\UserUpdateAction;
use Modules\User\Http\Requests\UserRequest;
use Modules\User\Http\Resources\UserResource;
use Modules\User\Models\User;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly UserListAction $listAction,
        private readonly UserListAllAction $listAllAction,
        private readonly UserStoreAction $storeAction,
        private readonly UserUpdateAction $updateAction,
        private readonly UserDeleteAction $deleteAction
    ) {}

    #[OA\Get(
        path: '/users',
        summary: 'Listar usuarios (paginado)',
        tags: ['Usuarios'],
        security: [['sanctum' => []]],
        parameters: [
            new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15)),
            new OA\Parameter(name: 'query', in: 'query', required: false, schema: new OA\Schema(type: 'string'), description: 'Buscar por nombre o email'),
            new OA\Parameter(name: 'role', in: 'query', required: false, schema: new OA\Schema(type: 'string'), description: 'Filtrar por rol'),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Lista de usuarios'),
            new OA\Response(response: 403, description: 'No autorizado'),
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        $users = $this->listAction->execute(
            $request->all(),
            $request->get('per_page', 15)
        );

        return $this->success(UserResource::collection($users), 'Users retrieved successfully');
    }

    #[OA\Get(
        path: '/users/all',
        summary: 'Listar todos los usuarios (sin paginación)',
        tags: ['Usuarios'],
        security: [['sanctum' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Lista completa de usuarios'),
            new OA\Response(response: 403, description: 'No autorizado'),
        ]
    )]
    public function listAll(): JsonResponse
    {
        $users = $this->listAllAction->execute();
        return $this->success(UserResource::collection($users), 'All users retrieved successfully');
    }

    #[OA\Get(
        path: '/users/roles',
        summary: 'Listar roles disponibles',
        tags: ['Usuarios'],
        security: [['sanctum' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Lista de roles'),
            new OA\Response(response: 403, description: 'No autorizado'),
        ]
    )]
    public function roles(): JsonResponse
    {
        $roles = \Modules\User\Models\Role::all();
        return $this->success(\Modules\User\Http\Resources\RoleResource::collection($roles), 'Roles retrieved successfully');
    }

    #[OA\Post(
        path: '/users',
        summary: 'Crear usuario',
        tags: ['Usuarios'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'email', 'password', 'password_confirmation', 'roles'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Juan Pérez'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'juan@polar.com'),
                    new OA\Property(property: 'password', type: 'string', example: 'password'),
                    new OA\Property(property: 'password_confirmation', type: 'string', example: 'password'),
                    new OA\Property(property: 'roles', type: 'array', items: new OA\Items(type: 'integer'), example: [1]),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Usuario creado'),
            new OA\Response(response: 422, description: 'Error de validación'),
            new OA\Response(response: 403, description: 'No autorizado'),
        ]
    )]
    public function store(UserRequest $request): JsonResponse
    {
        $data = \Modules\User\DataTransferObjects\UserData::fromRequest($request);
        $user = $this->storeAction->execute($data);
        return $this->success(new UserResource($user), 'User created successfully', 201);
    }

    #[OA\Get(
        path: '/users/{id}',
        summary: 'Obtener detalle de usuario',
        tags: ['Usuarios'],
        security: [['sanctum' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Detalle del usuario'),
            new OA\Response(response: 404, description: 'Usuario no encontrado'),
            new OA\Response(response: 403, description: 'No autorizado'),
        ]
    )]
    public function show(User $user): JsonResponse
    {
        return $this->success(new UserResource($user->load('roles')), 'User details retrieved');
    }

    #[OA\Put(
        path: '/users/{id}',
        summary: 'Actualizar usuario',
        tags: ['Usuarios'],
        security: [['sanctum' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'email'],
                properties: [
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'email', type: 'string', format: 'email'),
                    new OA\Property(property: 'password', type: 'string'),
                    new OA\Property(property: 'password_confirmation', type: 'string'),
                    new OA\Property(property: 'roles', type: 'array', items: new OA\Items(type: 'integer')),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Usuario actualizado'),
            new OA\Response(response: 422, description: 'Error de validación'),
            new OA\Response(response: 403, description: 'No autorizado'),
        ]
    )]
    public function update(UserRequest $request, User $user): JsonResponse
    {
        $data = \Modules\User\DataTransferObjects\UserData::fromRequest($request);
        $user = $this->updateAction->execute($user, $data);
        return $this->success(new UserResource($user), 'User updated successfully');
    }

    #[OA\Patch(
        path: '/users/{id}/toggle-status',
        summary: 'Activar/Desactivar usuario',
        tags: ['Usuarios'],
        security: [['sanctum' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Estado del usuario actualizado'),
            new OA\Response(response: 404, description: 'Usuario no encontrado'),
            new OA\Response(response: 403, description: 'No autorizado'),
        ]
    )]
    public function toggleStatus(User $user): JsonResponse
    {
        $user->update(['active' => !$user->active]);
        return $this->success(new UserResource($user), 'User status updated');
    }

    #[OA\Delete(
        path: '/users/{id}',
        summary: 'Eliminar usuario',
        tags: ['Usuarios'],
        security: [['sanctum' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Usuario eliminado'),
            new OA\Response(response: 404, description: 'Usuario no encontrado'),
            new OA\Response(response: 403, description: 'No autorizado'),
        ]
    )]
    public function destroy(User $user): JsonResponse
    {
        $this->deleteAction->execute($user);
        return $this->success(null, 'User deleted successfully');
    }
}
