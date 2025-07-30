<?php

namespace App\Livewire\Subject;

use App\Models\Subject;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;

class AddSubjectModal extends Component
{
    public $code = '', $name = '', $subject_id;
    public $edit_mode = false;

    protected $listeners = [
        'delete_subject' => 'deleteSubject',
        'update_subject' => 'updateSubject',
        'new_subject' => 'hydrate',
    ];
    
    protected function rules()
    {
        return [
            'code' => [
                'required',
                'string',
                'max:16',
                Rule::unique('subjects', 'code')->ignore($this->subject_id)
            ],
            'name' => 'required|string|max:255',
        ];
    }

    protected $messages = [
        'code.required' => 'Subject code is required.',
        'code.unique' => 'Subject code already exists.',
        'code.max' => 'Subject code must not exceed 16 characters.',
        'name.required' => 'Subject name is required.',
        'name.max' => 'Subject name must not exceed 255 characters.',
    ];

    public function render()
    {
        return view('livewire.subject.add-subject-modal');
    }

    public function submit()
    {
        $this->validate();

        if ($this->subject_id) {
            Subject::find($this->subject_id)->update([
                'code' => $this->code,
                'name' => $this->name,
            ]);
            $message = 'Subject updated successfully';
            $this->edit_mode = false;
        } else {
            Subject::create([
                'code' => $this->code,
                'name' => $this->name,
            ]);
            $message = 'Subject created successfully';
        }

        $this->reset();
        $this->dispatch('success', $message);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('new_subject')]
    public function newSubject()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    #[On('update_subject')]
    public function updateSubject($subjectId)
    {
        $this->reset();
        $this->resetErrorBag();
        
        $subject = Subject::find($subjectId);
        if ($subject) {
            $this->edit_mode = true;

            $this->subject_id = $subject->id;
            $this->code = $subject->code;
            $this->name = $subject->name;
        }
    }

    public function deleteSubject($id)
    {
        Subject::find($id)->delete();
        $this->dispatch('success', 'Subject deleted successfully');

    }

    public function cancel()
    {
        $this->edit_mode = false;
        $this->resetInputFields();
    }
}