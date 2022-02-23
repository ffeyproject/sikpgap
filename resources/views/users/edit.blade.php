@extends('layouts.app')
@section('content')
<div class="bg-light p-4 rounded">
    <h1>Add new user</h1>
    <div class="lead">
        Add new user and assign role.
    </div>

    <div class="container mt-4">
        <form method="post" action="{{ route('users.update', $user->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="{{ $user->name }}" type="text" class="form-control" name="name" placeholder="Name"
                    required>

                @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{ $user->email }}" type="email" class="form-control" name="email"
                    placeholder="Email address" required>
                @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input value="{{ $user->username }}" type="text" class="form-control" name="username"
                    placeholder="Username" required>
                @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Posisi</label>
                @if ($user->posisi == 'marketing')
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="posisi" value="{{ $user->posisi }}"
                                checked>
                            <label class="form-check-label">Marketing</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="posisi" value="qa">
                            <label class="form-check-label">Qa</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="posisi" value="Admin">
                            <label class="form-check-label">Admin</label>
                        </div>
                    </div>
                </div>
                @elseif ($user->posisi == 'qa')
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="posisi" value="marketing">
                            <label class="form-check-label">Marketing</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="posisi" value="{{ $user->posisi }}"
                                checked>
                            <label class="form-check-label">Qa</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="posisi" value="Admin">
                            <label class="form-check-label">Admin</label>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="posisi" value="marketing">
                            <label class="form-check-label">Marketing</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="posisi" value="qa">
                            <label class="form-check-label">Qa</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="posisi" value="{{ $user->posisi }}"
                                checked>
                            <label class="form-check-label">Admin</label>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <table class="table table-striped">
                <thead>
                    <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                    <th scope="col" width="20%">Name</th>
                </thead>

                @foreach($roles as $role)
                <tr>
                    <td>
                        <input type="checkbox" name="role[{{ $role->id }}]" value="{{ $role->id }}" class='role'>
                    </td>
                    <td>{{ $role->name }}</td>
                </tr>
                @endforeach
            </table>

            <button type="submit" class="btn btn-primary">Update user</button>
            <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>
        </form>

    </div>

</div>

@endsection

@section('tablejs')
<script type="text/javascript">
    $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.role'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.role'), function() {
                        $(this).prop('checked',false);
                    });
                }

            });
        });
</script>
@endsection
