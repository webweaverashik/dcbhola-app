<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $table = 'letters';
    protected $fillable = [
        'received_date',
        'sender_name',
        'sent_date',
        'short_title',
        'type',
        'memorandum_no',
        'serial_no',
        'uploaded_by',
        'section_to',
        'file_url',
        'status'
    ];

}
