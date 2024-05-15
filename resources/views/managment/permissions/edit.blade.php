@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header bg-dark">
        <h5 class="text-light">Update Role</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('permissions.update',$permission->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value ="{{ old('name', $permission->name ?? null) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="display_name">Display Name</label>
                        <input type="text" class="form-control" name="display_name" value ="{{ old('display_name', $permission->display_name ?? null) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" value ="{{ old('description', $permission->description ?? null)  }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
