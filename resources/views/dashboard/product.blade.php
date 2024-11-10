@extends('dashboard.app')
@section('content')
<div class="Container bg-light" style="z-index:-1;">
    @if (session()->has('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="pt-4 px-3">
        <button type="button" class="d-flex mb-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproductModal"><span class="material-symbols-outlined">add</span>Add Product</button>
    </div>
    <div class="modal fade" id="addproductModal" tabindex="-1" aria-labelledby="addproductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addproductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product ID:</label>
                            <input type="text" class="form-control" id="product_id" name="product_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Display Name:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_category" class="form-label">Product category:</label>
                            <select class="form-select" id="product_category" aria-label="Default select example" name="product_category">
                                <option selected>Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id_category}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="product_image" class="form-label">Product Display Image:</label>
                            <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_sub_product" class="form-label">Sub Product ID:</label>
                            <input type="text" class="form-control" id="id_sub_product" name="id_sub_product" required>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="sub_product_name" class="form-label">Sub Product Name:</label>
                            <input type="text" class="form-control" id="sub_product_name" name="sub_product_name" required>
                        </div> --}}
                        <div class="mb-3">
                        <label for="sub_product_name" class="form-label">Sub Product Name:</label>
                            <select class="form-select" id="sub_product_name" aria-label="Default select example" name="sub_product_name">
                                <option selected>Choose Sub Product Name</option>
                                @foreach ($daftar as $name_product)
                                    <option value="{{$name_product->name}}">{{$name_product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sub_product_assets" class="form-label">Sub Product Assets:</label>
                            <input type="file" class="form-control" id="sub_product_assets" name="sub_product_assets" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="sub_product_href" class="form-label">Sub Product Href:</label>
                            <input type="text" class="form-control" id="sub_product_href" name="sub_product_href" required>
                        </div>
                        <div class="mb-3">
                            <label for="sub_product_howto" class="form-label">Sub Product Howto:</label>
                            <textarea class="form-control" id="sub_product_howto" name="sub_product_howto" rows="4" required>Cara Topup {nama game}<br>
        1. Masukkan User ID & Server ID<br>
        2. Pilih Nominal Topup<br>
        3. Pilih Metode Pembayaran<br>
        4. Klik Beli Sekarang & Lakukan Pembayaran<br>
        5. Tunggu Pembayaran Terverifikasi<br>
        6. Lalu Pesanan Masuk Secara Otomatis</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="fill_data_id">fill_data_id</label>
                            <textarea type="text" class="form-control" id="fill_data_id" name="fill_data_id" rows="4" required><input type="text" id="inputfield1" class="form-control mb-3" name="userid" placeholder="User ID" required><br><input type="text" id="inputfield2" class="form-control" name="server" placeholder="Server ID"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="sub_product_checkign_on" name="sub_product_checkign_on">
                            <label class="form-check-label" for="sub_product_checkign_on">Checkign On?</label>
                        </div>
                        <div class="d-none mb-3" id="sub_product_checkign">
                            <label for="sub_product_checkign" class="form-label">Checkign:</label>
                            <input type="text" class="form-control" id="sub_product_checkign" name="sub_product_checkign">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="table-responsive px-3 rounded">
        <table class="table table-striped shadow">
            <thead>
                <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">name</th>
                    <th scope="col">src</th>
                    <th scope="col">action 1</th>
                    <th scope="col">action 2</th>
                </tr>
            </thead>
            @foreach ( $product as $products)
                <tbody>
                    <tr>
                        <td>{{$products->product->product_id}}</td>
                        <td>{{$products->product->name}}</td>
                        <td>{{$products->product->src}}</td>
                        <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#{{$products->id_sub_product}}Modal">Update</button></td>
                        <form action="{{route('delete',['product_id'=>$products->product->product_id])}}" method="POST">
                            @csrf
                            <td><button type="submit" class="btn btn-danger">Delete</button></td>
                        </form>
                    </tr>
                </tbody>
                <div class="modal fade" id="{{$products->id_sub_product}}Modal" tabindex="-1" aria-labelledby="{{$products->id_sub_product}}Modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="{{$products->id_sub_product}}Modal">Update Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3 d-none">
                                        <label for="product_id" class="form-label">Product ID:</label>
                                        <input type="text" class="form-control" id="product_id" name="product_id" value="{{$products->product->product_id}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="product_name" class="form-label">Product Display Name:</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{$products->product->name}}">
                                    </div>
                                    {{-- <div class="mb-3 d-none">
                                        <label for="product_categori" class="form-label">Product category:</label>
                                        <input type="text" class="form-control" id="product_categori" name="product_category" value="{{$products->product->id_category}}">
                                    </div> --}}
                                    <div class="mb-3">
                                    <label for="product_categori" class="form-label">Product category:</label>
                                        <select class="form-select" id="product_categori" aria-label="Default select example" name="product_category">
                                            <option selected value="{{$products->product->id_category}}">{{$products->product->category->name}}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id_category}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="product_image" class="form-label">Product Display Image:</label>
                                        <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*">
                                    </div>
                                    <div class="mb-3 d-none">
                                        <label for="id_sub_product" class="form-label">Sub Product ID:</label>
                                        <input type="text" class="form-control" id="id_sub_product" name="id_sub_product" value="{{$products->id_sub_product}}">
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="sub_product_name" class="form-label">Sub Product Name:</label>
                                        <input type="text" class="form-control" id="sub_product_name" name="sub_product_name" value="{{$products->name}}">
                                    </div> --}}
                                    <div class="mb-3">
                                    <label for="sub_product_name" class="form-label">Sub Product Name:</label>
                                        <select class="form-select" id="sub_product_name" aria-label="Default select example" name="sub_product_name">
                                            <option selected value="{{$products->name}}">{{$products->name}}</option>
                                            @foreach ($daftar as $name_product)
                                                <option value="{{$name_product->name}}">{{$name_product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sub_product_assets" class="form-label">Sub Product Assets:</label>
                                        <input type="file" class="form-control" id="sub_product_assets" name="sub_product_assets" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="sub_product_href" class="form-label">Sub Product Href:</label>
                                        <input type="text" class="form-control" id="sub_product_href" name="sub_product_href" value="{{$products->href}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="sub_product_howto" class="form-label">Sub Product Howto:</label>
                                        <textarea class="form-control" id="sub_product_howto" name="sub_product_howto" rows="4">{{$products->howto}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="a{{$products->id_sub_product}}">fill_data_id</label>
                                        <textarea type="text" class="form-control" id="a{{$products->id_sub_product}}" name="fill_data_id" rows="4">{{$products->fill_data_id}}</textarea>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="b{{$products->id_sub_product}}" name="sub_product_checkign_on" {{ $products->checkign_on ? 'checked' : '' }}>
                                        <label class="form-check-label" for="b{{$products->id_sub_product}}">Checkign On?</label>
                                    </div>
                                    <div class="d-none mb-3" id="c{{$products->id_sub_product}}">
                                        <label for="sub_product_checkign" class="form-label">Checkign:</label>
                                        <input type="text" class="form-control" name="sub_product_checkign" value="{{$products->checkign}}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </table>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkign_on = document.getElementById('sub_product_checkign_on');
        var checkign = document.getElementById('sub_product_checkign');

        checkign_on.addEventListener('change', function() {
            if (checkign_on.checked) {
                checkign.classList.remove('d-none');
            } else {
                checkign.classList.add('d-none');
            }
        });

        // Inisialisasi status awal
        if (checkign_on.checked) {
            checkign.classList.remove('d-none');
        } else {
            checkign.classList.add('d-none');
        }
    });
</script>
@foreach ( $product as $products)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var sub_checkign_on = document.getElementById('b{{$products->id_sub_product}}');
        var sub_checkign = document.getElementById('c{{$products->id_sub_product}}');

        sub_checkign_on.addEventListener('change', function() {
            if (sub_checkign_on.checked) {
                sub_checkign.classList.remove('d-none');
            } else {
                sub_checkign.classList.add('d-none');
            }
        });
        if (sub_checkign_on.checked) {
            sub_checkign.classList.remove('d-none');
        } else {
            sub_checkign.classList.add('d-none');
        }
    });
</script>
@endforeach
@endsection