@section('pageTitle', 'Pelajaran ' . $lesson->lessonCategory->name)
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Pelajaran Anda : {{ $lesson->lessonCategory->name }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('school.classes.index') }}" title="Kembali" />
                    </span>
                    <span class=" d-sm-inline">
                        <a href="#" wire:click.prevent="createForm" class="btn btn-primary">Tambah Sub
                            Pelajaran</a>
                    </span>
                </div>

            </div>
        </div>
        <div class="row row-cards mt-2">
            @forelse ($subLessons as $index => $subLesson)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $index + 1 }}. {{ $subLesson->title }}
                                @if ($subLesson->isPublish === 'draft')
                                    <span class="badge bg-red">Draf</span>
                                @elseif ($subLesson->isPublish === 'publish')
                                    <span class="badge bg-blue">Diterbitkan</span>
                                @endif
                            </h3>
                            <div class="card-actions btn-actions">
                                <a href="#" class="btn-action" title="Lihat {{ $subLesson->title }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                        </path>
                                    </svg>
                                </a>
                                @if (auth()->user()->role_id !== 3)
                                    <div class="dropdown">
                                        <button class="btn-action" data-bs-toggle="dropdown" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-dots-vertical" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                            </svg>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end"
                                            style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 38.6667px, 0px);"
                                            data-popper-placement="bottom-end">

                                            <a class="dropdown-item"
                                                wire:click="previewSubLesson({{ json_encode($lesson->id) }}, {{ json_encode($subLesson->id) }})"
                                                href="#">
                                                Lihat Detail
                                            </a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="edit({{ json_encode($subLesson->id) }})">
                                                Ubah
                                            </a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="confirmDelete({{ json_encode($subLesson->id) }})">
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tidak ada data</h3>
                        </div>
                    </div>
                </div>
            @endforelse
            {{ $subLessons->links() }}
        </div>
    </div>
    {{-- modal create / update --}}
    <div class="modal modal-blur fade show" id="modal" tabindex="-1"
        @if ($showModal) style="display:block" @endif aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $subLessonId ? 'Ubah' : 'Tambah' }} Kategori Pelajaran</h5>
                    <button type="button" wire:click="close" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="mb-3">
                            <x-input type="text" name="subLesson.title" label="Kategori Pelajaran" required />
                        </div>
                        <div class="mb-3" wire:ignore>
                            <textarea data-description="@this" wire:model.defer="subLesson.content"
                                class="form-control @error('subLesson.content') is-invalid @enderror" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-label required">Terbit</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" wire:model="subLesson.isPublish" value="draft"
                                        type="radio" name="radios-inline"
                                        {{ $isPublish == 'draft' ? 'checked' : '' }}>
                                    <span class="form-check-label">Draf</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="subLesson.isPublish"
                                        value="publish" name="radios-inline"
                                        {{ $isPublish == 'publish' ? 'checked' : '' }}>
                                    <span class="form-check-label">Diterbitkan</span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-label required">Materi / Tugas</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" wire:model="subLesson.isStatus" value="material"
                                        type="radio" {{ $isStatus == 'material' ? 'checked' : '' }}>
                                    <span class="form-check-label">Materi</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="subLesson.isStatus"
                                        value="task" {{ $isStatus == 'task' ? 'checked' : '' }}>
                                    <span class="form-check-label">Tugas</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="close" class="btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            {{ $subLessonId ? 'Simpan Perubahan' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal create / update --}}

    {{-- modal delete --}}
    <div class="modal modal-blur @if ($showModalDelete) fade show @endif" id="modal-danger" tabindex="-1"
        role="dialog" aria-modal="false" @if ($showModalDelete) style="display:block" @endif>
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" wire:click.prevent="closeDelete" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9v2m0 4v.01"></path>
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75">
                        </path>
                    </svg>
                    <div class="text-muted">
                        Anda yakin ingin menghapus {{ $title }} ? Data dihapus secara permanen.
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button type="button" wire:click="closeDelete" class="btn w-100">Batal</button>
                            </div>
                            <div class="col">
                                <a href="#" wire:click.prevent="deleted" class="btn btn-danger w-100"
                                    data-bs-dismiss="modal">
                                    Hapus Permanen
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal delete --}}
</div>
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/plugins/code-block/plugin.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
    <script>
        var ready = (callback) => {
            if (document.readyState != "loading") callback();
            else document.addEventListener("DOMContentLoaded", callback);
        }
        ready(() => {
            ClassicEditor
                .create(document.querySelector('#description'), {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                            'bulletedList', 'numberedList', 'todoList', '|',
                            'undo', 'redo',
                            '-',
                            'link', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                            'htmlEmbed', '|',
                            'codeBlockLanguage', '|', // Mengganti textPartLanguage dengan codeBlockLanguage
                            'sourceEditing'
                        ],
                        shouldNotGroupWhenFull: true
                    },
                })
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.set('subLesson.content', editor.getData());
                    })
                    Livewire.on('reinit', (data) => {
                        if (data === null) {
                            editor.setData("", "")
                        }
                        editor.setData(data.subLesson.content);
                    })
                })
                .catch(error => {
                    console.error(error);
                });
        })
    </script>
@endpush
