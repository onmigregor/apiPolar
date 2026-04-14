<?php

namespace Modules\Company\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Company\Actions\MasterCompanyAction;
use Modules\Company\Models\Branch;
use Modules\Company\Models\CrewLogin;
use Modules\Company\Models\Login;
use Modules\Company\Models\LoginBranch;
use Modules\Company\Models\Region;
use Modules\Company\Models\Territory;

class MasterCompanyController extends Controller
{
    /**
     * Carga masiva de datos organizacionales de empresa (formato Polar).
     *
     * @OA\Post(
     *     path="/mastercompany",
     *     summary="Carga masiva de datos organizacionales de empresa (formato Polar)",
     *     tags={"Cargas Masivas - MasterCompany"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="name", type="string", example="COMPANIES"),
     *                 @OA\Property(property="value", type="object",
     *                     @OA\Property(property="region", type="array", @OA\Items(type="object",
     *                         @OA\Property(property="regCode", type="string", example="001"),
     *                         @OA\Property(property="regName", type="string", example="LATAM")
     *                     )),
     *                     @OA\Property(property="branch", type="array", @OA\Items(type="object",
     *                         @OA\Property(property="brcCode", type="string", example="5300"),
     *                         @OA\Property(property="brcName", type="string", example="ALIMENTOS POLAR CHILE SPA"),
     *                         @OA\Property(property="brcGeneralHeader1", type="string", example="ALIMENTOS POLAR CHILE SPA"),
     *                         @OA\Property(property="regCode", type="string", example="001")
     *                     )),
     *                     @OA\Property(property="login", type="array", @OA\Items(type="object",
     *                         @OA\Property(property="lgnCode", type="string", example="PC7818"),
     *                         @OA\Property(property="lgnName", type="string", example="CLAUDIO SALVATIERRA"),
     *                         @OA\Property(property="brcCode", type="string", example="5300")
     *                     )),
     *                     @OA\Property(property="territory", type="array", @OA\Items(type="object",
     *                         @OA\Property(property="tryCode", type="string", example="CS01-CH01CS1"),
     *                         @OA\Property(property="brcCode", type="string", example="5300"),
     *                         @OA\Property(property="lgnCode", type="string", example="PC1444"),
     *                         @OA\Property(property="tryName", type="string", example="Moderno 1-Oficina Santiago")
     *                     )),
     *                     @OA\Property(property="loginBranch", type="array", @OA\Items(type="object",
     *                         @OA\Property(property="lgnCode", type="string", example="PC0047"),
     *                         @OA\Property(property="brcCode", type="string", example="5300")
     *                     )),
     *                     @OA\Property(property="crewLogin", type="array", @OA\Items(type="object",
     *                         @OA\Property(property="crwCode", type="string", example="PAN"),
     *                         @OA\Property(property="lgnCode", type="string", example="PC7391")
     *                     ))
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Registros procesados exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Master Company: 42 procesado(s), 0 omitido(s), 5 duplicado(s) eliminado(s)"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="summary", type="object",
     *                     @OA\Property(property="total_processed", type="integer", example=42),
     *                     @OA\Property(property="total_skipped", type="integer", example=0),
     *                     @OA\Property(property="total_duplicates", type="integer", example=5)
     *                 ),
     *                 @OA\Property(property="detail", type="object")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=422, description="Formato no reconocido"),
     *     @OA\Response(response=500, description="Error en la carga masiva")
     * )
     */
    public function masterCompany(Request $request, MasterCompanyAction $action)
    {
        try {
            $results = $action->execute($request->all());

            // Homologar la respuesta al formato de Clientes/Productos
            $totalProcessed = array_sum(array_column($results, 'processed'));
            $totalSkipped = array_sum(array_column($results, 'skipped'));
            $totalDuplicates = array_sum(array_column($results, 'duplicates_removed'));

            return response()->json([
                'status' => 'success',
                'message' => "Master Company: $totalProcessed procesado(s), $totalSkipped omitido(s), $totalDuplicates duplicado(s) eliminado(s)",
                'data' => [
                    'summary' => [
                        'total_processed' => $totalProcessed,
                        'total_skipped' => $totalSkipped,
                        'total_duplicates' => $totalDuplicates,
                    ],
                    'detail' => $results
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error en la carga masiva: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Vaciar todas las tablas organizacionales (Regiones, Sucursales, Logins, Territorios).
     *
     * @OA\Delete(
     *     path="/truncate-companies",
     *     summary="Vaciar todas las tablas organizacionales",
     *     tags={"Cargas Masivas - MasterCompany"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Tablas vaciadas exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Truncate completado: 156 registro(s) eliminado(s)"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(response=500, description="Error al vaciar las tablas")
     * )
     */
    public function truncateCompanies()
    {
        try {
            // Truncar en orden inverso a las dependencias
            $counts = [
                'companies_crew_logins'    => CrewLogin::count(),
                'companies_login_branches' => LoginBranch::count(),
                'companies_territories'    => Territory::count(),
                'companies_logins'         => Login::count(),
                'companies_branches'       => Branch::count(),
                'companies_regions'        => Region::count(),
            ];

            // Desactivar FK checks para truncar si es necesario, aunque el orden inverso debería bastar
            \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
            CrewLogin::truncate();
            LoginBranch::truncate();
            Territory::truncate();
            Login::truncate();
            Branch::truncate();
            Region::truncate();
            \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

            $total = array_sum($counts);

            return response()->json([
                'status' => 'success',
                'message' => "Truncate completado: $total registro(s) eliminado(s)",
                'data' => $counts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al truncar tablas: ' . $e->getMessage()
            ], 500);
        }
    }
}
