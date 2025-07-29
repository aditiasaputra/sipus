<?php

namespace App\Livewire\Grade;

use App\Models\Grade;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;

class AddGradeModal extends Component
{
    public $code = '', $name = '', $grade_id;
    public $update_mode = false;

    protected $listeners = [
        'delete_grade' => 'deleteGrade',
        'update_grade' => 'updateGrade',
        'new_grade' => 'hydrate',
    ];
    
    protected function rules()
    {
        return [
            'code' => [
                'required',
                'string',
                'max:16',
                Rule::unique('grades', 'code')->ignore($this->grade_id)
            ],
            'name' => 'required|string|max:255',
        ];
    }

    protected $messages = [
        'code.required' => 'Grade code is required.',
        'code.unique' => 'Grade code already exists.',
        'code.max' => 'Grade code must not exceed 16 characters.',
        'name.required' => 'Grade name is required.',
        'name.max' => 'Grade name must not exceed 255 characters.',
    ];

    public function render()
    {
        return view('livewire.grade.add-grade-modal');
    }

    public function submit()
    {
        $this->validate();

        if ($this->grade_id) {
            Grade::find($this->grade_id)->update([
                'code' => $this->code,
                'name' => $this->name,
            ]);
            $message = 'Grade updated successfully';
            $this->update_mode = false;
        } else {
            Grade::create([
                'code' => $this->code,
                'name' => $this->name,
            ]);
            $message = 'Grade created successfully';
        }

        $this->reset();
        $this->dispatch('success', $message);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('new_grade')]
    public function newGrade()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    #[On('update_grade')]
    public function updateGrade($gradeId)
    {
        $this->reset();
        $this->resetErrorBag();
        
        $grade = Grade::find($gradeId);
        if ($grade) {
            $this->update_mode = true;

            $this->grade_id = $grade->id;
            $this->code = $grade->code;
            $this->name = $grade->name;
        }
    }

    public function deleteGrade($id)
    {
        Grade::find($id)->delete();
        $this->dispatch('success', 'Grade deleted successfully');

    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
}