<aside class="sidebar">
    <div class="sidebar-header">
        <h2 class="logo">News Aggregator</h2>
        <button class="toggle-btn">☰</button>
    </div>
    <!-- Horizontal Line -->
    <div class="divider"></div>
    <nav>
        <ul>
            <li><a href="#">All News</a></li>
            <li><a href="#">Latest News</a></li>
            <li><a href="#">Science</a></li>
            <li><a href="#">Sports</a></li>
            <li><a href="#">Settings</a></li>
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
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
