<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\feedback;

class CreatefeedbackRequest extends FormRequest
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
            'staff_id' => 'nullable|exists:staffmember,id',
            'category' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'nullable|integer|between:1,5',  // ⭐ Rating is number 1-5
            'attachment' => 'nullable|file|max:2048',    // Optional file upload
            'is_anonymous' => 'nullable|boolean',        // ✅ True or False
        ];
    }
    
    
}
