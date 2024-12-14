<?php

namespace App\Services;

use App\Models\Debtor;
use App\Models\Entity;
use Illuminate\Support\Facades\DB;

/**
 * DataMigrationService
 *
 * This class is responsible for processing a data file and migrating its contents to a MongoDB database.
 */
class DataMigrationService
{

    private $filepath;

    /**
     * Constructs a new DataMigrationService instance.
     *
     * @param string $filepath The path to the file to be processed.
     */
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * Processes the file and returns an array of debtors and entities.
     *
     * @return array An array containing 'debtors' and 'entities' arrays.
     */
    private function processFile()
    {
        $debtors = [];
        $entities = [];

        $file = fopen($this->filepath, 'r');
        while (($line = fgets($file)) !== false) {

            // Extracts data based on positions
            $entityCode = trim(substr($line, 0, 5));
            $identificationNumber = trim(substr($line, 15, 11));
            $situation = (int)trim(substr($line, 26, 2));
            $loans = (float)str_replace(',', '.', trim(substr($line, 28, 12)));

            // Processes debtors
            if (!isset($debtors[$identificationNumber])) {
                $debtors[$identificationNumber] = [
                    'id_number' => $identificationNumber,
                    'worst_situation' => $situation,
                    'total_loans' => $loans,
                ];
            } else {
                $debtors[$identificationNumber]['worst_situation'] = max(
                    $debtors[$identificationNumber]['worst_situation'],
                    $situation
                );
                $debtors[$identificationNumber]['total_loans'] += $loans;
            }

            // Processes entities
            if (!isset($entities[$entityCode])) {
                $entities[$entityCode] = [
                    'entity_code' => $entityCode,
                    'total_loans_sum' => $loans,
                ];
            } else {
                $entities[$entityCode]['total_loans_sum'] += $loans;
            }
        }
        fclose($file);

        return ['debtors' => $debtors, 'entities' => $entities];
    }

    /**
     * Migrates the processed data to the MongoDB database.
     */
    public function migrateToDB()
    {
        $result = $this->processFile($this->filepath);

        DB::connection('mongodb')->table('debtors')->insert(array_values($result['debtors']));
        DB::connection('mongodb')->table('entities')->insert(array_values($result['entities']));
    }

    /**
     * Deletes all documents in debtors and entities collections.
     */
    public static function removeDebtorsAndEntities()
    {
        Debtor::truncate();
        Entity::truncate();
    }
}
