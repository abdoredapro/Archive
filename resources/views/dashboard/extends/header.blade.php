<div class="header">
    <div class="search-container">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="ابحث عن الأفلام والبرامج التلفزيونية ..." />
    </div>
    <div class="avatar">
        @php
            $user = Auth::user();
        @endphp
        <img src="{{ $user->imageUrl() }}" />
        
    </div>
</div>