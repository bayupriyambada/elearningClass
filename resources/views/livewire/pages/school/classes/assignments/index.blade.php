@section('pageTitle', $classesId->name)
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <div class="page-pretitle">
                    Dibuat oleh: <b>{{ auth()->user()->username }}</b>
                </div>
                <h2 class="page-title">
                    Pelajaran: {{ $classesId->name }} | Tugas
                </h2>

            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        @if (auth()->user()->role_id === 2 || auth()->user()->role_id === 1)
                            <x-href colorButton="btn" url="{{ route('school.classes.list') }}" title="Kembali" />
                        @else
                            <x-href colorButton="btn" url="{{ route('school.classes.view', [$classesId->id]) }}"
                                title="Kembali" />
                        @endif
                    </span>
                    <span class="d-none d-sm-inline">
                        @if (auth()->user()->role_id != 3 && auth()->user()->role_id !== 1)
                            <x-href colorButton="btn"
                                url="{{ route('school.classes.assignments.create', [$classesId->id]) }}"
                                title="Tambah Tugas" />
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <div class="row row-cards mt-2">
            {{-- @php
                $iteration = ($assignments->currentPage() - 1) * $assignments->perPage() + 1;
            @endphp --}}
            @forelse ($assignments as $assignment)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $loop->iteration }}. {{ $assignment->title }}
                                <a href="{{ url($assignment->url) }}" class="text-primary" target="_blank">[Lihat
                                    Materi]</a>
                                <br>
                            </h3>
                            <div class="card-actions btn-actions">
                                <a data-bs-toggle="modal"
                                    wire:click="userSubmission({{ json_encode($assignment->id) }})"
                                    data-bs-target="#modal-scrollable" href="#" class="btn-action"
                                    title="Mengumpulkan {{ $assignment->title }}">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-user-check" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                        <path d="M15 19l2 2l4 -4"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('school.classes.assignments.view', [$classesId->id, $assignment->id]) }}"
                                    class="btn-action" title="Lihat {{ $assignment->title }}">
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
                                @if (auth()->check() && auth()->user()->id === $assignment->user_id)
                                    <a href="{{ route('school.classes.assignments.edit', [$classesId->id, $assignment->id]) }}"
                                        class="btn-action" title="ubah {{ $assignment->title }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                            </path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn-action" data-bs-toggle="dropdown" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M18 6l-12 12"></path>
                                                <path d="M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 38.6667px, 0px);"
                                            data-popper-placement="bottom-end">
                                            <a class="dropdown-item" href="#"
                                                wire:click="deleteData({{ json_encode($assignment->id) }})">
                                                Hapus {{ $assignment->title }}
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
            @if ($showLoadMoreButton)
            <div>
                <button wire:click="loadAssign" type="button" class="btn btn-primary">Buka {{$amount}} data...</button>
            </div>
            @endif
        </div>
    </div>
    <div wire:ignore.self class="modal modal-blur fade" id="modal-scrollable" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Telah mengumpulkan Tugas </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-cards">
                        @if ($submitted && $submitted->submitAssignment)
                            @forelse ( $submitted->submitAssignment as $submit )
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <p class="card-title">
                                                {{ $submit->user->username }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <p class="card-title">
                                                Belum ada yang mengumpulkan
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    {{-- <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('deleteData', id => {
                console.log(`Deleting assign with id ${id}`);
            });
        });
    </script> --}}
@endpush
