     @extends('layouts.admin-template')
     @section('content')
     <div class="box-header with-border">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible" style="margin: 8px;">
                <button type="button" class="close" data-dismiss="alert"  aria-hidden="true">&times;</button>
                <i class="icon fa fa-check"></i> Success! &nbsp;
                {{ session('status') }}
            </div>
        @endif
        </div>
        <div class="container-fluid">
            <div class="header">
                <h4>Tambahkan Produk</h4>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="card-body">
        <form role="form" method="post" action="{{ route('product.store')  }}" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}" autofocus required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="{{ old('price') }}" autofocus required>
                </div>

                {{-- <div class="form-group">
                    <label>Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Enter stock" value="{{ old('stock') }}" autofocus required>
                </div> --}}

                <div class="form-group">
                    <label>Stok</label>
                    <select name="stoks" class="form-control">
                        <option value="1">Ada</option>
                        <option value="0">Habis</option>
                    </select>
                </div>


                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="Enter image" value="{{ old('image') }}"  required>
                </div>

                <div class="submit" style="float: right;">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
            <a href="{{ route('product.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection