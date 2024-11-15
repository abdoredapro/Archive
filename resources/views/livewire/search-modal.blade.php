<div class="p-4">
    <div class="card mb-3 border-0">
        <h5 class="card-header mb-1">
            <h5 class="card-title text-center">
                الفلتر
            </h5>
        </h5>
        <div class="card-body">
            <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <label for="nameWithTitle" class="form-label">
                        كلمة البحث
                    </label>
                    <input type="text"
                        id="nameWithTitle"
                        class="form-control"
                        placeholder="كلمة البحث"
                        wire:model.live="form.keyword"
                    />
                </div>
                <div class="col-md-4">
                    <label for="dobWithTitle" class="form-label">
                        النوغ
                    </label>
                    <select id="dobWithTitle" class="form-select" wire:model.live="form.filterType">
                        <option value="">اختار النوع</option>
                        <option value="1">فيلم</option>
                        <option value="2">ملف</option>
                        <option value="3">مقطع</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="statusWithTitle" class="form-label">
                        سنه الاصدار
                    </label>
                    <input type="text" id="statusWithTitle" class="form-control" placeholder="سنه الاصدار"
                        wire:model.live="form.releaseYear" />
                </div>

            </div>

            <div class="row g-2 mb-2">

                <div class="col-md-4">
                    <label for="statusWithTitle" class="form-label">
                        رقم الشريط
                    </label>
                    <input type="text" id="statusWithTitle" class="form-control" placeholder="رقم الشريط"
                        wire:model.live="form.tap_number" />
                </div>


                <div class="col-md-4">
                    <label for="statusWithTitle" class="form-label">
                        فريق العمل / الاعداد
                    </label>
                    <input type="text" id="statusWithTitle" class="form-control" placeholder="فريق العمل / الاعداد"
                        wire:model.live="form.team" />
                </div>

                <div class="col-md-4">
                    <label for="nameWithTitle" class="form-label">
                        تاريخ نشر من
                    </label>
                    <input type="date"
                        id="nameWithTitle"
                        class="form-control"
                        placeholder="من تاريخ"
                        wire:model.live="form.fromDate"
                    />
                </div>
                <div class="col-md-4">
                    <label for="dobWithTitle" class="form-label">
                        تاريخ نشر الى
                    </label>
                    <input type="date"
                        id="dobWithTitle"
                        class="form-control"
                        placeholder="الى تاريخ"
                        wire:model.live="form.toDate"
                    />
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3 border-0">
        <h5 class="card-header">
            <h5 class="card-title text-center">
                نتائج البحث
            </h5>
        </h5>

        <div class="card-body">
            <div class="row g-4">

                    @foreach($films as $film)
                        <div class="col-md-3">
                            <div class="card" style="height: 100%;">
                                <a href="{{ route('dashboard.film.show', $film->id) }}">
                                    <img src="{{ $film->image_url }}"
                                        class="card-img-top"
                                        alt="{{ $film->name }}"
                                        style="height: 400px; object-fit: cover; width: 100%;"
                                    />
                                </a>
                                <div class="card-footer" id="card-footer">
                                    <h5 class="card-title">{{ $film->name }}</h5>
                                    <p class="card-text mt-3 mb-3">{{ Str::limit($film->film_script, 100) }}</p>
                                    <a href="{{ route('dashboard.film.show', $film->id) }}" class="btn btn-primary">
                                        المزيد
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($files as $file)
                        <div class="col-md-3">
                            <div class="card h-100 d-flex flex-column" >
                                <a href="{{ route('dashboard.file.show', $file->id) }}">
                                    <img src="{{ $file->image_url }}"
                                        class="card-img-top"
                                        alt="{{ $file->name }}"
                                        style="height: 400px; object-fit: cover; width: 100%;"
                                    />
                                </a>
                                <div class="card-footer" id="card-footer">
                                    <h5 class="card-title">{{ $file->name }}</h5>
                                    <p class="card-text mt-3 mb-3">{{ Str::limit($file->description, 100) }}</p>
                                    <a href="{{ route('dashboard.file.show', $file->id) }}" class="btn btn-primary mt-auto">
                                        المزيد
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- <div class="alert alert-warning text-center" role="alert">
                        لا يوجد نتائج
                    </div> --}}


            </div>
        </div>
    </div>
</div>
