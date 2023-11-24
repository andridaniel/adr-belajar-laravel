
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
                    @if ($errors->has('namaproduct'))
                        <span class="text-danger">{{ $errors->first('namaproduct') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="kategoriproduct">Kategori Product</label>
                    <select name="kategoriproduct" class="form-control" id="kategoriproduct">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('kategoriproduct'))
                        <span class="text-danger">{{ $errors->first('kategoriproduct') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="kodeproduct">Kode Product</label>
                    <input type="text" name="kodeproduct" class="form-control" id="kodeproduct" placeholder="Kode Product">
                    @if ($errors->has('kodeproduct'))
                        <span class="text-danger">{{ $errors->first('kodeproduct') }}</span>
                     @endif
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" cols="10"></textarea>
                    @if ($errors->has('deskripsi'))
                        <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga">
                    @if ($errors->has('harga'))
                        <span class="text-danger">{{ $errors->first('harga') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" class="form-control" id="stock" placeholder="Stock">
                    @if ($errors->has('stock'))
                        <span class="text-danger">{{ $errors->first('stock') }}</span>
                    @endif
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
