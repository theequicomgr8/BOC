<?php
namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaCirculationDone extends Model
{
    use HasFactory;

    protected $table = 'BOC$OD Media Work done';
    protected $guarded = array();
    public $timestamps  = false;
}
