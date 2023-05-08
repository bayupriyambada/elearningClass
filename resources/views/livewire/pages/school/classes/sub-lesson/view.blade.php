@section('pageTitle', 'Pelajaran ' . $lesson->lessonCategory->name . ' | Sub: ' . $subLesson->title)

<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <h2 class="page-title">
                    Pelajaran : {{ $lesson->lessonCategory->name }} | Sub: {{ $subLesson->title }}
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('school.classes.sub.list', [$lesson->id]) }}"
                            title="Kembali" />
                    </span>
                </div>

            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-lg-10 col-xl-9">
                <div class="row row-cards mt-2">
                    <div class="card">
                        <div class="card-body">
                            <h2>Pelajaran : {{ $lesson->lessonCategory->name }} | Sub: {{ $subLesson->title }}</h2>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <span>Status: <b>{{$subLesson->isStatus}}</b> | Dibuat oleh: <b>{{ $subLesson->user->username }}</b></span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            {!! $subLesson->content !!}
                        </div>
                    </div>
                    @if ($subLesson->isOpen === 1)
                        @if ($subLesson->isStatus === 'task')
                            <div class="card">
                                <div class="card-body">
                                    <form wire:submit.prevent="submitTask">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="submitTask" class="form-label required">Formulir Tugas</label>
                                                <input id="submitTask" class="form-control" type="text"
                                                    wire:model="submitTask.url_submit" {{ $readOnly ? 'disabled' : '' }}
                                                    placeholder="Tambahkan jawaban anda" />
                                                @error('submitTask.url_submit')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary ms-auto"
                                                {{ $readOnly ? 'hidden' : '' }}>
                                                {{ $buttonLabel }}
                                            </button>
                                            @if ($readOnly)
                                                <button type="button" class="btn btn-secondary"
                                                    wire:click="enabledEditForm">Ubah</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
