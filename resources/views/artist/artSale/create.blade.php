@extends('layouts.Details')

@section('title')
    Add new art
@endsection

@section('content')
    <svg width="148" height="20" viewBox="0 0 148 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M6.24008 19.7059H0L8.54684 0H16.5022L25.0786 19.7059H18.6907L17.1824 16.0588H7.77792L6.24008 19.7059ZM11.031 8.32353L9.87766 11.0882L7.6892 16.0294L17.1824 16.0588L13.9884 8.32353L12.6872 5H12.3027L11.031 8.32353Z"
            fill="#CEFE06" />
        <path
            d="M31.8252 19.7059H26.2653V4.88235H31.4703V8.76471H31.766C32.18 6.32353 33.7179 4.58824 36.6753 4.58824C39.958 4.58824 41.2592 6.73529 41.2592 9.70588V12.6471H35.6993V10.9118C35.6993 9.67647 35.2261 9.23529 33.777 9.23529C32.2688 9.23529 31.8252 9.67647 31.8252 10.8529V19.7059Z"
            fill="#CEFE06" />
        <path
            d="M54.1793 19.7059H50.2755C46.5492 19.7059 44.3312 17.9118 44.3312 14.0588V9.41176H42.1427V4.88235H44.3312V2.32353H49.8911V4.88235H54.1793V9.41176H49.8911V13.2647C49.8911 14.4412 50.246 14.7353 51.5176 14.7353H54.1793V19.7059Z"
            fill="#CEFE06" />
        <path
            d="M61.0367 20C58.1681 20 56.2162 18.6471 56.2162 16.2941C56.2162 13.9118 58.1976 12.8824 60.9184 12.5882L67.8683 11.8235V10.7059C67.8683 7.88235 66.6262 6.76471 63.4322 6.76471C60.2974 6.76471 58.6412 7.88235 58.6412 10.4412V10.5588H56.5415V10.4412C56.5415 7.38235 59.0848 4.88235 63.5801 4.88235C68.0162 4.88235 69.9089 7.41176 69.9089 10.6176V19.7059H68.0162V15.7941H67.8683C67.0106 18.4706 64.4377 20 61.0367 20ZM58.3159 16.1471C58.3159 17.6176 59.2919 18.3824 61.5099 18.3824C65.0588 18.3824 67.8683 16.8235 67.8683 13.3235V13.2059L61.569 13.9118C59.3806 14.1176 58.3159 14.6471 58.3159 16.1471Z"
            fill="#FDFFF3" />
        <path
            d="M76.0517 19.7059H73.9519V5.17647H75.8447V9.55882H75.963C76.377 7.11765 78.0627 4.88235 81.7003 4.88235C84.9534 4.88235 86.787 6.88235 87.2602 9.70588H87.408C87.8221 7.20588 89.5669 4.88235 93.2341 4.88235C97.0491 4.88235 99.0306 7.55882 99.0306 11.2353V19.7059H96.9308V11.5294C96.9308 8.29412 95.5409 6.79412 92.4652 6.79412C88.9459 6.79412 87.5263 8.82353 87.5263 12.6765V19.7059H85.4266V11.5294C85.4266 8.29412 84.0662 6.79412 80.9905 6.79412C77.4417 6.79412 76.0517 8.82353 76.0517 12.6765V19.7059Z"
            fill="#FDFFF3" />
        <path
            d="M107.1 20C104.232 20 102.28 18.6471 102.28 16.2941C102.28 13.9118 104.261 12.8824 106.982 12.5882L113.932 11.8235V10.7059C113.932 7.88235 112.69 6.76471 109.496 6.76471C106.361 6.76471 104.705 7.88235 104.705 10.4412V10.5588H102.605V10.4412C102.605 7.38235 105.148 4.88235 109.644 4.88235C114.08 4.88235 115.972 7.41176 115.972 10.6176V19.7059H114.08V15.7941H113.932C113.074 18.4706 110.501 20 107.1 20ZM104.38 16.1471C104.38 17.6176 105.355 18.3824 107.573 18.3824C111.122 18.3824 113.932 16.8235 113.932 13.3235V13.2059L107.633 13.9118C105.444 14.1176 104.38 14.6471 104.38 16.1471Z"
            fill="#FDFFF3" />
        <path
            d="M122.115 19.7059H120.016V5.17647H121.908V9.14706H122.056C122.5 6.82353 124.156 4.88235 127.202 4.88235C130.573 4.88235 132.052 7.35294 132.052 10.0588V11.5H129.952V10.3824C129.952 7.91176 128.917 6.70588 126.374 6.70588C123.417 6.70588 122.115 8.55882 122.115 11.8235V19.7059Z"
            fill="#FDFFF3" />
        <path
            d="M139.128 20C136.259 20 134.307 18.6471 134.307 16.2941C134.307 13.9118 136.289 12.8824 139.01 12.5882L145.959 11.8235V10.7059C145.959 7.88235 144.717 6.76471 141.523 6.76471C138.389 6.76471 136.732 7.88235 136.732 10.4412V10.5588H134.633V10.4412C134.633 7.38235 137.176 4.88235 141.671 4.88235C146.107 4.88235 148 7.41176 148 10.6176V19.7059H146.107V15.7941H145.959C145.102 18.4706 142.529 20 139.128 20ZM136.407 16.1471C136.407 17.6176 137.383 18.3824 139.601 18.3824C143.15 18.3824 145.959 16.8235 145.959 13.3235V13.2059L139.66 13.9118C137.472 14.1176 136.407 14.6471 136.407 16.1471Z"
            fill="#FDFFF3" />
    </svg>
    <div class="form-container">
        <div class="form-title">
            <a href="{{ route('artist-sales.index') }}" class="btn" style="color: var(--text-primary);">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="mb-0 .fw-semibold bread-crumb">Artwork Details</h1>
        </div>

        <form class="form-create-container" action="{{ route('artist-sales.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-create">
                <div class="form-item">
                    {{-- title --}}
                    <label for="title">Title</label>
                    <input value="{{ old('title') }}" type="text" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror" placeholder="Title" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- medium --}}
                    <label for="medium">Medium</label>
                    <input value="{{ old('medium') }}" type="text" name="medium" id="medium"
                        class="form-control @error('medium') is-invalid @enderror" placeholder="Medium" required>
                    @error('medium')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- year --}}
                    <label for="year">Year</label>
                    <input value="{{ old('year') }}" type="number" name="year" id="year"
                        class="form-control @error('year') is-invalid @enderror" placeholder="Year" required>
                    @error('year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- price --}}
                    <label for="price">Price</label>
                    <input value="{{ old('price') }}" type="number" name="price" id="price"
                        class="form-control @error('price') is-invalid @enderror" placeholder="Price" required>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- category --}}
                    <label for="category_id">Category</label>
                    <select class="form-select" name="category_id" id="category_id" required>
                        {{-- <option value="">Choose Art Category</option> --}}
                        @foreach ($categories as $i)
                            <option value="{{ $i->category_id }}">
                                {{ $i->name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- photo --}}
                    <label for="photo">Photos</label>
                    <input name="photo[]" id="photo" class="form-control @error('photo[]') is-invalid @enderror"
                        placeholder="Max 5 photos" required accept="image/png,image/jpg,image/jpeg" type="file" multiple>
                    @error('photo[]')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="img-holder"></div>

                </div>
                <div class="form-item">
                    {{-- material --}}
                    <label for="material">Material</label>
                    <input value="{{ old('material') }}" type="text" name="material" id="material"
                        class="form-control @error('material') is-invalid @enderror" placeholder="Material" required>
                    @error('material')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- measurement --}}
                    <div class="measurement">
                        {{-- length --}}
                        <div class="measurement-item">
                            <label for="length">Length</label>
                            <input value="{{ old('length') }}" type="number" name="length" id="length"
                                class="form-control @error('length') is-invalid @enderror" placeholder="Length" required>
                            @error('length')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- width --}}
                        <div class="measurement-item">
                            <label for="width">Width</label>
                            <input value="{{ old('width') }}" type="number" name="width" id="width"
                                class="form-control @error('width') is-invalid @enderror" placeholder="Width" required>
                            @error('width')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- stock --}}
                    <label for="stock">Stock</label>
                    <input value="{{ old('stock') }}" type="number" name="stock" id="stock"
                        class="form-control @error('stock') is-invalid @enderror" placeholder="Stock" required>
                    @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- description --}}
                    <label for="description">Description</label>
                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                        name="description"  autocomplete="off" placeholder="Art Description" required
                        style="height: 50%">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-create-btn">
                <button type="submit" class="btn btn-primary">Create New Art</button>
            </div>
        </form>

    </div>
@endsection

@push('styles')
    @vite('resources/css/artist/artCreate.css')
@endpush

@push('after-scripts')
    <script>
        const input = document.querySelector('input[type="file"]');
        const imgHolder = document.querySelector('.img-holder');

        input.addEventListener('change', function() {
            while (imgHolder.firstChild) {
                imgHolder.removeChild(imgHolder.firstChild);
            }

            const files = Array.from(input.files);

            files.forEach((file, i) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxHeight = '100px';
                    img.style.padding = '10px';
                    img.classList.add('img-preview');

                    imgHolder.appendChild(img);
                }

                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
