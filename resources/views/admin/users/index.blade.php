@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">

        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Список пользователей
                <a href="{{route('admin.users.create')}}" class="btn btn-4"><i
                        class="fa fa-plus fa-sm text-white-50"></i> Добавить пользавателя</a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Avatar</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usersList as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->role}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <img src="{{$user->avatar}}" alt="slide" height="60px" width="120px" />
                                </td>
                                <td>
                                    <div>
                                        <a href="{{route('admin.users.edit', ['user'=>$user->id])}}"
                                            class="btn btn-7">Ред.
                                        </a>

                                        <form class="btn"
                                            action="{{ route('admin.users.destroy', ['user'=>$user->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Уд." class="btn btn-danger">
                                        </form>

                                    </div>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Пользователей нет</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
@endsection