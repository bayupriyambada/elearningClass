@section('pageTitle', 'List Pelajaran')
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Tenaga Pendidik: <b>{{ auth()->user()->username }}</b>
                </h2>

            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('school.dashboard') }}" class="btn">
                            Kembali
                        </a>
                    </span>
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('school.classes.create') }}" class="btn btn-primary">
                            Buat Kelas
                        </a>
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
                                <a href="{{route('school.classes.materials.index', [$class->id])}}" class="btn-action" title="Tambah materi {{ $class->name }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                    </svg>
                                </a>
                                <a href="#" class="btn-action" name="ubah {{ $class->name }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                                    <div class="dropdown-menu dropdown-menu-end"
                                        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 38.6667px, 0px);"
                                        data-popper-placement="bottom-end">
                                        <a class="dropdown-item" href="#"
                                            wire:click="deleteData({{ json_encode($class->id) }})">
                                            Hapus {{ $class->name }}
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