{{-- <div class="header">
    <div class="items d-flex align-items-center" style="width: 100%">
        <div class="search-container">
            <form id="search" action="{{ route('dashboard.search') }}" method="GET"
                class="d-flex align-items-center justify-content-between">
                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text" name="keyword" value="{{ request('keyword') }}"
                    placeholder="ابحث عن الأفلام والبرامج التلفزيونية ..." class="form-control"/>
            </form>

        </div>

        <div class="d-md-flex search-btn">
                <button type="submit" class="btn btn-secondary me-1 mb-2" onclick="submitForm()">
                    بحث
                </button>
            
                <a href="{{ route('dashboard.advanced-search') }} " class="btn text-dark mb-2" style="background-color:#00ff00">
                    البحث المتقدم
                </a>
        </div>
    </div>


    <div class="avatar">
        <a href="{{ route('dashboard.settings') }}">
            <img src="{{ auth()->user()->imageUrl() }}" alt="avatar"/>
        </a>
    </div>
</div>

<script>
    function submitForm() {
        let form = document.getElementById('search');
        form.submit();
    }
</script> --}}

<style>

    .search-bar {
        display: flex;
        align-items: center;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .search-input {
        flex: 1;
        border: none;
        outline: none;
        border-radius: 20px;
        padding: 10px 15px;
        background-color: #f1f3f5;
        color: #6c757d;
    }

    .search-input::placeholder {
        color: #ced4da;
    }

    .search-button {
        margin-right: 10px;
        color: #6c757d;
        background-color: #e9ecef;
        border: none;
        border-radius: 20px;
        padding: 5px 15px;
        transition: background-color 0.3s;
    }

    .search-button:hover {
        background-color: #adb5bd;
    }

    .advanced-search-button {
        color: #fff;
        background-color: #28a745;
        border: none;
        border-radius: 20px;
        padding: 5px 15px;
        transition: background-color 0.3s;
    }

    .advanced-search-button:hover {
        background-color: #218838;
    }
    .profile-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 15px;
        object-fit: cover;
    }
</style>

<div class="container mt-4">
    <form action="{{ route('dashboard.search') }}" method="GET">
        <div class="search-bar">
        
        
            <input type="text" class="search-input" name="keyword" placeholder="ابحث عن الأفلام والبرامج التلفزيونية">
        
            <a href="{{ route('dashboard.search') }}">
                <button class="search-button ms-2 me-2">بحث</button>
            </a>
        
            <a href="{{ route('dashboard.advanced-search') }}">
                <p class="advanced-search-button">البحث المتقدم</p>
            </a>
        
            <a href="{{ route('dashboard.settings') }}">
                <img src="{{ auth()->user()->imageUrl() }}" alt="Profile" class="profile-image">
            </a>
        
        </div>
    </form>
</div>

