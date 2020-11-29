<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationReport extends Model
{
    protected $table = 'operation_report';

    protected $fillable = ['operation_id', 'report_id'];
}
