@extends('layouts.app')

@section('content')
    <a href="{{route('admin.notifications.read.all')}}" class="btn btn-lg btn-success mb-3 mt-3">Marcar todas como
        lidas</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Notificação</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($unreadNotifications as $notification)
            <tr>
                <td>{{$notification->data['message']}}</td>
                <td>{{$notification->created_at->locale('pt')->diffForHumans()}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('admin.notifications.read', ['notification' => $notification->id])}}"
                           class="btn btn-sm btn-primary rounded">Marcar como lida</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(!$unreadNotifications->count())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    Nenhuma notificação encontrada!
                </div>
            </div>
        </div>
    @endif
@endsection
