    @extends('layouts.admin-template')
    @section('content')
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Local CSS -->
          <link href="{{ asset('/css/product.css') }}" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
        <title>Hello, world!</title>
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/f4cf3b69a5.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:ital,wght@0,500;0,700;1,600;1,700&family=Roboto:wght@100;400;500;700;900&family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:ital,wght@0,500;0,700;1,600;1,700&family=Roboto:wght@100;400;500;700;900&family=Sora:wght@300;400;500;600;700&family=Ubuntu&display=swap" rel="stylesheet"></head>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&family=Montserrat:ital,wght@0,500;0,700;1,600;1,700&family=Roboto:wght@100;400;500;700;900&family=Sora:wght@300;400;500;600;700&family=Ubuntu&display=swap" rel="stylesheet">
    <body>
        <div class="container-fluid">
            <div class="none-mobile-ui">
            <div class="card shadow mb-4" >
                <div class="card-header">
                    <h4 style="font-weight: 700">Daftar Produk</h4>
                   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float: right;">
                        <i class="fa-solid fa-plus"></i> Tambah Produk
                    </button>            
                </div>
            <div class="card-body">
                {{-- <div style="overflow: auto;" > --}}
            <table class="table table-bordered" id="product-table" width=100%>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        {{-- </div> --}}
        </div>
        </div>
         </div>
{{-- 
         /* perlu dirubah dari bawah ini */ --}}
        {{-- start mobile-ui --}}
        <div class="mobile-ui">
            <div class="card shadow mb-4" >
                <div class="card-header">
                    <h4 style="font-weight: 700">Daftar Produk</h4>
                   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float: right;">
                        <i class="fa-solid fa-plus"></i> 
                    </button>            
                </div>
            <div class="card-body">
                <div style="overflow: auto;" >
            <table class="table"  id="product-table2" width="100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th ></th>
                </thead>
            </table>
        </div>
        </div>
        </div>


        {{-- end of mobile-ui --}}
        </div>


        {{-- end of container-fluid --}}
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        -->

       
        <!-- Modal Create Product -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
         
                         </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
            </div>
            </div>
        </div>





        <script>
            $(function() {
                $('#product-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! url("/product/data") !!}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'id', name: 'products.id' },
                        { data: 'pname', name: 'products.name' },
                        { data: 'cname', name: 'categories.name' },
                        { data: 'price', name: 'products.price' },
                        { data: 'stoks', name: 'products.stoks' },
                        { data: 'image', name: 'products.image'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                });
            });

            $(function() {
                $('#product-table2').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! url("/product/data") !!}',
                    columns: [
                        { data: 'pname', name: 'products.name' },
                        { data: 'cname', name: 'categories.name' },
                        { data: 'price', name: 'products.price' },
                        { data: 'stoks', name: 'products.stoks' },
                 
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                });
            });

            // Modal
            var myModal = document.getElementById('myModal')
                var myInput = document.getElementById('myInput')

                myModal.addEventListener('shown.bs.modal', function () {
                myInput.focus()
                })

            </script>
    </body>

    {{-- @extends('layouts.admin-template')
    @section('content')
    <head>
    <link href="{{ asset('/css/product.css') }}" rel="stylesheet">
    </head>
        <div class="container-fluid">
            <div class="row">   
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                <div class="box">
                    <div class="box-header">
                        <h1 class="text-3xl font-bold">Daftar Menu</h1>
                        <a href="{{ route('product.create') }}" class="btn btn-primary">Tambah Menu</a>
                    </div>
                    <table class="table" id="table_id">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Image</th>
                                    <th width="250px"></th>
                                </tr>
                            </thead>
                            @foreach($products as $product)
                            <tbody>
                        
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>Rp. {{ number_format($product->price,0) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td><img class="rounded-square" width="50" height="50" src="{{ url($product->image) }}" alt=""></td>
                                <td>
                                    <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('product.detail', ['id' => $product->id]) }}" class="btn btn-info">Detail</a>
                                    <form action="{{ route('product.destroy', ['id' => $product->id]) }}" onsubmit="return confirm('Delete this posts permanently ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tbody>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div> --}}
        
        @endsection