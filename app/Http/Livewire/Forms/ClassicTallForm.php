<?php

namespace App\Http\Livewire\Forms;

use App\Models\User;
use Livewire\Component;
use Tanthammar\TallForms\Checkbox;
use Tanthammar\TallForms\Input;
use Tanthammar\TallForms\TallForm;
use Tanthammar\TallFormsSponsors\DatePicker;

class ClassicTallForm extends Component
{
    use TallForm;

    public function mount(?User $user)
    {
        $this->fill([
            'wrapWithView' => false, //see https://github.com/tanthammar/tall-forms/wiki/Wrapper-Layout
            'showReset' => false,
            'showGoBack' => false,
            'saveStayBtnTxt' => 'Save'
        ]);

        $this->mount_form($user); // $question from hereon, called $this->model
    }


    // Mandatory method
    public function onCreateModel($validated_data)
    {
        $validated_data['password'] = 1;

        // Set the $model property in order to conditionally display fields when the model instance exists, on saveAndStayResponse()
        $this->model = User::create($validated_data);
    }

    // OPTIONAL method used for the "Save and stay" button, this method already exists in the TallForm trait
    public function onUpdateModel($validated_data)
    {
        ray($validated_data);
        $this->model->update($validated_data);
    }


    public function fields()
    {
        return [
            Input::make('Name')->rules('required'),
            Input::make('Email')->rules('required|email'),
            Checkbox::make('IsActive', 'is_active'),
            DatePicker::make('Birthday', 'birthday')
        ];
    }
}
