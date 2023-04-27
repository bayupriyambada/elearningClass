@section('pageTitle', 'Halaman Akun')
<div>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Masuk dengan akun <b>CMS Belajar</b></h2>
                    <form wire:submit.prevent="loginHandle" autocomplete="off" novalidate>
                        <div class="mb-3">
                            <x-input type="email" name="email" label="Alamat Email" required />
                        </div>
                        <div class="mb-2">
                            <x-input type="password" name="password" label="Kata Sandi" required />
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Masuk CMS</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
