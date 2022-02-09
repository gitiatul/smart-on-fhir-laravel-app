<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;
    /**
     * @var String Table name
     */
    protected $table = 'auditlog';
    /**
     * @var String Primary key
     */
    protected $primaryKey = 'auditlog_id';
    /**
     * @var Array Fillable
     */
    protected $fillable = [
        'request_token', 'request_url', 'request_method', 'request_query', 'request_payload', 'response_payload', 'ip_address', 'browser_useragent',
        'event_datetime', 'event_actor', 'event_actor_id', 'authorized', 'response_code'
    ];
}
