<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $table = 'slider';
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
        $id = $this->id;
        $condThumb = 'bail|required|mimetypes:image/jpeg,image/png|max:1024';
        $condName  = "bail|required|between:5,100|unique:$this->table,name";
        if (!empty($id)) {
            $condThumb = 'bail|mimetypes:image/jpeg,image/png|max:1024';
            $condName  .= ",$id";
        }
        return [
            'name'          => $condName,
            'description'   => 'bail|required|min:5',
            'link'          => 'bail|required|min:5|url',
            'status'        => 'bail|in:active,inactive',
            'thumb'         => $condThumb
        ];
    }
    public function messages()
    {
        return [
            // 'name.required' => 'Name: không được rỗng!',
            // 'name.min'      => 'Name: Chiều dài ít nhất phải :min kí tự!',
            // 'description.required' => 'Description: Không được rỗng!',
        ];
    }
}
