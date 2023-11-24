@extends('layouts.main')

@section('konten')

    <div class="container mt-5">
        <h2>Update Product</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="namaproduct">Product Name</label>
                <input type="text" name="namaproduct" class="form-control" required value="{{ old('namaproduct', $product->product_name) }}">
                @if ($errors->has('namaproduct'))
                        <span class="text-danger">{{ $errors->first('namaproduct') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="kategoriproduct">Product Category</label>
                <select name="kategoriproduct" class="form-control" required>
                    <option value="" disabled>Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('kategoriproduct', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('kategoriproduct'))
                        <span class="text-danger">{{ $errors->first('kategoriproduct') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="kodeproduct">Product Code</label>
                <input type="text" name="kodeproduct" class="form-control" required value="{{ old('kodeproduct', $product->product_code) }}">
                @if ($errors->has('kodeproduct'))
                    <span class="text-danger">{{ $errors->first('kodeproduct') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="deskripsi">Description</label>
                <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $product->description) }}</textarea>
                @if ($errors->has('deskripsi'))
                    <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="harga">Price</label>
                <input type="text" name="harga" class="form-control" required value="{{ old('harga', $product->price) }}">
                @if ($errors->has('harga'))
                    <span class="text-danger">{{ $errors->first('harga') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" class="form-control" required value="{{ old('stock', $product->stock) }}">
                @if ($errors->has('stock'))
                    <span class="text-danger">{{ $errors->first('stock') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="gambar">Images</label><br>

                @if(!empty($product->image))
                <p>Existing Images:</p>
                @foreach(json_decode($product->image) as $image)
                <img src="{{ asset('uploads/' . $image) }}" width="70" alt="existing-image"><br>
                @endforeach
                @endif

                <input type="file" name="gambar[]" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>

        <!-- Additional Bootstrap or other JS libraries -->

    </div>

@endsection