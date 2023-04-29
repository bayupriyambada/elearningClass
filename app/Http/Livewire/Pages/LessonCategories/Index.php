<?php

namespace App\Http\Livewire\Pages\LessonCategories;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Helpers\ToastHelpers;
use App\Models\lesson_categories;
use Livewire\WithPagination;

class Index extends Component
{
    public $showModal = false;
    public $showModalDelete = false;
    public $lessonCategoryId;
    public $lessonCategory;
    public $name;

    use WithPagination;

    public function mount()
    {
        if (auth()->user()->role_id !== 1) {
            abort(403);
        }
    }

    protected $rules = [
        'lessonCategory.name' => 'required|string|min:1|max:255',
    ];

    public function edit($lessonCategoryId)
    {
        $this->showModal = true;
        $this->lessonCategoryId = $lessonCategoryId;
        $this->lessonCategory = lesson_categories::find($lessonCategoryId);
    }

    public function createForm()
    {
        $this->showModal = true;
        $this->lessonCategory = null;
        $this->lessonCategoryId = null;
    }

    public function save()
    {
        try {
            $this->validate();

            if (!is_null($this->lessonCategoryId)) {
                $this->lessonCategory->save();
                ToastHelpers::success($this, "Berhasil memperbaharui mata pelajaran");
            } else {
                $existingCategory = lesson_categories::where('name', ucwords($this->lessonCategory['name']))->first();
                if ($existingCategory) {
                    ToastHelpers::info($this, "Kategori tidak boleh sama dengan " . $this->lessonCategory['name']);
                } else {
                    lesson_categories::create([
                        'id' => Str::uuid(),
                        'name' => ucwords($this->lessonCategory['name'])
                    ]);
                    ToastHelpers::success($this, "Berhasil menambahkan kategori pelajaran");
                }
            }
            $this->showModal = false;
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function confirmDelete($lessonCategoryId)
    {
        $this->showModalDelete = true;
        $this->lessonCategoryId = $lessonCategoryId;
        $this->lessonCategory = lesson_categories::find($lessonCategoryId);
        $this->name = $this->lessonCategory['name'];
    }

    public function closeDelete()
    {
        $this->showModalDelete = false;
    }

    public function deleted()
    {
        $this->lessonCategory = lesson_categories::find($this->lessonCategoryId);
        $this->lessonCategory->delete();
        ToastHelpers::success($this, "Berhasil hapus kategori pelajaran: " . $this->lessonCategory->name);
        $this->showModalDelete = false;
    }
    public function render()
    {
        return view('livewire.pages.lesson-categories.index', [
            'lessons' => lesson_categories::orderByDesc('created_at')->paginate(12)
        ]);
    }
}
