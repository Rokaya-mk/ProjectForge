@extends('layouts.master')
@section('content')
    @if (session()->has('status'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <h1>Roles</h1>
        </div>
        <div class="col-md-6">
            <a href="{{ route('roles.create') }}" class="btn btn-success mt-2 float-right">Create New Role</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            @canany(['roles-update', 'roles-delete'])
                                <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->display_name}}</td>
                                <td>{{$role->description}}</td>
                                <td>
                                    @can('roles-update')
                                    <div class="d-inline-block">
                                        <a href="{{ route('roles.edit', ['role' => $role->id]) }}"
                                            class="btn btn-success mr-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    @endcan 
                                    @can('roles-delete') 
                                    <form method="POST" class="d-inline-block"
                                        action="{{ route('roles.destroy', ['role' => $role->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="form-group">
                                            <button class="btn btn-danger mr-2">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
