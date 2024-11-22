<?php

namespace App\Http\Requests\Notification;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Notification\{NotificationType,NotificationTypes};

class NotificationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the POST request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'type' => ['nullable'],
            'types' => ['required'],
            'option' => ['nullable'],
            'url' => ['nullable','string'],
            'user_id' => ['nullable','array'],
            'user_id.*' => ['nullable','exists:App\Models\User,id'],
            'title' => ['required','string'],
            'message' => ['required','string'],
        ];
    }
}
