<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "drug";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'drug_id';

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';
}
