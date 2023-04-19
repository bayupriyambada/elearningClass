<div>
    {{-- @dump($date --}}
    @foreach ($date as $item)
        <div class="row row-cards mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{$loop->iteration}}. {{$item}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
