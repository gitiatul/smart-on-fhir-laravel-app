<?php

namespace App\Models;

use App\Models\Facility;
use App\Models\OcAddress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityCredential extends Model
{
    use HasFactory;
    /**
     * @var String Table name
     */
    protected $table = 'facility_credentials';
    /**
     * @var String Primary key
     */
    protected $primaryKey = 'facility_credentials_id';
    /**
     * @var Array Fillable
     */
    protected $fillable = ['facility_id', 'ehr_client_id', 'ehr_metadata_endpoint', 'ehr_authorize_endpoint', 'ehr_token_endpoint', 'ehr_fhir_endpoint', 'facility_hl7_id', 'facility_internal_id '];

    /**
     * one to one relation with facility
     */
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
