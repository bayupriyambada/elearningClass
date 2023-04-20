@section('pageTitle', 'Ubah siswa' )
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('users.teachers.index') }}" class="btn">
                            Kembali
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <form wire:submit.prevent="update" autocomplete="off">
                    <div class="mb-3">
                        <x-input type="text" name="username" label="Nama Panggilan" required />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="fullname" label="Nama Lengkap" required />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="email" label="Email" readonly disabled />
                    </div>
                    <button type="submit" class="btn btn-primary">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>
</div>
