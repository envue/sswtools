<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimeEntriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'start_time' => 'required|date_format:'.config('app.date_format').' h:i A',
            'end_time' => 'required|date_format:'.config('app.date_format').' h:i A',
            'work_type_id' => 'required',
            'student.*' => 'exists:students,id',
        ];
    }
}
