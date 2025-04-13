@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Laporan Menunggu Diangkut</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Warga</th>
                    <th>Lokasi</th>
                    <th>Ket Lokasi</th>
                    <th>Jenis Sampah</th>
                    <th>Berat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td> <!-- Menampilkan nama pengguna -->
                        <td>{{ $item->lokasi_sampah }}</td>
                        <td>{{ $item->keterangan_lokasi_sampah ?? '-' }}</td> <!-- Menampilkan keterangan lokasi -->
                        <td>{{ ucfirst($item->jenis_sampah) }}</td>
                        <td>{{ $item->berat_sampah }} kg</td>
                        <td>
                            @if ($item->foto_sampah)
                                <img src="{{ asset('storage/' . $item->foto_sampah) }}" alt="Foto Sampah" width="100">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                        <td>
                            <form
                                action="{{ route('riwayat-lapor.ubah-status', ['id' => $item->id, 'status' => 'diangkut']) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Angkut</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada laporan menunggu diangkut.</td>
                    </tr>
                    {{-- <tr>
                        <td colspan="8" class="text-center">
                            <a href="{{ route('tim-operasional.dashboard') }}" class="btn btn-primary">Kembali ke
                                Dashboard</a>
                        </td>
                    </tr> --}}
                @endforelse
            </tbody>
        </table>
        <!-- Tombol Kembali ke Dashboard -->
        <div class="text-center mt-4">
            <a href="{{ route('tim-operasional.dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
        </div>
    </div>

    {{-- <div class="page-content-wrapper py-3">
        <!-- Pagination -->
        <div class="shop-pagination pb-3">
            <div class="container">
                <div class="card">
                    <div class="card-body p-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <small class="ms-1">Showing 6 of 31</small>
                            <form action="#">
                                <select class="pe-4 form-select form-select-sm" id="defaultSelectSm" name="defaultSelectSm"
                                    aria-label="Default select example">
                                    <option value="1" selected>Sort by Newest</option>
                                    <option value="2">Sort by Older</option>
                                    <option value="3">Sort by Ratings</option>
                                    <option value="4">Sort by Sales</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="top-products-area">
            <div class="container">
                <div class="row g-3">

                    <!-- Single Top Product Card -->
                    <div class="col-6 col-sm-4 col-lg-3">
                        <div class="card single-product-card">
                            <div class="card-body p-3">
                                <!-- Product Thumbnail -->
                                <a class="product-thumbnail d-block" href="shop-details.html">
                                    <img src="img/bg-img/p1.jpg" alt="">
                                    <!-- Badge -->
                                    <span class="badge bg-warning">Sale</span>
                                </a>
                                <!-- Product Title -->
                                <a class="product-title d-block text-truncate" href="shop-details.html">Wooden Tool</a>
                                <!-- Product Price -->
                                <p class="sale-price">$9.89<span>$13.42</span></p>
                                <a class="btn btn-primary rounded-pill btn-sm" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>

                    <!-- Single Top Product Card -->
                    <div class="col-6 col-sm-4 col-lg-3">
                        <div class="card single-product-card">
                            <div class="card-body p-3">
                                <!-- Product Thumbnail -->
                                <a class="product-thumbnail d-block" href="shop-details.html">
                                    <img src="img/bg-img/p2.jpg" alt="">
                                    <!-- Badge -->
                                    <span class="badge bg-primary">-10%</span>
                                </a>
                                <!-- Product Title -->
                                <a class="product-title d-block text-truncate" href="shop-details.html">Atoms
                                    Musk</a>
                                <!-- Product Price -->
                                <p class="sale-price">$3.36<span>$5.99</span></p>
                                <a class="btn btn-primary rounded-pill btn-sm" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>

                    <!-- Single Top Product Card-->
                    <div class="col-6 col-sm-4 col-lg-3">
                        <div class="card single-product-card">
                            <div class="card-body p-3">
                                <!-- Product Thumbnail -->
                                <a class="product-thumbnail d-block" href="shop-details.html">
                                    <img src="img/bg-img/p3.jpg" alt="">
                                    <!-- Badge -->
                                    <span class="badge bg-info">-15%</span></a>
                                <!-- Product Title -->
                                <a class="product-title d-block text-truncate" href="shop-details.html">Black
                                    T-shirt</a>
                                <!-- Product Price -->
                                <p class="sale-price">$10.99<span>$12</span></p>
                                <a class="btn btn-primary rounded-pill btn-sm" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>

                    <!-- Single Top Product Card-->
                    <div class="col-6 col-sm-4 col-lg-3">
                        <div class="card single-product-card">
                            <div class="card-body p-3">
                                <!-- Product Thumbnail -->
                                <a class="product-thumbnail d-block" href="shop-details.html">
                                    <img src="img/bg-img/p4.jpg" alt="">
                                    <!-- Badge -->
                                    <span class="badge bg-primary">Sale</span></a>
                                <!-- Product Title -->
                                <a class="product-title d-block text-truncate" href="shop-details.html">Headphone</a>
                                <!-- Product Price -->
                                <p class="sale-price">$2.99<span>$4</span></p>
                                <a class="btn btn-danger rounded-pill btn-sm disabled" href="#">Out of Stock</a>
                            </div>
                        </div>
                    </div>

                    <!-- Single Top Product Card -->
                    <div class="col-6 col-sm-4 col-lg-3">
                        <div class="card single-product-card">
                            <div class="card-body p-3">
                                <!-- Product Thumbnail -->
                                <a class="product-thumbnail d-block" href="shop-details.html">
                                    <img src="img/bg-img/p5.jpg" alt="">
                                    <!-- Badge -->
                                    <span class="badge bg-danger">Sale</span>
                                </a>
                                <!-- Product Title -->
                                <a class="product-title d-block text-truncate" href="shop-details.html">Crispy Biscuit</a>
                                <!-- Product Price -->
                                <p class="sale-price">$0.78<span>$1.12</span></p>
                                <a class="btn btn-primary rounded-pill btn-sm" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>

                    <!-- Single Top Product Card -->
                    <div class="col-6 col-sm-4 col-lg-3">
                        <div class="card single-product-card">
                            <div class="card-body p-3">
                                <!-- Product Thumbnail -->
                                <a class="product-thumbnail d-block" href="shop-details.html">
                                    <img src="img/bg-img/p6.jpg" alt="">
                                    <!-- Badge -->
                                    <span class="badge bg-primary">Hot</span></a>
                                <!-- Product Title -->
                                <a class="product-title d-block text-truncate" href="shop-details.html">Sports Shoes</a>
                                <!-- Product Price -->
                                <p class="sale-price">$110<span>$128</span></p>
                                <a class="btn btn-danger rounded-pill btn-sm disabled" href="#">Out of Stock</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="shop-pagination pt-3">
            <div class="container">
                <div class="card">
                    <div class="card-body py-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-two justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <i class="bi bi-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">9</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Footer Nav -->
    <div class="footer-nav-area" id="footerNav">
        <div class="container px-0">
            <!-- Footer Content -->
            @include('components.footer')
        </div>
    </div>
    
@endsection
