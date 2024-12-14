<?php

namespace App\Http\Controllers;

use App\Services\DataMigrationService;

/**
 * MigrationController
 *
 * This controller handles the data migration process. It creates an instance of the `DataMigrationService` and triggers the migration.
 */
class MigrationController extends Controller
{
    /**
     * Migrates data from the specified file to the MongoDB database.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function migrate()
    {
        $dataMigrationService = new DataMigrationService(base_path('deudores.txt'));
        $dataMigrationService->migrateToDB();

        return response()->json(['message' => 'Data migration completed']);
    }
}
