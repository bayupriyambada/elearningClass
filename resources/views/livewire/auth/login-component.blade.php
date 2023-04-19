@section('pageTitle', 'Halaman Akun')
<div>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
        </div>
        <div class="card card-md">
          <div class="card-body">
            <h2 class="h2 text-center mb-4">Masuk dengan akun <b><i>LearnToday</i></b></h2>
            <form wire:submit.prevent="loginHandle" autocomplete="off" novalidate>
              <div class="mb-3">
                <label class="form-label">Alamat Email</label>
                <input type="email" wire:model="email" class="form-control" placeholder="your@email.com" autocomplete="off">
              </div>
              <div class="mb-2">
                <label class="form-label">
                  Kata Sandi
                </label>
                <div class="input-group input-group-flat">
                  <input type="password" wire:model="password" class="form-control"  placeholder="Your password"  autocomplete="off">
                </div>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Masuk CMS</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
</div>
