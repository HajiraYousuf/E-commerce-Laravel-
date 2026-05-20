<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title',
        'report_date',
        'type',
        'file_path'
    ];

    protected $casts = [
        'report_date' => 'date',
    ];
}
