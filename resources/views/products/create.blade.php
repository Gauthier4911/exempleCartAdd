@extends('welcome')

@section('body')

    <main class="container mt-3">
        <section class="row d-flex justify-content-center">
            <h3 class="text-center">Créer un article</h3>
            <div class="col-lg-7">
                @session('success')
                <div class="alert alert-success">{{$value}}</div>
                @endsession
                <form  action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Image  Article</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Nom article..." value="{{old('title')}}">
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Image  Article</label>
                        <input type="number" id="price" name="price" step="0.01" class="form-control" placeholder="Prix article..." value="{{old('price')}}">
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image  Article</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Créer</button>
                </form>
            </div>
        </section>
    </main>

@endsection

