@extends('template.main')

@section('container')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3>SELAMAT DATANG DI PROJEK PERTAMA SAYA</h2>
    <a href='{{ url('mahasiswa') }}' class="btn btn-primary mt-5">> LANJUT</a>
</div>
@endsection