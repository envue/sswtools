<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TimeWorkType
 *
 * @package App
 * @property string $name
*/
class TimeWorkType extends Model
{
    protected $fillable = ['name','description'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
}
