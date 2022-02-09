<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EpicCalPeople extends Model
{
    use HasFactory;
    /**
     * @var String Table name
     */
    protected $table = 'epic_cal_people';
    /**
     * @var String Updated At
     */
    const UPDATED_AT = 'last_changed';
    /**
     * @var String Timestamp
     */
    public $timestamps = false;
    /**
     * @var String Primary key
     */
    protected $primaryKey = 'p_UID';
    /**
     * @var Array Fillable
     */
    protected $fillable = [
        "p_fname",
        "p_lname",
        "p_email",
        "p_phone_cell",
        "p_dob",
        "p_gender",
        "p_PRACTID",
        "p_pid",
        "p_fhir_id",
        "p_mname",
        "p_phone_home",
        "p_street",
        "p_city",
        "p_county",
        "p_state",
        "p_postal_code",
        "p_country_code",
        "p_allow_sms",
        "p_allow_avm",
        "p_allow_email",
        "p_deceased",
        "p_language",
        "p_allow_surveys",
        "p_last_CAPHS",
        "needs_verification",
        "last_json"
    ];
}
