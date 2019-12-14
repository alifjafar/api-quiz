@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Akses Token</div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" disabled
                                   value="{{ auth()->user()['api_token'] ?? "Belum ada Akses Token" }}"/>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" onclick="generate()">Generate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const generate = () => {
            axios.post('{{ route('generate.token') }}')
                .then((res) => {
                    window.location.reload();
                }).catch((res) => {
                console.log(res);
            })
        }
    </script>
@endpush
