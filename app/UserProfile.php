<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserProfile
 *
 * @package App
 * @property string $title
 * @property integer $num_schools
 * @property string $profile_image
 * @property string $location
*/
class UserProfile extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'num_schools', 'profile_image', 'location_address', 'location_latitude', 'location_longitude'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setNumSchoolsAttribute($input)
    {
        $this->attributes['num_schools'] = $input ? $input : null;
    }
    
}
