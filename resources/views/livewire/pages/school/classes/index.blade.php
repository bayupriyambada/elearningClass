@section('pageTitle', 'List Pelajaran')
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Pelajaran Anda
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <button wire:click.prevent="deleteSelected"
                            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="btn btn-danger"
                            @if ($bulkDisabled) disabled @endif>
                            Pilih Dihapus [{{ count($selectedLesson) }}]
                        </button>
                    </span>
                    <span class=" d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('school.dashboard') }}" title="Kembali" />
                    </span>
                    <span class=" d-sm-inline">
                        <a href="#" wire:click.prevent="createForm" class="btn btn-primary">Tambah Pelajaran</a>
                    </span>
                </div>

            </div>
        </div>
        <div class="row row-cards mt-2">
            <?php $index = 1 + ($lessonByUser->currentPage() - 1) * $lessonByUser->perPage(); ?>
            @forelse ($lessonByUser as $lesson)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                            <div class="col g-2">
                                <h3 class="card-title ml-2"> {{ $index++ }}. {{ $lesson->lessonCategory->name }}
                                    <span class="text-red card-subtitle"><b>{{ $lesson->passcode }}</b></span>
                                    <span class="card-subtitle">v.{{ $lesson->version }}</span>
                                </h3>
                            </div>

                            <div class="card-actions btn-actions">
                                <input type="checkbox" wire:model="selectedLesson" value="{{ $lesson->id }}"
                                    class="form-check-input mt-2" style="margin-right: 10px">
                                <div class="dropdown">
                                    <button class="btn-action" data-bs-toggle="dropdown" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-dots-vertical" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                            href="{{ route('school.classes.sub.index', [$lesson->id]) }}">
                                            <span>Tambah Sub Materi</span>
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('school.classes.sub.index', [$lesson->id]) }}">
                                            <span>Rata-Rata Siswa</span>
                                        </a>
                                        <a class="dropdown-item" href="#"
                                            wire:click="edit({{ json_encode($lesson->id) }})">
                                            Ubah
                                        </a>
                                        <a class="dropdown-item" href="#"
                                            wire:click="confirmDelete({{ json_encode($lesson->id) }})">
                                            Hapus
                                        </a>
                                    </div>
                                </div>
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
            {{ $lessonByUser->links() }}
        </div>
    </div>

    {{-- modal create / update --}}
    <div class="modal modal-blur fade show" id="modal" tabindex="-1"
        @if ($showModal) style="display:block" @endif aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Pelajaran</h5>
                    <button type="button" wire:click="close" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save" autocomplete="off">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlSelect2">Example select</label>
                            <select wire:ignore.self wire:model.defer="classes.lesson_categories_id"
                                class="form-control select2" data-dropdown-css-class="select2-dropdown--above"
                                data-dropdown-parent="#modal" id="selected">
                                <option value="">Select an option</option>
                                @foreach ($lessonCategories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputNumber" class="form-label required">KKM Pelajaran</label>
                            <input type="number" wire:model="classes.kkm"
                                onkeydown="if(event.keyCode === 69 || event.keyCode === 190 || event.keyCode === 189 || event.keyCode === 109) return false;"
                                min="1" max="100" id="inputNumber" class="form-control"
                                placeholder="1 / 100" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="close" class="btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            {{ $classesId ? 'Simpan Perubahan' : 'Simpan' }}
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
                    <h3>Apa anda yakin?</h3>
                    <div class="text-muted">
                        Jika yakin, maka data {{ $name }} tidak akan kembali (hapus permanen)
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
    @push('js')
        <script>
            document.addEventListener("livewire:load", () => {
                let el = $('#selected')
                initSelect()
                Livewire.hook('message.processed', (message, component) => {
                    initSelect()
                })
                el.on('change', function(e) {
                    @this.set('classes.lesson_categories_id', el.select2("val"))
                })

                function initSelect() {
                    el.select2({
                        placeholder: '{{ __('Select your option') }}',
                        allowClear: !el.attr('required'),
                    })
                }
            })
        </script>
        <script>
            const inputNumber = document.getElementById("inputNumber")

            inputNumber.addEventListener("input", function() {
                if (this.value < 0) {
                    this.value = inputNumber;
                } else if (this.value > 100) {
                    this.value = 100;
                }
            })
        </script>
    @endpush
</div>
