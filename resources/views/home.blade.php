@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Account Info</div>

                    <div class="card-body">
                        <form action="{{ route('profile.update', $user) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="email">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" required
                                       value="{{ $user['name'] }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required
                                       value="{{ $user['email'] }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <br>
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                        data-target="#changePassword" id="password">Change Password
                                </button>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary float-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Akses Token</div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" disabled
                                   value="{{ $user['api_token'] ?? "Belum ada Akses Token" }}"/>
                            <small class="text-muted">Double click to select all</small>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" onclick="generate()">Generate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="changePassword">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('change.password', $user) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="current-password">Current
                                Password</label>

                            <input id="current_password" type="password"
                                   class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                                   name="current_password" required>
                            @if ($errors->has('current_password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="new-password">New Password</label>

                            <input id="new_password" type="password"
                                   class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}"
                                   name="new_password"
                                   required>
                            @if ($errors->has('new_password'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('new_password') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="confirmation_password">Confirm
                                Password</label>

                            <input id="confirmation_password" type="password"
                                   class="form-control{{ $errors->has('confirmation_password') ? ' is-invalid' : '' }}"
                                   name="confirmation_password" required>
                            @if ($errors->has('confirmation_password'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('confirmation_password') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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
        };

        $(document).ready(function () {
            @if(session('openModal'))
                $('#changePassword').modal('show');
            @endif
        });
    </script>
@endpush
