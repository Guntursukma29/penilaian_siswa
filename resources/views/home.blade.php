@extends('layouts.template')

@section('content')
    <div class="container">
        <!-- Dashboard -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header">
                        <h5 class="mb-0">Dashboard</h5>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success mb-3" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p class="mb-0">Selamat datang, <strong>{{ Auth::user()->name }}</strong>. Anda berhasil login!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <img src="{{ asset('assets/img/kaiadmin/logo.jpg') }}" class="img-fluid w-100" alt="">

            </div>
        </div>

    </div>
@endsection
