@section('pageTitle', $classesId->name)
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Dibuat oleh: <b>{{ $classesId->user->username }}</b>
                </div>
                <h2 class="page-title">
                    Pelajaran: {{ $classesId->name }} | Materi
                </h2>
            </div>
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
                    @if (auth()->user()->role_id != 3 && auth()->user()->role_id !== 1)
                        <span class="d-none d-sm-inline">
                            <x-href colorButton="btn btn-primary"
                                url="{{ route('school.classes.materials.create', [$classesId->id]) }}"
                                title="Tambah Materi" />
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row row-cards mt-2">

            @forelse ($materials as $material)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $loop->iteration }}. {{ $material->title }}
                                <a href="{{ url($material->url) }}" class="text-primary" target="_blank">[Lihat
                                    Materi]</a>
                            </h3>
                            <div class="card-actions btn-actions">
                                <a href="{{ route('school.classes.materials.view', [$classesId->id, $material->id]) }}"
                                    class="btn-action" title="Lihat {{ $material->title }}">
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

                                        @if (auth()->check() && auth()->user()->id === $material->user_id)
                                            <a class="dropdown-item"
                                                href="{{ route('school.classes.materials.edit', [$classesId->id, $material->id]) }}">
                                                Ubah
                                            </a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="deleteData({{ json_encode($material->id) }})">
                                                Hapus
                                            </a>
                                        @endif

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
            @if ($showLoadMoreButton)
                <div>
                    <button wire:click="loadData" type="button" class="btn btn-primary">Buka {{ $amount }}
                        data...</button>
                </div>
            @endif
        </div>
    </div>
</div>
