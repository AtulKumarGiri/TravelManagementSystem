<nav id="sidebar" class="sidebar">
    <div class="p-3">
        <h4 class="text-center mb-3">Admin</h4>
        <hr class="text-secondary">

        <ul class="nav flex-column">

            {{-- Dashboard --}}
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
            </li>

            {{-- Static: Create Sidebar Option --}}
            <li class="nav-item">
                <a href="{{ route('sidebar.index') }}" class="nav-link">
                    <i class="fa fa-plus-circle"></i>
                    Sidebar Options
                </a>
            </li>

            {{-- Dynamic Sidebar --}}
            @foreach($sidebars as $sidebar)
                @if($sidebar->children->count())
                    {{-- Collapsible section --}}
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-between align-items-center" 
                           data-bs-toggle="collapse" 
                           href="#menu{{ $sidebar->id }}" 
                           role="button">
                            <span>@if($sidebar->icon)<i class="{{ $sidebar->icon }}"></i>@endif {{ $sidebar->title }}</span>
                            <span class="caret">▼</span>
                        </a>
                        <div class="collapse submenu" id="menu{{ $sidebar->id }}">
                            @foreach($sidebar->children as $child)
                                @if($child->children->count())
                                    {{-- Nested collapse --}}
                                    <a class="nav-link d-flex justify-content-between align-items-center ms-3" 
                                       data-bs-toggle="collapse" 
                                       href="#menu{{ $child->id }}">
                                        @if($child->icon)<i class="{{ $child->icon }}"></i>@endif {{ $child->title }}
                                        <span class="caret">▼</span>
                                    </a>
                                    <div class="collapse submenu ms-3" id="menu{{ $child->id }}">
                                        @foreach($child->children as $inner)
                                            <a href="{{ url($inner->slug) }}" class="nav-link ms-4">
                                                @if($inner->icon)<i class="{{ $inner->icon }}"></i>@endif
                                                {{ $inner->title }}
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <a href="{{ url($child->slug) }}" class="nav-link ms-3">
                                        @if($child->icon)<i class="{{ $child->icon }}"></i>@endif
                                        {{ $child->title }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </li>
                @else
                    {{-- Single link --}}
                    <li class="nav-item">
                        <a href="{{ url($sidebar->slug) }}" class="nav-link">
                            @if($sidebar->icon)<i class="{{ $sidebar->icon }}"></i>@endif
                            {{ $sidebar->title }}
                        </a>
                    </li>
                @endif
            @endforeach

        </ul>
    </div>
</nav>
