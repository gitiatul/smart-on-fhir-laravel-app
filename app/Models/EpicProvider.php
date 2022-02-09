<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EpicProvider extends Model
{
    use HasFactory;
    /**
     * @var String Table name
     */
    protected $table = 'epic_providers';
    /**
     * @var String Primary key
     */
    protected $primaryKey = 'P_UID';
    /**
     * @var String Timestamp
     */
    public $timestamps = false;
    /**
     * @var String Updated At
     */
    const UPDATED_AT = 'last_updated';
    /**
     * @var Array Fillable
     */
    protected $fillable =
    [
        "P_FNAME",
        "P_LNAME",
        "P_SUFFIX",
        "P_SALUTE",
        "P_email",
        "P_SMS",
        "P_NPI",
        "P_PID",
        "P_ID",
        "P_FHIR_ID",
        "P_PSID",
        "P_PHONETIC",
        "P_FACILITY",
        "P_FACILITY_ID",
        "P_code",
        "P_active",
        "P_appt",
        "P_sec_phone",
        "password",
        "salt",
        "P_TM_room",
        "P_IMG",
        "P_order_UID",
    ];
}
