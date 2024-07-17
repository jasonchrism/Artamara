@section('title')
    Artist
@endsection
@extends('layouts.app')
@push('styles')
    @vite('resources/css/buyer/catalog.css')
@endpush


@section('content')
    <div class="container-catalog">
        <h4 class="text-white fw-semibold">Top Artists</h4>
        <div class="top-artist mb-5">
            @foreach ($topArtists as $top)         
            <a href="" class="wrap-top">
                <img src="{{$top->profile_picture == '-' ? 'https://via.placeholder.com/800x600' : Storage::url($top->profile_picture)}}" alt="profile" class="object-fit-cover" style="width: 205px; height:205px">
                <p class="">{{$top->name}}</p>
            </a>
            @endforeach
        </div>
        <div class="header-artworks">
            <h4 class="text-white fw-semibold mb-3">All Artists</h4>
            <p class="mb-3">{{ number_format($count, 0, ',', '.') }} Artist:</p>
        </div>
        <div class="content">
            <div class="wrap-content">
                @foreach ($artists as $artist)
                    <a href="" class="card-content p-3">
                        <div class="d-flex">
                            <img src="assets/art2.jpg" alt="" class="object-fit-cover"
                                style="width: 110px; height:110px">
                            <div class="right-content ms-2 pt-3">
                                <h4 class="text-white mb-0 artist-name">{{$artist->name}}</h4>
                                <p class="artist-desc text-truncate-multiline">{{$artist->about}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        {{-- {{ $products->onEachSide(5)->links() }} --}}
    </div>
@endsection


@push('after-scripts')
@endpush
