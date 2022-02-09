<?php

namespace App\Models;

use App\Models\FacilityCredential;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OcAddress extends Model
{
    use HasFactory;
    /**
     * @var String Table name
     */
    protected $table = 'oc_address';
    /**
     * @var String Primary key
     */
    protected $primaryKey = 'address_id';
    /**
     * @var Array Fillable
     */
    protected $fillable = ['customer_facility_id ', 'company', 'address_id'];
}
