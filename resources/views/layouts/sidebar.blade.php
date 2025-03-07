<aside class="sidebar">
    <div class="sidebar-header">
        <h2 class="logo">News Aggregator</h2>
        <button class="toggle-btn">☰</button>
    </div>
    <!-- Horizontal Line -->
        <span class="user-name sidebar-username" style="display: none;">
            {{ Str::limit(auth()->user()->name ?? 'Guest', 16, '...') }}
        </span>
    <div class="divider"></div>
    <nav>
        <ul>
            @php $selectedCategory = request('category', 'All News'); @endphp
            <li><a href="{{ route('dashboard', ['category' => 'All News']) }}" class="{{ $selectedCategory == 'All News' ? 'active' : '' }}">All News</a></li>
            <li><a href="{{ route('dashboard', ['category' => 'Health']) }}" class="{{ $selectedCategory == 'Health' ? 'active' : '' }}">Health</a></li>
            <li><a href="{{ route('dashboard', ['category' => 'Technology']) }}" class="{{ $selectedCategory == 'Technology' ? 'active' : '' }}">Technology</a></li>
            <li><a href="{{ route('dashboard', ['category' => 'Sport']) }}" class="{{ $selectedCategory == 'Sport' ? 'active' : '' }}">Sports</a></li>
            <li><a href="{{ route('dashboard', ['category' => 'Politics']) }}" class="{{ $selectedCategory == 'Politics' ? 'active' : '' }}">Politics</a></li>
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" class="logout-btn" id="logout-btn">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</aside>
<!-- Logout Confirmation Modal -->
<div id="logout-modal" class="modal" style="display: none">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Confirm Logout</h2>
        <p>Are you sure you want to log out?</p>
        <div class="modal-buttons">
            <button id="confirm-logout">Yes, Logout</button>
            <button id="cancel-logout">Cancel</button>
        </div>
    </div>
</div>
