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
            <h1 class="category-title">
                @php $selectedCategory = request('category', 'All News');  echo $selectedCategory; @endphp
            </h1>
            <div class="search-user-container">
                <form action="{{ route('dashboard') }}" method="GET" class="search-form">
                    <input type="hidden" value="@php
                    echo $selectedCategory;
                    @endphp" name="category">
                    <input type="text" name="search" class="searchInput" placeholder="Search news..." value="{{   request('search') }}">
                    <button type="submit">Search</button>
                </form>
                <div class="user-profile" data-fullname="{{ auth()->user()->name ?? 'Guest' }}">
                    {{-- <span class="user-name">{{ auth()->user()->name ?? 'Guest' }}</span> --}}
                    <span class="user-name">
                        {{ Str::limit(auth()->user()->name ?? 'Guest', 10, '...') }}
                    </span>
                </div>
            </div>
            <!-- User Profile Section -->
        </header>
        <!-- News Section -->
        <section class="news-container" id="newsContainer">
            @forelse ($news as $article)
                <article class="news-card">
                    <img src="{{ $article->image ?? 'https://source.unsplash.com/400x200/?news' }}" alt="News">
                    <h3>{{ e($article->title) }}</h3>
                    <p class="news-content">{{ e($article->content) }}</p>
                    <a href="{{ $article->source_url }}" target="_blank">Read More</a>
                </article>
            @empty
                <p>No news available in this category.</p>
            @endforelse
        </section>
         <!-- Pagination Links -->
         <div class="pagination-container">
            {{ $news->appends(['category' => request('category')])->links('vendor.pagination.default') }}
        </div>
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
