<?php

namespace Domain\Faq\Livewire\Forms;

use Domain\FAQ\Models\Question;
use Support\BasicComponent;
use Tanthammar\TallForms\Input;
use Tanthammar\TallForms\Repeater;
use Tanthammar\TallForms\TallForm;

class UserForm extends BasicComponent
{
    use TallForm;

    protected $listeners = ['editQuestion', 'createForm'];

    public $question;

    protected $queryString = [
        'question' => ['except' => ''],
    ];

    public function mount(?Question $question)
    {
        if($question->exists) {
            $this->authorize('update', $question);
        }

        $this->fill([
            'wrapWithView' => false, //see https://github.com/tanthammar/tall-forms/wiki/Wrapper-Layout
            'showReset' => false,
            'showGoBack' => false,
            'saveStayBtnTxt' => 'Save'
        ]);

        $this->mount_form($question); // $question from hereon, called $this->model
    }


    // Mandatory method
    public function onCreateModel($validated_data)
    {
        $validated_data['team_id'] = currentTeam()->id;
        // Set the $model property in order to conditionally display fields when the model instance exists, on saveAndStayResponse()
        $this->model = Question::create($validated_data);
        $this->question = $this->model->id;
        $this->emit('questionUpdated', $this->model->id);
    }

    // OPTIONAL method used for the "Save and stay" button, this method already exists in the TallForm trait
    public function onUpdateModel($validated_data)
    {
        $this->authorize('update', $this->model);
        $this->model->update($validated_data);
        $this->question = $this->model->id;

        $this->emit('questionUpdated', $this->model->id);
    }

    public function delete()
    {
        if (optional($this->model)->exists) {
            $this->question = null;
            $this->emit('questionDeleted', $this->model);
        }
    }

    public function fields()
    {
        return [
            Input::make('Name')->rules('required'),
            Repeater::make(__('Utterances'))->fields([
                Input::make(__('Utterance'))
            ])
        ];
    }

    public function editQuestion(Question $question)
    {
        $this->mount_form($question);
        $this->question = $question->id;
    }

    public function createQuestion()
    {
        $this->question = null;
        $this->model = null;
        $this->mount_form(null);
    }
}
