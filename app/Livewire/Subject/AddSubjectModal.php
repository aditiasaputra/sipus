<?php

namespace App\Livewire\Subject;

use App\Models\Subject;
use Livewire\Component;
use Illuminate\Validation\Rule;

class AddSubjectModal extends Component
{
    public $code = '', $name = '', $subject_id;
    public $update_mode = false;
    
    protected function rules()
    {
        return [
            'code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('subjects', 'code')->ignore($this->subject_id)
            ],
            'name' => 'required|string|max:255',
        ];
    }

    protected $messages = [
        'code.required' => 'Subject code is required.',
        'code.unique' => 'Subject code already exists.',
        'code.max' => 'Subject code must not exceed 10 characters.',
        'name.required' => 'Subject name is required.',
        'name.max' => 'Subject name must not exceed 255 characters.',
    ];

    public function submit()
    {
        $this->validate();

        if ($this->subject_id) {
            Subject::find($this->subject_id)->update([
                'code' => $this->code,
                'name' => $this->name,
            ]);
            $message = 'Subject updated successfully';
            $this->update_mode = false;
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

    public function render()
    {
        return view('livewire.subject.add-subject-modal');
    }

    #[On('new_subject')]
    public function newSubject()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    #[On('edit_subject')]
    public function editSubject($subjectId)
    {
        $this->reset();
        $this->resetErrorBag();
        
        $subject = Subject::find($subjectId);
        if ($subject) {
            $this->subject_id = $subject->id;
            $this->code = $subject->code;
            $this->name = $subject->name;
            $this->update_mode = true;
        }
    }

    public function delete($id)

    {
        Subject::find($id)->delete();
        session()->flash('message', 'Subject deleted successfully');
    }

    public function cancel()

    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
}