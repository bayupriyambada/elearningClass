@section('pageTitle', 'Tambah Siswa')
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('users.teachers.index') }}" title="Kembali" />
                    </span>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <form wire:submit.prevent="create" autocomplete="off">
                    <div class="mb-3">
                        <x-input type="text" name="username" label="Nama Panggilan" required />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="fullname" label="Nama Lengkap" required />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="email" label="Email" class="my-class" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
