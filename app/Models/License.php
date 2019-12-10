<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "license";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "license_id";

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = "Y-m-d H:i:s";

    /**
     * Relationships
     * 
     */
    public function providers () {
        return $this->belongsToMany(Specialty::class, 'provider_specialty', 'license_id', 'provider_id');
    }
}
