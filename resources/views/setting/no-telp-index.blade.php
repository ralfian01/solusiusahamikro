@extends('template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 d-flex bd-highlight">
                        <div class="p-2 mr-auto bd-highlight">
                            <h3>Setting - No Telp</h3>
                        </div>
                    </div>
                    <div class="basic-form">
                        <form action="{{ route('setting-no-telp-update') }}" method="POST">
                            {{ csrf_field() }}

                            @foreach (['success', 'warning', 'error', 'info'] as $msg)
                                @if(session($msg))
                                    <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                                        {{ session($msg) }}
                                    </div>
                                @endif
                            @endforeach


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">
                                    <b>No Telp</b>
                                </label>
                                <div class="col-sm-10">
                                    <input required type="text" value="{{ $getNoTelp?->nomor ? $getNoTelp?->nomor : old('nomor') }}" name="nomor" class="form-control">
                                    @error('nomor') <div class="text-danger">{{ $message }}</div> @enderror
                                    <br />
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            value="1"
                                            id="notifikasi"
                                            name="notifikasi"
                                            {{ $getNoTelp && $getNoTelp->notifikasi ? 'checked' : '' }}
                                            >
                                        <label class="form-check-label" for="notifikasi">
                                            Nyalakan Notifikasi?
                                        </label>
                                      </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
