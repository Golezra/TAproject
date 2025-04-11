@extends('layouts.app')

@section('title', 'Riwayat Lapor')

@section('content')
<!-- Dark mode switching -->
<div class="dark-mode-switching">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">
        <div class="dark-mode-text text-center">
            <i class="bi bi-moon"></i>
            <p class="mb-0">Switching to dark mode</p>
        </div>
        <div class="light-mode-text text-center">
            <i class="bi bi-brightness-high"></i>
            <p class="mb-0">Switching to light mode</p>
        </div>
    </div>
</div>

<!-- RTL mode switching -->
<div class="rtl-mode-switching">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">
        <div class="rtl-mode-text text-center">
            <i class="bi bi-text-right"></i>
            <p class="mb-0">Switching to RTL mode</p>
        </div>
        <div class="ltr-mode-text text-center">
            <i class="bi bi-text-left"></i>
            <p class="mb-0">Switching to default mode</p>
        </div>
    </div>
</div>

<!-- Setting Popup Overlay -->
<div id="setting-popup-overlay"></div>

<!-- Setting Popup Card -->
<div class="card setting-popup-card shadow-lg" id="settingCard">
    <div class="card-body">
        <div class="container">
            <div class="setting-heading d-flex align-items-center justify-content-between mb-3">
                <p class="mb-0">Settings</p>
                <div class="btn-close" id="settingCardClose"></div>
            </div>

            <div class="single-setting-panel">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="availabilityStatus" checked>
                    <label class="form-check-label" for="availabilityStatus">Availability status</label>
                </div>
            </div>

            <div class="single-setting-panel">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="sendMeNotifications" checked>
                    <label class="form-check-label" for="sendMeNotifications">Send me notifications</label>
                </div>
            </div>

            <div class="single-setting-panel">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="darkSwitch">
                    <label class="form-check-label" for="darkSwitch">Dark mode</label>
                </div>
            </div>

            <div class="single-setting-panel">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="rtlSwitch">
                    <label class="form-check-label" for="rtlSwitch">RTL mode</label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Header Area -->
<div class="header-area" id="headerArea">
    <div class="container">
        <!-- Header Content -->
        <div class="header-content position-relative d-flex align-items-center justify-content-between">
            <!-- Back Button -->
            <div class="back-button">
                <a href="{{ asset('/home') }}">
                    <i class="bi bi-arrow-left-short"></i>
                </a>
            </div>

            <!-- Page Title -->
            <div class="page-heading">
                <h6 class="mb-0">Riwayat Lapor</h6>
            </div>

            <!-- Settings -->
            <div class="setting-wrapper">
                <div class="setting-trigger-btn" id="settingTriggerBtn">
                    <i class="bi bi-gear"></i>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <div class="page-content-wrapper py-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <!-- Form Pilihan Periode -->
                    <form action="{{ route('riwayat-lapor') }}" method="GET" class="mb-4">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label for="month" class="form-label">Pilih Bulan</label>
                                <input type="month" id="month" name="month" class="form-control" value="{{ request('month') }}">
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabel Riwayat Lapor -->
                    @if (Auth::user()->role !== 'user')
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Foto Sampah</th>
                                        <th>Jenis Sampah</th>
                                        <th>Berat (KG)</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Nominal (Rp)</th>
                                        @if (Auth::user()->role === 'admin')
                                            <th>Nama Pengguna</th>
                                        @endif
                                        <th>
                                            @if (Auth::user()->role === 'admin')
                                                Aksi
                                            @else
                                                Pembayaran
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($laporan as $item)
                                        <tr>
                                            <td>
                                                @if ($item->foto_sampah)
                                                    <img src="{{ asset('storage/' . $item->foto_sampah) }}" alt="Foto Sampah" width="100" style="cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#fotoModal{{ $item->id }}">
                                                @else
                                                    Tidak ada foto
                                                @endif

                                                <!-- Modal untuk Foto Sampah -->
                                                @if ($item->foto_sampah)
                                                    <div class="modal fade" id="fotoModal{{ $item->id }}" tabindex="-1" aria-labelledby="fotoModalLabel{{ $item->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="fotoModalLabel{{ $item->id }}">Foto Sampah</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ asset('storage/' . $item->foto_sampah) }}" alt="Foto Sampah" class="img-fluid" style="max-height: 500px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ ucfirst($item->jenis_sampah) }}</td>
                                            <td>{{ $item->berat_sampah }}</td>
                                            <td>{{ $item->keterangan_lokasi_sampah }}</td>
                                            <td>
                                                {{ $item->status }}
                                                @if (Auth::user()->role === 'admin' && $item->status === 'pending')
                                                    <form action="{{ route('riwayat-lapor.validasi', $item->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn-sm d-flex align-items-center"
                                                            onclick="return confirm('Apakah Anda yakin ingin memvalidasi laporan ini?')">
                                                            <i class="bi bi-check-circle me-1"></i> Validasi
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                            </td>
                                            @if (Auth::user()->role === 'admin')
                                                <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td>
                                            @endif
                                            <td>
                                                @if (Auth::user()->role === 'admin')
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <a href="{{ route('riwayat-lapor.edit', $item->id) }}" class="btn btn-warning btn-sm d-flex align-items-center">
                                                            <i class="bi bi-pencil me-1"></i> Edit
                                                        </a>
                                                        @if (Gate::allows('delete', $item))
                                                            <form action="{{ route('riwayat-lapor.delete', $item->id) }}" method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                                </button>
                                                            </form>
                                                        @endif
                                                        @if ($item->status === 'pending')
                                                            <form action="{{ route('riwayat-lapor.validasi', $item->id) }}" method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-success btn-sm d-flex align-items-center"
                                                                    onclick="return confirm('Apakah Anda yakin ingin memvalidasi laporan ini?')">
                                                                    <i class="bi bi-check-circle me-1"></i> Validasi
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Belum ada laporan sampah.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Top Products-->
    @if (Auth::user()->role === 'user')
        <div class="top-products-area product-list-wrap py-3">
            <div class="container">
                <div class="row g-3">
                    @forelse ($laporan as $item)
                        <!-- Single Top Product Card -->
                        <!-- Modal untuk Foto Sampah -->
                        <div class="modal fade" id="fotoModal{{ $item->id }}" tabindex="-1" aria-labelledby="fotoModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fotoModalLabel{{ $item->id }}">Foto Sampah</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/' . $item->foto_sampah) }}" alt="Foto Sampah" class="img-fluid" style="cursor: zoom-in;" onclick="this.style.transform = this.style.transform === 'scale(2)' ? 'scale(1)' : 'scale(2)'; this.style.transition = 'transform 0.3s ease-in-out';">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card single-product-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="card-side-img">
                                            <!-- Product Thumbnail -->
                                            <a class="product-thumbnail d-block">
                                                <img src="{{ asset('storage/' . $item->foto_sampah) }}" alt="Foto Sampah" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#fotoModal{{ $item->id }}">
                                            </a>
                                        </div>
                                    
                                        <div class="card-content px-4 py-2">
                                            <!-- Jenis Sampah -->
                                            <a class="product-title d-block text-truncate mt-0">{{ ucfirst($item->jenis_sampah) }}</a>
                                            <!-- Berat sampah dan nominal yang harus dibayar -->
                                            <p class="sale-price">{{ $item->berat_sampah }} Kg<span>Rp {{ number_format($item->nominal, 0, ',', '.') }}</span></p>
                                            <!-- Keterangan lokasi sampah -->
                                            <p class="product-description">Lokasi : <span>{{ $item->keterangan_lokasi_sampah }}</span></p>
                                            @if ($item->status_bayar === 'belum lunas')
                                                <a href="{{ route('riwayat-lapor.pembayaran', $item->id) }}" class="btn btn-primary btn-sm d-flex align-items-center">
                                                    <i class="bi bi-cash me-1"></i> Bayar
                                                </a>
                                            @else
                                                <span class="badge rounded-pill bg-success">Lunas</span>
                                            @endif
                                            @foreach ($laporan as $item)
                                                @if ($item->status_bayar === 'gagal' || $item->status_bayar === 'belum lunas')
                                                    <a href="{{ route('riwayat-lapor.pembayaran', $item->id) }}" class="btn btn-primary btn-sm">Bayar Ulang</a>
                                                @endif
                                            @endforeach
                                            <!-- Badge status sampah-->
                                            <div class="position-absolute top-0 end-0 me-3 mt-2">
                                                <span class="badge bg-primary primary rounded-pill">{{ ucfirst($item->status) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">Belum ada laporan sampah.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif
    </div>

    @endsection
    <!-- Footer Nav -->
    <div class="footer-nav-area" id="footerNav">
        <div class="container px-0">
            <!-- Footer Content -->
            @include('components.footer')
        </div>
    </div>
