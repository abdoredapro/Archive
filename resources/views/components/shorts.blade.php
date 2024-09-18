@foreach ($clips as $clip)
<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
    <div class="d-flex align-items-end flex-direction-column">
        


        <video {{-- id="my_video_1" --}} class="video-js" controls preload="auto" max-width="100%" width="300px"
            height="180px" {{-- height="20" --}} poster="{{ $file->image_url }}" data-setup="{}">
            <source src="{{ $clip->clipUrl() }}" type="video/mp4" />
            <source src="{{ $clip->clipUrl() }}" type="video/webm" />

        </video>
    </div>
    <div class="text-holder mt-2">
        <div class="duration text-info fw-bold text-end">{{ $clip->minute }}:{{ $clip->second }}</div>

        <div class="desc fw-bold text-end" id="{{ $clip->id }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$clip->id}}"
            style="cursor: pointer" >{{ $clip->name }}</div>

        {{-- Edit footage --}}

        @isset($canEdit)
            <x-show-footage :clip='$clip' :type='$canEdit'  />
        @endisset

        {{-- Edit footage --}}



    </div>
</div>
@endforeach