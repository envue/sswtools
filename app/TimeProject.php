<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TimeProject
 *
 * @package App
 * @property string $name
*/
class TimeProject extends Model
{
    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
}
