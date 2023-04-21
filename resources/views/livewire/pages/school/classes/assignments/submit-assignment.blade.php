<div>
    <form wire:submit.prevent="submitTask">
        <div class="mb-3">
            <div class="col-md-12 mb-3">
                <x-input type="text" name="subject_submit" label="Deskripsi Jawaban" required />
            </div>
            <div class="col-md-12 mb-3">
                <x-input type="text" name="assign_url" label="Url" required />
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim jawaban</button>
    </form>
</div>
