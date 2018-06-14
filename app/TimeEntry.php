<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\FilterByUser;

/**
 * Class TimeEntry
 *
 * @package App
 * @property string $start_time
 * @property string $end_time
 * @property string $work_type
 * @property string $population_type
 * @property string $caseload
 * @property string $description
 * @property text $notes
 * @property string $created_by
 * @property string $created_by_team
*/
class TimeEntry extends Model
{
    use FilterByUser;

    protected $fillable = ['start_time', 'end_time', 'population_type', 'caseload', 'description', 'notes', 'work_type_id', 'created_by_id', 'created_by_team_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['start_time'] = Carbon::createFromFormat(config('app.date_format') . ' h:i A', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['start_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getStartTimeAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' h:i A');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' h:i A');
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setEndTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['end_time'] = Carbon::createFromFormat(config('app.date_format') . ' h:i A', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['end_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEndTimeAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' h:i A');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' h:i A');
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setWorkTypeIdAttribute($input)
    {
        $this->attributes['work_type_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByTeamIdAttribute($input)
    {
        $this->attributes['created_by_team_id'] = $input ? $input : null;
    }
    
    public function work_type()
    {
        return $this->belongsTo(TimeWorkType::class, 'work_type_id');
    }
    
    public function student()
    {
        return $this->belongsToMany(Student::class, 'student_time_entry')->withTrashed();
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function created_by_team()
    {
        return $this->belongsTo(Team::class, 'created_by_team_id');
    }
    
}
