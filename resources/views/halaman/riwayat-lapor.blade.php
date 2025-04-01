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
                                    <th>Nama Pengguna</th> <!-- Tambahkan kolom Nama Pengguna -->
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
                                            <img src="{{ asset('storage/' . $item->foto_sampah) }}" alt="Foto Sampah" width="100">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td>{{ ucfirst($item->jenis_sampah) }}</td>
                                    <td>{{ $item->berat_sampah }}</td>
                                    <td>{{ $item->keterangan_lokasi_sampah }}</td>
                                    <td>{{ ucfirst($item->status) }}</td>
                                    <td>
                                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                    </td>
                                    @if (Auth::user()->role === 'admin')
                                        <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td> <!-- Tampilkan nama pengguna -->
                                    @endif
                                    <td>
                                        @if (Auth::user()->role === 'admin')
                                            <!-- Tombol Edit (Hanya untuk Admin) -->
                                            <a href="{{ route('riwayat-lapor.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @else
                                            <!-- Kolom Pembayaran (Hanya untuk User) -->
                                            @if ($item->status_bayar === 'belum lunas')
                                                <form action="{{ route('riwayat-lapor.bayar', $item->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin membayar laporan ini?')">
                                                        <i class="bi bi-cash"></i> Bayar
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge bg-success">Lunas</span>
                                            @endif
                                        @endif

                                        <!-- Tombol Hapus -->
                                        @if (Auth::user()->role === 'admin' && Gate::allows('delete', $item))
                                            <form action="{{ route('riwayat-lapor.delete', $item->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                    <i class="bi bi-trash"></i> <!-- Simbol Trash -->
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Tombol Validasi -->
                                        @if (Auth::user()->role === 'admin' && $item->status === 'pending')
                                            <form action="{{ route('riwayat-lapor.validasi', $item->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin memvalidasi laporan ini?')">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Tombol Ubah Status -->
                                        @if (Auth::user()->role === 'admin' && $item->status === 'selesai')
                                            <form action="{{ route('riwayat-lapor.ubah-status', ['id' => $item->id, 'status' => 'menunggu diangkut']) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi menunggu diangkut?')">
                                                    <i class="bi bi-truck"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if (Auth::user()->role === 'tim_operasional' && $item->status === 'menunggu diangkut')
                                            <form action="{{ route('riwayat-lapor.ubah-status', ['id' => $item->id, 'status' => 'diangkut']) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi diangkut?')">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            </form>
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
            </div>
        </div>
    </div>

    <!-- Footer Nav -->
    <div class="footer-nav-area" id="footerNav">
        <div class="container px-0">
            <!-- Footer Content -->
            @include('components.footer')
        </div>
    </div>
@endsection
