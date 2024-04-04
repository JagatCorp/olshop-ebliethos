<form action="{{ Request::url() }}" method="get" class="row">
    {{-- <form action="{{ url()->current() }}" method="get" class="row"> --}}
    <div class="col-lg-3">
        <div class="form-group mb-2">
            <label for="">dari</label>
            <input type="date" class="form-control"
                value="{{ !empty(request()->input('start')) ? request()->input('start') : '' }}" name="start"
                placeholder="from">
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mx-sm-3 mb-2">
            <label for="">sampai</label>
            <input type="date" class="form-control "
                value="{{ !empty(request()->input('end')) ? request()->input('end') : '' }}" name="end"
                placeholder="to">
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mx-sm-3 mb-2">
            <label for="">export</label>
            <select name="export" id="export" class="form-control input-block">
                @foreach ($exports as $value => $export)
                    <option value="{{ $value }}">{{ $export }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group mx-sm-3 mb-2 mt-5 ">
            <button type="submit" class="btn btn-primary">Go</button>
        </div>
    </div>
</form>
