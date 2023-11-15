
@extends('layouts.main')  <!-- Assuming you have a master layout -->

@section('konten')
<div class="col-md-6 mt-5 mx-auto">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">CREATE PRODUCT</h3>
        </div>

        <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="namaproduct">Nama Products</label>
                    <input type="text" name="namaproduct" class="form-control" id="namaproduct" placeholder="Nama Product">
                </div>

                <div class="form-group">
                    <label for="kategoriproduct">Kategori Product</label>
                    <select name="kategoriproduct" class="form-control" id="kategoriproduct">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="kodeproduct">Kode Product</label>
                    <input type="text" name="kodeproduct" class="form-control" id="kodeproduct" placeholder="Kode Product">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" cols="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga">
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" class="form-control" id="stock" placeholder="Stock">
                </div>

                <div class="form-group">
                    <label for="gambar">Images</label><br>
                    <input type="file" name="gambar[]" id="gambar" multiple><br>
                </div>
            </div>

            <div class="card-footer mt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('products') }}" class="btn btn-primary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
