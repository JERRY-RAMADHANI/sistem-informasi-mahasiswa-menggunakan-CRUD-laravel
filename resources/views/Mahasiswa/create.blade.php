@extends('template.main')

@if ($errors->any())
<div class="pt-3">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
</div>    
@endif

@section('container')
<form action='{{ url('mahasiswa') }}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h2>TAMBAH DATA MAHASISWA</h1>
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NPM</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='NPM' id="NPM" value="{{ Session::get("NPM") }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' id="nama" value="{{ Session::get("nama") }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='jurusan' id="jurusan" value="{{ Session::get("jurusan") }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form>
<div class="pb-3">
    <a href='{{ url('mahasiswa') }}' class="btn btn-primary">< KEMBALI</a>
  </div>
@endsection

