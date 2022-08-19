<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $table = 'category';
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
        $condName  = "bail|required|between:5,100|unique:$this->table,name";
        if (!empty($id)) {
            $condName  .= ",$id";
        }
        return [
            'name'          => $condName,
            'status'        => 'bail|in:active,inactive',
            'is_home'       => 'bail|in:yes,no',
            'display'       => 'bail|in:list,grid',
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
