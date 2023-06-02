<?php

namespace Modules\MPesa\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MPesa extends Model
{
    use HasFactory;

    /** Mass Assignment values */

    protected $fillable = [
        'checkoutid','rcode','rdesc','txnid'
    ];
    
}
