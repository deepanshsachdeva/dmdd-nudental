<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "provider";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "provider_id";

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
    public function specialities () {
        return $this->belongsToMany(Specialty::class, 'provider_specialty', 'provider_id', 'specialty_id');
    }

    public function licenses () {
        return $this->belongsToMany(License::class, 'provider_license', 'provider_id', 'license_id');
    }

    
}
