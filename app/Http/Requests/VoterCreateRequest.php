<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoterCreateRequest extends FormRequest
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
            'title'=>'max:255|nullable',
            'description'=>'max:64000|nullable',
            'name'=>'string|max:500|nullable',
            'state'=>'integer|nullable',
            'q_type'=>'integer|nullable',
            'q_value'=>'integer|nullable',
            'type_id'=>'integer|nullable',
            'arbiter'=>'integer|nullable',
            'publish'=>'date|nullable',
            'deadline'=>'date|nullable',
        ];
    }
}
