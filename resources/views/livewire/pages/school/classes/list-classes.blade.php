@section('pageTitle', 'List Pelajaran')
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <h2 class="page-title">
                    Pelajaran Anda
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('school.dashboard') }}" title="Kembali" />
                    </span>
                    <span class="d-none d-sm-inline">
                        <x-href colorButton="btn btn-primary" url="{{ route('school.classes.create') }}"
                            title="Buat Kelas" />
                    </span>
                </div>

            </div>
        </div>
        <div class="row row-cards mt-2">
            @php
                $iteration = ($classesByUser->currentPage() - 1) * $classesByUser->perPage() + 1;
            @endphp
            @forelse ($classesByUser as $class)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $iteration++ }}. {{ $class->name }}</h3>
                            <div class="card-actions btn-actions">
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
                                        <a class="dropdown-item" href="{{ route('school.classes.assignments.index', [$class->id]) }}">
                                            <span>Tambah Tugas <b>[{{$class->assignments_count}}]</b></span>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('school.classes.materials.index', [$class->id]) }}">
                                            <span>Tambah Materi <b>[{{ $class->materials_count }}]</b></span>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('school.classes.edit', [$class->id]) }}">
                                            Ubah
                                        </a>
                                        <a class="dropdown-item" href="#"
                                            wire:click="deleteData({{ json_encode($class->id) }})">
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
            {{ $classesByUser->links() }}
        </div>
    </div>
</div>
