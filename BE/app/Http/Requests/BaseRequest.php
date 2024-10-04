<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
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
        if ($this->isMethod('GET')) {
            return $this->methodGet();
        } elseif ($this->isMethod('POST')) {
            return $this->methodPost();
        } elseif ($this->isMethod('PUT')) {
            return $this->methodPut();
        } elseif ($this->isMethod('PATCH')) {
            return $this->methodPatch();
        } elseif ($this->isMethod('DELETE')) {
            return $this->methodDelete();
        } elseif ($this->isMethod('OPTIONS')) {
            return $this->methodOptions();
        }

        return [];
    }

    /**
     * Get the validation rules that apply to GET requests.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [];
    }

    /**
     * Get the validation rules that apply to POST requests.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [];
    }

    /**
     * Get the validation rules that apply to PUT requests.
     *
     * @return array
     */
    protected function methodPut()
    {
        return [];
    }

    /**
     * Get the validation rules that apply to PATCH requests.
     *
     * @return array
     */
    protected function methodPatch()
    {
        return [];
    }

    /**
     * Get the validation rules that apply to DELETE requests.
     *
     * @return array
     */
    protected function methodDelete()
    {
        return [];
    }

    /**
     * Get the validation rules that apply to OPTIONS requests.
     *
     * @return array
     */
    protected function methodOptions()
    {
        return [];
    }
}
