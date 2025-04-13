<div class="footer-nav position-relative shadow-sm">
    <ul class="h-100 d-flex align-items-center justify-content-between ps-0">

        <li>
            <a href="{{ asset('home') }}">
                <i class="bi bi-house"></i>
                <span>Home</span>
            </a>
        </li>

        <li>
            <a href="{{ asset('riwayat-lapor') }}">
                <i class="bi bi-clock-history"></i>
                <span>Riwayat Lapor</span>
            </a>
        </li>

        <li class="active">
            <a href="{{ asset('lapor-sampah') }}">
                <i class="bi bi-pencil-square"></i>
                <span>Lapor Sampah</span>
            </a>
        </li>

        <li>
            @if (Auth::check())
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-person"></i>
                        <span>Admin</span>
                    </a>
                @elseif (Auth::user()->role === 'tim_operasional')
                    <a href="{{ route('tim-operasional.dashboard') }}">
                        <i class="bi bi-person"></i>
                        <span>Tim Operasional</span>
                    </a>
                @elseif (Auth::user()->role === 'user')
                    <a href="{{ route('warga.dashboard') }}">
                        <i class="bi bi-person"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}">
                    <i class="bi bi-person"></i>
                    <span>Login</span>
                </a>
            @endif
        </li>

        <li>
            <a href="{{ asset('page/setting') }}">
                <i class="bi bi-gear"></i>
                <span>Setting</span>
            </a>
        </li>
    </ul>
</div>
