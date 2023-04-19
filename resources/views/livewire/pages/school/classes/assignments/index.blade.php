@section('pageTitle', $classesId->name)
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Dibuat oleh: <b>{{ auth()->user()->username }}</b>
                </div>
                <h2 class="page-title">
                    Pelajaran: {{ $classesId->name }}
                </h2>

            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('school.classes.view', [$classesId->id]) }}" class="btn">
                            Kembali
                        </a>
                    </span>
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('school.classes.assignments.create', [$classesId->id]) }}"
                            class="btn btn-primary">
                            Tambah Tugas
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="row row-cards mt-2">
            @php
                $iteration = ($assignments->currentPage() - 1) * $assignments->perPage() + 1;
            @endphp
            @forelse ($assignments as $assignment)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $iteration++ }}. {{ $assignment->title }}
                                <a href="{{ url($assignment->url) }}" class="text-primary" target="_blank">[Lihat
                                    Materi]</a>
                            </h3>
                            <div class="card-actions btn-actions">

                                <a href="#" class="btn-action" title="Lihat {{ $assignment->title }}">
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
                                <a href="{{ route('school.classes.assignments.edit', [$classesId->id, $assignment->id]) }}" class="btn-action" title="ubah {{$assignment->title}}">
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
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M18 6l-12 12"></path>
                                        <path d="M6 6l12 12"></path>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 38.6667px, 0px);" data-popper-placement="bottom-end">
                                  <a class="dropdown-item" href="#" wire:click="deleteData({{json_encode($assignment->id)}})">
                                    Hapus {{$assignment->title}}
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
            {{$assignments->links()}}
        </div>
    </div>
</div>