@extends('layouts.app')

@section('title', 'News | Home  ')

@push('css')
    @vite(['resources/css/dashboard.css'])
@endpush

@push('js')
    @vite(['resources/js/dashboard.js'])
@endpush

@section('content')
<div class="dashboard-container">
    
    <!-- Sidebar -->

@include('layouts.sidebar')

    <!-- Main Content -->
    <main class="content">
        <!-- Top Bar -->
        <header class="top-bar">
            <h1>News Dashboard</h1>
            <input type="text" placeholder="Search news...">
        </header>

        <!-- News Section -->
        <section class="news-container">
            <article class="news-card">
                <img src="https://source.unsplash.com/400x200/?news" alt="News">
                <h3>Breaking News Headline</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#">Read More</a>
            </article>

            <article class="news-card">
                <img src="https://source.unsplash.com/400x200/?politics" alt="News">
                <h3>Politics Today</h3>
                <p>Curabitur at justo vehicula, varius orci at, varius sapien.</p>
                <a href="#">Read More</a>
            </article>

            <article class="news-card">
                <img src="https://source.unsplash.com/400x200/?sports" alt="News">
                <h3>Sports Update</h3>
                <p>Pellentesque sit amet purus eu ligula aliquet commodo.</p>
                <a href="#">Read More</a>
            </article>
        </section>
    </main>
    <div id="toast-container"></div>
</div>
@endsection

<script>
    function showToast(message, type = 'success') {
        const toastContainer = document.getElementById("toast-container");
        const toast = document.createElement("div");
        toast.className = `toast ${type}`;
        
        // Add icon
        const icon = document.createElement("i");
        icon.innerHTML = type === "error" ? "❌" : "✅";
        
        toast.appendChild(icon);
        toast.appendChild(document.createTextNode(message));

        toastContainer.appendChild(toast);

        // Remove toast after animation
        setTimeout(() => {
            toast.remove();
        }, 4000);
    }

    // Show toast message on page load if Laravel session has messages
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            showToast("{{ session('success') }}", "success");
        @endif

        @if(session('error'))
            showToast("{{ session('error') }}", "error");
        @endif
    });
</script>
