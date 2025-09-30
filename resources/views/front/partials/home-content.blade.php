<div class="d-flex flex-column" style="height: 91vh;">

    <main class="flex-grow-1 d-flex flex-column justify-content-center align-items-center text-center"
          style="background: linear-gradient(-45deg, #89f7fe, #66a6ff, #a18cd1, #fbc2eb);
                 background-size: 400% 400%;
                 animation: gradientBG 15s ease infinite;">
        @php
            $line1 = 'Travel';
            $line2 = 'Management System';
            $images = [
                'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&auto=format&fit=crop&q=60',
                'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=600&auto=format&fit=crop&q=60',
                'https://images.unsplash.com/photo-1488085061387-422e29b40080?w=600&auto=format&fit=crop&q=60',
                'https://images.unsplash.com/photo-1584132967334-10e028bd69f7?w=600&auto=format&fit=crop&q=60',
                'https://images.unsplash.com/photo-1604357209793-fca5dca89f97?w=600&auto=format&fit=crop&q=60',
                'https://images.unsplash.com/photo-1448375240586-882707db888b?w=600&auto=format&fit=crop&q=60',
                'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=600&auto=format&fit=crop&q=60',
                'https://plus.unsplash.com/premium_photo-1710030733249-5d7c34509f61?w=600&auto=format&fit=crop&q=60',
            ];
        @endphp

        <!-- Lines and buttons -->
        <h1 class="d-flex justify-content-center flex-wrap travel-heading">
            @foreach(str_split($line1) as $index => $char)
                <span class="letter" style="background-image: url('{{ $images[$index % count($images)] }}');">
                    {{ $char }}
                </span>
            @endforeach
        </h1>

        <h1 class="d-flex justify-content-center flex-wrap travel-heading">
            @foreach(str_split($line2) as $index => $char)
                @if($char === ' ')
                    <span class="letter-space">&nbsp;</span>
                @else
                    <span class="letter" style="background-image: url('{{ $images[$index % count($images)] }}');">
                        {{ $char }}
                    </span>
                @endif
            @endforeach
        </h1>

        <p class="text-white mb-4 fs-5">Manage bookings, packages, and customers easily from a single dashboard.</p>

        <div>
            @guest
                <a href="{{ route('register') }}" class="btn btn-lg btn-light me-3 shadow-sm">Get Started</a>
                <a href="{{ route('login') }}" class="btn btn-lg btn-outline-light shadow-sm">Login</a>
            @else
                <a href="{{ route('logout') }}" class="btn btn-lg btn-light shadow-sm"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>

    </main>
</div>
