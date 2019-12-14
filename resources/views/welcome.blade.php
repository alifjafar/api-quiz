@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-7 text-center">
                <h3><strong>Search and Create Your Quiz</strong></h3>
                <p class="mt-3 h5">
                    Temukan dan buat quiz berdasarkan kategori yang kamu inginkan, berbagi quiz dengan yang lain
                </p>

                <a href="{{ route('register') }}" class="btn btn-primary btn-lg mt-5">Get API Key</a>
            </div>
        </div>
    </div>
@endsection
