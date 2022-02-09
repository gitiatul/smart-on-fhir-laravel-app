<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FacilityCredential;

class Facility extends Model
{
    use HasFactory;
    /**
     * @var String Table name
     */
    protected $table = 'facilities';
    /**
     * @var String Primary Key
     */
    protected $primaryKey = 'facility_id';
    /**
     * @var Array Fillable
     */
    protected $fillable = ['facility_app_id', 'facility_name', 'facility_owner_name', 'facility_status'];

    /**
     * one to one relation with facilityCredential
     */
    public function facilitycredential()
    {
        return $this->hasOne(FacilityCredential::class);
    }
}
