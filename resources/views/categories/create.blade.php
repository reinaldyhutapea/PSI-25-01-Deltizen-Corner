@extends('layouts.admin-template')
@section('content')
<div class="row">
<div class="container-fluid">
    <div class="card shadow mb-4" style="margin: 10px;">
        <div class="card-header ">
            <h3 style="font-weight: 700;font-size: 20px;">{{ $title }}</h3>
        </div>
        @if(session('status'))
        <div class="box-header">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-check"></i> Success! &nbsp;
                {{ session('status') }}
            </div>
        </div>
@endif
        <form role="form" method="post" action="{{ route('category.store')  }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}" autofocus required>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" style="background-color: blue">Submit</button>
            </div>
        </form>
    </div>
 
</div>
</div>
@endsection