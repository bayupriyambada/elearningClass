<div>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
        </div>
        <div class="card card-md">
          <div class="card-body">
            <h2 class="h2 text-center mb-4">Berikan kode untuk masuk.</h2>
            <form wire:submit.prevent="joinClass" autocomplete="off">
              <div class="mb-3">
                <label class="form-label">Kode</label>
                <input type="text" wire:model="code" class="form-control" placeholder="eg:uhUHsdsad" autocomplete="off">
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Gabung</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
