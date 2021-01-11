<?php

namespace App\Resources;

use Tanthammar\TallForms\Resources\Fields\Boolean;
use Tanthammar\TallForms\Resources\Fields\Date;
use Tanthammar\TallForms\Resources\Fields\Email;
use Tanthammar\TallForms\Resources\Fields\TextString;
use Tanthammar\TallForms\Resources\TallResource;

class UserResource extends TallResource
{
    public function fields()
    {
        return [
            TextString::make('Name')->rules('required'),
            Email::make('Email')->rules('required|email'),
            Boolean::make('IsActive', 'is_active'),
            Date::make('Birthday')->filterable(),
        ];
    }
}
