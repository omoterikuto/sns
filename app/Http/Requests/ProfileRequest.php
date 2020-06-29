<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
      'name' => ['required', 'string', 'alpha_num', 'min:3', 'max:16', Rule::unique('App\User')->ignore($this->user()->id)],
      'profile' => ['max:100']
    ];
  }
  public function attributes()
  {
    return [
      'name' => 'ユーザーネーム',
      'profile' => 'プロフィール文',
    ];
  }
}