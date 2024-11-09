<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'link' => 'required|string|url',
            'img_thumbnail' => 'required|image|max:2048',
            'is_visible' => 'nullable|boolean',
            'post_id' => 'nullable|exists:posts,id',
        ];
    }

    public function messages()
    {
        return [
            'title.string' => 'Tiêu đề phải là một chuỗi.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.string' => 'Nội dung phải là một chuỗi.',
            'link.required' => 'Liên kết là bắt buộc.',
            'link.string' => 'Liên kết phải là một chuỗi.',
            'link.url' => 'Liên kết phải là một URL hợp lệ.',
            'img_thumbnail.required' => 'Hình ảnh thumbnail là bắt buộc.',
            'img_thumbnail.image' => 'Tệp phải là một hình ảnh.',
            'img_thumbnail.max' => 'Hình ảnh không được vượt quá 2MB.',
            'is_visible.boolean' => 'Trạng thái hiển thị phải là hiển thị hoặc ẩn.',
            'post_id.exists' => 'Bài viết không tồn tại.',
        ];
    }
}
