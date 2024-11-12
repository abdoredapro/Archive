{{-- @foreach ($clips as $clip)
<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
    <div class="d-flex align-items-end flex-direction-column">
        


        <video  class="video-js" controls preload="auto" max-width="100%" width="300px"
            height="180px" poster="{{ $file->image_url }}" data-setup="{}">
            <source src="{{ $clip->clipUrl() }}" type="video/mp4" />
            <source src="{{ $clip->clipUrl() }}" type="video/webm" />

        </video>
    </div>
    <div class="text-holder mt-2">
        <div class="duration text-info fw-bold text-end">{{ $clip->minute }}:{{ $clip->second }}</div>

        <div class="desc fw-bold text-end" id="{{ $clip->id }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$clip->id}}"
            style="cursor: pointer" >{{ $clip->name }}</div>

        {{-- Edit footage --}}
{{-- 
        @isset($edit)
            <x-show-footage :clip='$clip' :type='$edit'  />
        @endisset --}}

        {{-- Edit footage --}}


{{-- 
    </div>
</div>
@endforeach --}} 

<div class="video-container">
    
    @foreach ($clips as $index => $clip)
        <div class="video-box">
            <div class="video-duration">{{ $clip->time ?? '00:00:00' }}</div>
            <video controls class="clip-video" id="video-{{ $index }}" muted data-start-time="{{ $clip->time ?? '00:00:00' }}">
                <source src="{{ $clip->clipUrl() }}" type="video/mp4">
                متصفحك لا يدعم الفيديو.
            </video>
            <div class="video-title">{{ $clip->name }}</div>
        </div>
    @endforeach

</div>

