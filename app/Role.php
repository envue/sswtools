<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App
 * @property string $title
 * @property decimal $price
 * @property string $stripe_plan_id
*/
class Role extends Model
{
    protected $fillable = ['title', 'price', 'stripe_plan_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPriceAttribute($input)
    {
        $this->attributes['price'] = $input ? $input : null;
    }
    
}
