<div class="header">
    <div class="items d-flex align-items-center" style="width: 100%">
        <div class="search-container">
            <form id="search" action="{{ route('dashboard.search') }}" class="d-flex align-items-center justify-content-center"> 
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" value="{{ request()->query('search') }}" placeholder="ابحث عن الأفلام والبرامج التلفزيونية ..." />
                <select name="type" id="" class="form-control">
                    <option value="all">الكل</option>
                    <option value="film">الافلام</option>
                    <option value="file">الملفات</option>
                </select>
                <input type="text" name="release_year" value="{{ request()->query('release_year') }}" class="form-control border" placeholder="ادخل السنه" style="    height: 37px;">
            </form>
        </div>
        <input type="submit" value="بحث" class="search-input" onclick="submitForm()">
    </div>


    <div class="avatar">
        @php
            $user = Auth::user();
        @endphp
        <img src="{{ $user->imageUrl() }}" />
        
    </div>
</div>

<script>
    function submitForm() {
        let form = document.getElementById('search');
        form.submit();
    }
</script>