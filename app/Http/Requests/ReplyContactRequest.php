<?php
declare(strict_types=1);

namespace App\Http\Requests;

/**
 * Class ReplyContactRequest
 * @package App\Http\Requests
 */
class ReplyContactRequest extends Request
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
            'admin_id' => 'required|numeric',
            'admin_message' => 'required',
            'email' => 'required|email'
        ];
    }
}
