@section('pageTitle', 'Dasbor ' . auth()->user()->username)

<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <h2 class="page-title">
                    Dasbor Anda
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @if (auth()->user()->role_id != 3 && auth()->user()->role_id !== 1)
                        <span class="d-none d-sm-inline">
                            <x-href colorButton="btn btn-yellow" url="{{ route('school.classes.index') }}"
                                title="Semua kelas anda" />
                        </span>
                    @endif
                    <a href="#" wire:click.prevent="createForm" class="btn btn-primary">Gabung Kelas</a>
                </div>
            </div>
        </div>

        {{-- card --}}
        <div class="row row-cards mt-3">
            @foreach ($classes as $class)
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body p-4 text-center">
                            <span class="avatar avatar-xl mb-3 rounded"
                                style="background-image: url('https://ui-avatars.com/api/?name={{ $class->name }}')"></span>
                            <h3 class="m-0 mb-1"><a href="#">{{ $class->name }}</a></h3>
                            <div class="text-muted">Kode: <b class="text-danger">{{ $class->code }}</b></div>
                            <div class="mt-3">
                                <span class="badge bg-green-lt">{{ $class->user->username }}</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <x-href colorButton="card-btn" url="#"
                                title="{{ $class->materials_count }} Materi" />
                            <x-href colorButton="card-btn" url="#"
                                title="{{ $class->assignments_count }} Tugas" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- modal join lesson --}}
    <div class="modal modal-blur fade show" id="modal" tabindex="-1"
        @if ($showModal) style="display:block" @endif aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gabung Kelas</h5>
                    <button type="button" wire:click="close" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="joinLesson">
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <input type="text" wire:model="passcode" minlength="0" maxlength="10" class="form-control required" placeholder="Masukkan kode akses">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="close" class="btn" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            Gabung Kelas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal join lesson --}}
</div>
