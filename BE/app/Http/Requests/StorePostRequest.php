<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            
                'title' => ['required', 'max:255', 'unique'],
                'img_thumbnail' => ['required'],
                'category_id' => ['required'],
                'description' => ['required', 'max:150'],
                'content' => ['required'],
                'post_status_id' => ['required']
            
        ];
    }
    public function messages(){
        return [
            'title.required' => "Bạn chưa nhập Tiêu đề",
            'title.max' => "Độ dài tiêu đề không quá 255 ký tự",
            'title.unique' => "Tên bài đăng này đã tồn tại",
            'img_thumbnail.required' => "Bạn chưa chọn hình ảnh",
            // 'img_thumbnail.image' => "Ảnh không đúng định dạng",
            'category_id.required' => "Bạn chưa chọn danh mục",
            'description.required' => "Bạn chưa nhập mô tả",
            'description.max:150' => "Mô tả không được nhập quá 150 ký tự",
            'content.required' => "Bạn chưa nhập Nội dung",
            'post_status_id.required' => "Bạn chưa chọn trạng thái bài đăng"
        ];
    }
}
