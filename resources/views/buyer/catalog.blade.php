@section('title')
    Catalog
@endsection
@extends('layouts.app')
@push('styles')
    @vite('resources/css/buyer/catalog.css')
@endpush


@section('content')
    <div class="container-catalog">
        <h4 class="text-white fw-semibold">Browse by Category</h4>
        <div class="d-flex justify-content-between wrap-category">
            <a href="" class="col category-content">
                <img src="assets/category1.png" class="category-img" alt="">
                <p class="d-inline">Realism</p>
            </a>
            <a href="" class="col category-content">
                <img src="assets/category2.png" class="category-img" alt="">
                <p class="d-inline">Photorealism</p>
            </a>
            <a href="" class="col category-content">
                <img src="assets/category3.png" class="category-img" alt="">
                <p class="d-inline">Expressionism</p>
            </a>
            <a href="" class="col category-content">
                <img src="assets/category4.png" class="category-img" alt="">
                <p class="d-inline">Impressionism</p>
            </a>
            <a href="" class="col category-content">
                <img src="assets/category5.png" class="category-img" alt="">
                <p class="d-inline">Abstract</p>
            </a>
            <a href="" class="col category-content">
                <img src="assets/category6.png" class="category-img" alt="">
                <p class="d-inline">Surrealism</p>
            </a>
            <a href="" class="col category-content">
                <img src="assets/category7.png" class="category-img" alt="">
                <p class="d-inline">Pop Art</p>
            </a>
        </div>
        <div class="header-artworks">
            <h4 class="text-white fw-semibold mb-3">All Artworks</h4>
            <p>1.250.289 Artworks:</p>
        </div>
    </div>
@endsection


@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
@endpush
