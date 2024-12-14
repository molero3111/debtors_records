<?php

namespace App\Http\Controllers;

use App\Jobs\MigrateDataJob;
use App\Models\Debtor;
use App\Models\Entity;
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
        MigrateDataJob::dispatch(base_path('deudores.txt'));

        return response()->json(['message' => 'Data migration in progress']);
    }

    public function cleanDatabase()
    {
        DataMigrationService::removeDebtorsAndEntities();

        return response()->json(['message' => 'Database cleaned successfully']);
    }
}
