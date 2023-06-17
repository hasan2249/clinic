<?php
    namespace App\Http\Requests\Backend\Costs;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class StoreCostRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return access()->allow('edit-page');
        }
    
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                // 'cannonical_link' => ['string', 'nullable', 'url'],
                // 'seo_title' => ['string', 'nullable'],
                // 'seo_keyword' => ['string', 'nullable'],
                // 'seo_description' => ['string', 'nullable'],
            ];
        }
    }
    