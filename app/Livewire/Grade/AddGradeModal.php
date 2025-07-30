<?php

namespace App\Livewire\Grade;

use App\Models\Teacher;
use App\Models\Grade;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;

class AddGradeModal extends Component
{
    public $code, $name, $grade_id, $teacher_id;
    public $edit_mode = false;
    public array $teachers = [];

    protected $listeners = [
        'delete_grade' => 'deleteGrade',
        'update_grade' => 'updateGrade',
        'new_grade' => 'hydrate',
    ];

    public function mount()
    {
        $this->loadTeachers();
    }
    
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
            'teacher_id' => 'required|exists:users,id',
        ];
    }

    protected $messages = [
        'code.required' => 'Grade code is required.',
        'code.unique' => 'Grade code already exists.',
        'code.max' => 'Grade code must not exceed 16 characters.',
        'name.required' => 'Grade name is required.',
        'name.max' => 'Grade name must not exceed 255 characters.',
        'teacher.required' => 'Teacher is required.',
        'teacher_id.exists' => 'Selected teacher is invalid.',
    ];

    public function render()
    {
        return view('livewire.grade.add-grade-modal');
    }

    public function submit()
    {
        $this->validate();

        $data = [
            'code' => $this->code,
            'name' => $this->name,
            'teacher_id' => $this->teacher_id ?: null,
        ];

        if ($this->grade_id) {
            Grade::find($this->grade_id)->update($data);
            $message = 'Grade updated successfully';
            $this->edit_mode = false;
        } else {
            Grade::create($data);
            $message = 'Grade created successfully';
        }

        $this->reset();
        $this->loadTeachers();
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
        $this->loadTeachers();
    }

    #[On('update_grade')]
    public function updateGrade($gradeId)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->loadTeachers();
        
        $grade = Grade::with('teacher')->find($gradeId);
        if ($grade) {
            $this->edit_mode = true;
            $this->grade_id = $grade->id;
            $this->code = $grade->code;
            $this->name = $grade->name;
            $this->teacher_id = $grade->teacher_id;
        }
    }

    public function deleteGrade($id)
    {
        Grade::find($id)->delete();
        $this->dispatch('success', 'Grade deleted successfully');

    }

    public function cancel()
    {
        $this->edit_mode  = false;
        $this->reset();
        $this->resetInputFields();
    }

    public function getAvailableTeachers()
    {
        return Teacher::with('user:id,name,email')
            ->whereDoesntHave('assignedGrade', function ($query) {
                if ($this->grade_id) {
                    $query->where('id', '!=', $this->grade_id);
                }
            })
            ->get();
    }
    
    private function loadTeachers()
    {
        $this->teachers = Teacher::with('user:id,name,email')
            ->orderBy('id')
            ->get()
            ->map(function ($teacher) {
                return [
                    'id' => $teacher->id,
                    'name' => $teacher->user->name ?? 'Unknown',
                    'email' => $teacher->user->email ?? 'No Email',
                    'display_name' => ($teacher->user->name ?? 'Unknown') . ' (' . ($teacher->user->email ?? 'No Email') . ')',
                    'teacher_id' => $teacher->teacher_id ?? null,
                ];
            })->toArray();
    }
}