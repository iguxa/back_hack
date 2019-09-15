<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoterPublishRequest extends FormRequest
{
    public const DRAFT = 1;
    public const PUBLISH = 2;
    public const CANCELED = 3;
    public const ALLOWED = 4;
    public const DISALLOWED = 5;
    public const CONFLICT = 6;

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
            'title'=>'max:255',
            'description'=>'max:64000',
            'name'=>'string|max:500',
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
