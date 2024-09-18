<div class="row g-4">
    <div class="col-sm-12 col-md-6">
        <div class="collector text-end">
            <div class="main-head">سنة الاصدار</div>
            <input class="second-modal-form" type="text" id="release-year" name="release_year" placeholder="2024"
                value="{{ old('release_year', $file->release_year) }}">
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="collector text-end">
            <div class="main-head">نوع الشريط</div>
            <input class="second-modal-form" type="text" id="tape-type" name="tap_type"
                value="{{ old('release_year', $file->release_year) }}">
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="collector text-end">
            <div class="main-head">مدير الانتاج</div>
            <input class="second-modal-form" type="text" id="director-name" name="production_manager"
                placeholder="حسن يوسف" value="{{ old('production_manager', $file->production_manager) }}">
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="collector text-end">
            <div class="main-head">رقم الشريط</div>
            <input class="second-modal-form" type="text" id="tape-number" name="tap_number"
                value="{{ old('tap_number', $file->tap_number) }}">
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="collector text-end">
            <div class="main-head">مشروع/ مستفيد</div>
            <input class="second-modal-form" type="text" id="benefit" name="project_beneficiary" placeholder="حسن يوسف"
                value="{{ old('project_beneficiary', $file->project_beneficiary) }}">
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="collector text-end">
            <div class="main-head">مهندس الصوت</div>
            <input class="second-modal-form" type="text" id="sound-eng" name="sound_engineer"
                value="{{ old('sound_engineer', $file->sound_engineer) }}">
        </div>
    </div>
</div>