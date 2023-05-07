@section('pageTitle', auth()->user()->username)
<div>
    <div class="container-xl">
        <div class="row row-cards mt-2">
            <h2>Data diri: {{auth()->user()->username}}</h2>
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="updateProfile">
                        <div class="row g-3">
                          <div class="col-md-4">
                            <x-input type="text" name="username" label="Nama Panggilan" required disabled/>
                          </div>
                          <div class="col-md-4">
                            <x-input type="text" name="fullname" label="Nama Lengkap" required />
                          </div>
                          <div class="col-md-4">
                            <x-input type="text" name="email" label="Email" readonly disabled />
                          </div>
                          <div class="col-md-12">
                            <x-input type="text" name="registrationCode" label="Kode Registrasi" required readonly disabled />
                          </div>
                          <div class="col-md-6">
                            <x-input type="text" name="address" label="Alamat Tinggal"  />
                          </div>
                          <div class="col-md-6">
                            <x-input type="number" name="phone" label="Nomor Handphone (opsional)" />
                          </div>
                          <div class="col-md-12">
                            <x-input type="password" name="password" label="Kata sandi" />
                          </div>
                          <button type="submit" class="btn btn-primary">Perbaharui Data Diri</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
