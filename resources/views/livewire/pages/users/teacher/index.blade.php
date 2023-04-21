@section('pageTitle', 'Data Tenaga Didik')
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <h2 class="page-title">
                    Data Tenaga Didik
                </h2>

            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('dashboard') }}" title="Kembali" />
                    </span>
                    <span class="d-none d-sm-inline">
                        <x-href colorButton="btn btn-primary" url="{{ route('users.teachers.create') }}"
                            title="Tambah Data" />
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
                        <h3 class="card-title">Informasi</h3>
                        <p class="text-muted">Perhatikan! Jika ingin menghapus, maka semua data pada tenaga didik
                            tersebut juga terhapus.</p>
                        <p class="text-muted">Kata sandi (reset): <b>password</b></p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="text-muted">
                                Show
                                <div class="mx-2 d-inline-block">
                                    <input type="number" min="0" wire:model="pagination"
                                        class="form-control form-control-sm" value="8" size="3">
                                </div>
                                entries
                            </div>
                            <div class="ms-auto text-muted">
                                Search:
                                <div class="ms-2 d-inline-block">
                                    <input type="search" wire:model="search" placeholder="Cari username, email"
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
                                @if ($userTeachers->isNotEmpty())
                                    @foreach ($userTeachers as $index => $item)
                                        <tr>
                                            <td><span class="text-muted">{{ $index + 1 }}</span></td>
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
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="resetPassword({{ $item->id }})">
                                                            Reset Kata Sandi
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('users.teachers.edit', $item->id) }}">
                                                            Ubah
                                                        </a>
                                                        <a class="dropdown-item"
                                                            wire:click="deleteData({{ $item->id }})"
                                                            href="javascript:void(0)">
                                                            Hapus
                                                        </a>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">
                                            <span class="text-center">Tidak ada data</span>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        {{ $userTeachers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
