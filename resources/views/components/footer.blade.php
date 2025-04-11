<div class="footer-nav position-relative footer-style-three shadow-sm">
    <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
        <li class="position-relative">
            <a href="{{ asset('lapor-sampah') }}">
            <i class="bi bi-pencil-square"></i>
            </a>
            <span class="position-absolute top-100 start-50 translate-middle badge rounded-pill text-dark bg-light" style="z-index: 1;">
            Lapor Sampah
            </span>
        </li>

        <li>
            <a href="{{ asset('riwayat-lapor') }}">
                <i class="bi bi-clock-history"></i>
            </a>
            <span class="position-absolute top-100 start-50 translate-middle badge rounded-pill text-dark bg-light" style="z-index: 1;">
                Riwayat Lapor
                </span>
        </li>

        <li class="active">
            <a href="{{ asset('home') }}">
                <i class="bi bi-house"></i>
            </a>
        </li>

        <li>
            @if (Auth::check())
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-person"></i>
                    </a>
                @elseif (Auth::user()->role === 'tim_operasional')
                    <a href="{{ route('tim-operasional.dashboard') }}">
                        <i class="bi bi-person"></i>
                    </a>
                @elseif (Auth::user()->role === 'user')
                    <a href="{{ route('warga.dashboard') }}">
                        <i class="bi bi-person"></i>
                    </a>
                    <span class="position-absolute top-100 start-50 translate-middle badge rounded-pill text-dark bg-light" style="z-index: 1;">
                        {{ Auth::user()->name }}
                        </span>
                @endif
            @else
                <a href="{{ route('login') }}">
                    <i class="bi bi-person"></i>
                </a>
                <span class="position-absolute top-100 start-50 translate-middle badge rounded-pill text-dark bg-light" style="z-index: 1;">
                    Login
                    </span>
            @endif
        </li>

        <li>
            <a href="{{ asset('page/setting') }}">
                <i class="bi bi-gear"></i>
            </a>
            <span class="position-absolute top-100 start-50 translate-middle badge rounded-pill text-dark bg-light" style="z-index: 1;">
                Setting
                </span>
        </li>
    </ul>
</div>
