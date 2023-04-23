@section('pageTitle', 'Gabung Pelajaran')
<div>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Berikan kode untuk masuk.</h2>
                    <form wire:submit.prevent="joinClass" autocomplete="off">
                        <div class="col-md-12 mb-3">
                            <x-input type="text" name="code" label="Kode Kelas" required />
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Gabung Kelas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
