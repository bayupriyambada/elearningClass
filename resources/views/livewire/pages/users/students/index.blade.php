@section('pageTitle', 'Data Siswa')
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <h2 class="page-title">
                    Data Siswa
                </h2>

            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('dashboard') }}" title="Kembali" />
                    </span>
                    <span class="d-none d-sm-inline">
                        <a href="#" wire:click.prevent="createForm" class="btn btn-success">Import
                            Siswa</a>
                    </span>
                    <span class="d-none d-sm-inline">
                        <a href="#" wire:click.prevent="createForm" class="btn btn-primary">Tambah
                            Siswa</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="row row-cards mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-yellow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                                </path>
                                <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">
                            Perhatian! Tindakan penghapusan data tidak dapat dikembalikan. Pastikan Anda yakin sebelum
                            menghapus data. Kata sandi baru atau reset adalah <b>password</b></p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="col-auto ms-auto d-print-none">
                                <div class="ms-2 d-inline-block">
                                    <input type="search" wire:model="search" placeholder="Cari username"
                                        class="form-control form-control-sm" aria-label="Cari pengguna">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1">No.
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M6 15l6 -6l6 6"></path>
                                        </svg>
                                    </th>
                                    <th>Panggilan Nama</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Kode Registrasi</th>
                                    <th>Terdaftar</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1 + ($userStudents->currentPage() - 1) * $userStudents->perPage(); ?>
                                @forelse ($userStudents as $item)
                                    <tr>
                                        <td><span class="text-muted">{{ $index++ }}</span></td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->fullname }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->registrationCode }}</td>
                                        <td>
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>
                                        <td class="text-end">
                                            <span class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top"
                                                    data-bs-boundary="viewport" data-bs-toggle="dropdown"
                                                    aria-expanded="false">Aksi</button>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item" href="#"
                                                        wire:click="resetPassword({{ json_encode($item->id) }})">
                                                        Atur Ulang Sandi
                                                    </a>
                                                    <a class="dropdown-item" href="#"
                                                        wire:click="edit({{ json_encode($item->id) }})">
                                                        Ubah
                                                    </a>
                                                    <a class="dropdown-item" href="#"
                                                        wire:click="confirmDelete({{ json_encode($item->id) }})">
                                                        Hapus
                                                    </a>
                                                </div>
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <span class="text-center">Tidak ada data</span>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $userStudents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal create / update --}}
    <div class="modal modal-blur fade show" id="modal" tabindex="-1"
        @if ($showModal) style="display:block" @endif aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $userStudentId ? 'Ubah' : 'Tambah' }} Siswa</h5>
                    <button type="button" wire:click="close" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="mb-3">
                            <x-input type="text" name="userStudent.username" label="Nama panggilan" required />
                        </div>
                        <div class="mb-3">
                            <x-input type="text" name="userStudent.fullname" label="Nama lengkap" required />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label required">Alamat Email</label>
                            <input type="text" id="email" class="form-control" wire:model="userStudent.email" {{$userStudentId? "disabled" : ""}} placeholder="Masukkan alamat email" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="close" class="btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            {{ $userStudentId ? 'Perbaharui' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal create / update --}}

    {{-- modal confirm --}}
    <div class="modal modal-blur @if ($showModalConfirm) fade show @endif" id="modal-danger" tabindex="-1"
        role="dialog" aria-modal="false" @if ($showModalConfirm) style="display:block" @endif>
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" wire:click.prevent="closeConfirm" class="btn-close" data-bs-dismiss="modal"
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
                        {{ $text }}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button type="button" wire:click="closeConfirm" class="btn w-100">Batalkan</button>
                            </div>
                            <div class="col">
                                <a href="#" wire:click.prevent="modalAction" class="btn btn-danger w-100"
                                    data-bs-dismiss="modal">
                                    Ya Lakukan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal confirm --}}
</div>
