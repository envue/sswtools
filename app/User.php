<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Carbon\Carbon;
use Hash;
use App\Traits\FilterByTeam;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $team
 * @property string $remember_token
 * @property string $stripe_customer_id
 * @property string $role_until
*/
class User extends Authenticatable
{
    use Notifiable;
    use FilterByTeam;

    protected $fillable = ['name', 'email', 'password', 'remember_token', 'stripe_customer_id', 'role_until', 'role_id', 'team_id'];
    protected $hidden = ['password', 'remember_token'];
    public static $searchable = [
        'name',
        'email',
    ];
    
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRoleIdAttribute($input)
    {
        $this->attributes['role_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTeamIdAttribute($input)
    {
        $this->attributes['team_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setRoleUntilAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['role_until'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['role_until'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getRoleUntilAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
    
    
    

    public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPassword($token));
    }

    public function getAvatarAttribute()
    {
        $userEmail = $this->attributes['email'];
        $url = "http://picasaweb.google.com/data/entry/api/user/$userEmail?alt=json";
               
        if (!empty($url)) {
            //valid
            $data = file_get_contents($url);
            $d = json_decode($data);
            $avatar = $d->{'entry'}->{'gphoto$thumbnail'}->{'$t'}; 
            }
            else {
                $avatar = "https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y";
            };
    
    return $avatar;
    }
}
