@extends('layouts.admin-template')
@section('content')
<div class="row">
<div class="container-fluid">
    <div class="card shadow mb-4"  style="margin: 10px;">
        <div class="card-header">
            <h3 style="font-weight: 700;font-size: 20px;">{{ $title }}</h3>
        </div>

        <div class="box-header with-border">
            @if(session('status'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-check"></i> Success! &nbsp;
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <form  method="post" action="{{ route('category.update', ['id' => $category->id])  }}" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ $category->name }}" autofocus required>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" style="background-color: blue;">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection