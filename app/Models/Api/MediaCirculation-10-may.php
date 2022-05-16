<?php
namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaCirculation extends Model
{
    use HasFactory;

    protected $table = 'BOC$Sole Medias Address';
    protected $guarded = array();
    public $timestamps  = false;
}
