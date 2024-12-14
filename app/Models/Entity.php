<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

/**
 * Debtor Model
 *
 * Represents an Entity in the MongoDB database.
 */
class Entity extends Model
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
        'entity_code',
        'total_loans_sum'
    ];
}
