<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

/**
 * Debtor Model
 *
 * Represents a debtor in the MongoDB database.
 */
class Debtor extends Model
{
    /**
     * The name of the MongoDB collection.
     *
     * @var string
     */
    protected $collection = 'debtors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_number',
        'worst_situation',
        'total_loans',
    ];
}