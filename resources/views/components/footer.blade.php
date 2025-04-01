<div class="footer-nav position-relative footer-style-three shadow-sm">
    <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
        <li>
            <a href="{{ asset('lapor-sampah') }}">
                <i class="bi bi-trash"></i>
            </a>
        </li>

        <li>
            <a href="{{ asset('riwayat-lapor') }}">
                <i class="bi bi-folder2-open"></i>
            </a>
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
                @endif
            @else
                <a href="{{ route('login') }}">
                    <i class="bi bi-person"></i>
                </a>
            @endif
        </li>

        <li>
            <a href="{{ asset('page/setting') }}">
                <i class="bi bi-gear"></i>
            </a>
        </li>
    </ul>
</div>
