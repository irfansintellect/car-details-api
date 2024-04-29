<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public static $wrap = false;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company_name,
            'company_email' =>  $this->company_email,
            'company_phone' =>  $this->company_phone,
            'logo_black' =>  Storage::url($this->logo_black) ?: null,
            'logo_white' =>  Storage::url($this->logo_white) ?: null,

        ];
    }
}
