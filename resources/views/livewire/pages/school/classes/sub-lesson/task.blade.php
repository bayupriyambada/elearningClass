@section('pageTitle', 'Jawaban ' . $subLesson->title)
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <div class="card-body">
                    <ol class="breadcrumb breadcrumb-arrows">
                        <li class="breadcrumb-item"><a href="#">{{ $lesson->lessonCategory->name }}</a></li>
                        <li class="breadcrumb-item active"><a href="#">{{ $subLesson->title }}</a></li>
                    </ol>
                </div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('school.classes.sub.index', [$lesson->id]) }}"
                            title="Kembali" />
                    </span>
                </div>
            </div>
        </div>
        <div class="row row-cards mt-2">
            @forelse ($taskSubmit as $index => $task)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span>{{ $index + 1 }}. <a href="{{ URL($task->url_submit) }}" target="_blank"
                                    class="text-blue">
                                    {{ Str::substr($task->url_submit, 0, 50) . '...' }}</a> -
                                {{ $task->user->username }} [<b>{{ $task->grade ?? 0 }}</b>]</span>
                            <div class="card-actions btn-actions">
                                <a href="#" wire:click="modalTask({{ json_encode($task->id) }})" class="btn"
                                    title="Berikan Nilai">
                                    Berikan Nilai
                                </a>
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
        </div>
    </div>
    {{-- modal input task --}}
    <div class="modal modal-blur fade show" id="modal" tabindex="-1"
        @if ($showModal) style="display:block" @endif aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Berikan nilai</h5>
                    <button type="button" wire:click="close" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="saveTask" autocomplete="off">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="feedback" class="form-label required">Jawaban </label>
                            <input wire:model="urlSubmit" type="text" readonly disabled
                                id="feedback" class="form-control" placeholder="Berikan keterangan tugas">
                        </div>
                        <div class="mb-3">
                            <label for="inputNumber" class="form-label required">Nilai</label>
                            <input type="number" wire:model="taskLesson.grade"
                                onkeydown="if(event.keyCode === 69 || event.keyCode === 190 || event.keyCode === 189 || event.keyCode === 109) return false;"
                                min="1" max="100" id="inputNumber" class="form-control"
                                placeholder="1 / 100" required>
                        </div>
                        <div class="mb-3">
                            <label for="feedback" class="form-label required">Keterangan Nilai</label>
                            <input wire:model="taskLesson.information" type="text" minlength="1" maxlength="255"
                                id="feedback" class="form-control" placeholder="Berikan keterangan tugas" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="close" class="btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            Berikan Nilai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal input task --}}
</div>

@push('js')
    <script>
        const inputNumber = document.getElementById("inputNumber")

        inputNumber.addEventListener("input", function() {
            if (this.value < 1) {
                this.value = inputNumber;
            } else if (this.value > 100) {
                this.value = 100;
            }
        })
    </script>
@endpush
