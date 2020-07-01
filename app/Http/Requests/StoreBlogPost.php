<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()//权限
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *第二种表单验证方式  手册第324页
     * @return array
     */
    // public function rules()//规则
    // {
    //     return [

    //         'brand_name' => 'required|unique:brand',//名称不能为空 唯一性验证
    //         'brand_url' => 'required',//网址不能为空
    //     ];
    // }
    // //自定义错误信息  手册第329页
    // public function messages()
    // {
    //     return [

    //         "brand_name.required"=>"品牌名称必填",
    //         "brand_name.unique"=>"品牌名称已存在",
    //         "brand_url.required"=>"品牌网址必填",
    //     ];
    // }

    /**
     * Get the validation rules that apply to the request.
     *第二种表单验证方式  手册第324页
     * @return array
     */
    public function rules()//规则
    {
        return [

            'cate_name' => [
            'required',
             Rule::unique('category')->ignore(request()->id,'cate_id'),//强制一个忽略给定 ID  手册第356页
            ],//名称不能为空 唯一性验证
            //'brand_url' => 'required',//网址不能为空
        ];
    }
    //自定义错误信息  手册第329页
    public function messages()
    {
        return [

            "cate_name.required"=>"品牌名称必填",
            "cate_name.unique"=>"品牌名称已存在",
            "brand_url.required"=>"品牌网址必填",
        ];
    }
}
