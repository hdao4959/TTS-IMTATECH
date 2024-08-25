<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => ['required', 'email', $this->emailUnique()],
            'password' => 'required|min:8',
            'avatar' => 'nullable|image|max:2048',
            'description' => 'required|max:500',
            'role_id' => 'required',
        ];
    }

    protected function emailUnique(): callable
    {
        return function ($attribute, $value, $fail) {
            if ($this->emailExists($value, $this->route('user')->id)) {
                $fail('Email này đã được đăng ký.');
            }
        };
    }

    protected function emailExists(string $email, ?int $userId = null): bool
    {
        $query = User::where('email', $email);

        if ($userId) {
            $query->where('id', '!=', $userId);
        }

        return $query->exists();
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            // 'email.unique' => 'Email này đã được đăng ký.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải ít nhất 8 ký tự.',
            'avatar.image' => 'Ảnh đại diện phải là một hình ảnh hợp lệ.',
            'avatar.max' => 'Kích thước ảnh đại diện không được vượt quá 2MB.',
            'description.required' => 'Mô tả không được để trống.',
            'description.max' => 'Mô tả không được vượt quá 500 ký tự.',
            'role_id.required' => 'Vui lòng chọn một vai trò.',
        ];
    }
}
