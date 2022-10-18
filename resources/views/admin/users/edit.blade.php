@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{route('admin.users.update', ['user' => $user->id])}}">
            @csrf
            @method('PUT')
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Редактирование пользователя
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>
                                        <label for="name">
                                            Name
                                        </label>
                                    </th>
                                    <th>
                                        <label for="role">
                                            Role
                                        </label>
                                    </th>
                                    <th>
                                        <label for="email">
                                            Email
                                        </label>
                                    </th>
                                    <th>
                                        <label for="avatar">
                                            Avatar
                                        </label>
                                    </th>
                                    <th>Действие</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>
                                        <input type="text" class="form-control" name="name" placeholder="name" id="name"
                                            value="{{$user->name}}">
                                    </td>
                                    <td>
                                        <select class="role_edit" name="role" placeholder="role" id="role">
                                            <option selected="selected">
                                                {{$user->role}}
                                            </option>
                                            <option>admin</option>
                                            <option>user</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="email" class="form-control" name="email" placeholder="email"
                                            id="email" value="{{$user->email}}">
                                    </td>
                                    <td>
                                        <img src="{{$user->avatar}}" alt="slide" height="50px" width="50px">
                                        <input type="url" class="form-control" name='avatar'
                                            placeholder="ссылка на аватарку" id="file">
                                    </td>
                                    <td>
                                        <input class="btn btn-primary" style="float: right" type="submit"
                                            value="Сохранить">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--End Advanced Tables -->
</div>
</div>
@endsection