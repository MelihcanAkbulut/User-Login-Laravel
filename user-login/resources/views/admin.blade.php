@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="stati turquoise">
                    <i class="fas fa-signal"></i>
                    <div>
                        <b>{{ $total_users }}</b>
                        <span>Onaylanmayan Mail Sayısı</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stati turquoise">
                    <i class="far fa-eye-slash"></i>
                    <div>
                        <b>{{ $today_registered }}</b>
                        <span>Günlük Başarılı Kayıt</span>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered data-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Last Seen</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                    </td>
                    <td>
                        @if(Cache::has('user-is-online-'.$user->id))
                            <span class="text-success">Online</span>
                        @else
                            <span class="text-secondary">Offline</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
