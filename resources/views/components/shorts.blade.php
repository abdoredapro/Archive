<div class="footage">
        <div class="main-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="m19.65 6.5l-2.74-3.54l3.93-.78l.78 3.92zm-2.94.57l-2.74-3.53l-1.97.39l2.75 3.53zM19 13c1.1 0 2.12.3 3 .81V10H2v10a2 2 0 0 0 2 2h9.81c-.51-.88-.81-1.9-.81-3c0-3.31 2.69-6 6-6m-7.19-4.95L9.07 4.5l-1.97.41l2.75 3.53zM4.16 5.5l-.98.19a2.01 2.01 0 0 0-1.57 2.35L2 10l4.9-.97zM20 18v-3h-2v3h-3v2h3v3h2v-3h3v-2z" />
            </svg>
            <h3 class="title">اللقطات</h3>
        </div>
        <div class="text-center">
            <div class="row">
                @foreach ($clips as $clip)
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="d-flex align-items-end flex-direction-column">

                {{-- <video id="player" playsinline controls data-poster="/path/to/poster.jpg">
                    <source src="/path/to/video.mp4" type="video/mp4" />
                    <source src="/path/to/video.webm" type="video/webm" />

                    <!-- Captions are optional -->
                    <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en" default />
                </video> --}}

                <video
                    {{-- id="my_video_1" --}}
                    class="video-js"
                    controls
                    preload="auto"
                    max-width="100%" width="300px" height="180px"
                    {{-- height="20" --}}
                    poster="{{ $film->image_url }}"
                    data-setup="{}"
                >
                    <source src="{{ $clip->clipUrl() }}" type="video/mp4" />
                    <source src="{{ $clip->clipUrl() }}" type="video/webm" />

                </video>
                    </div>
                    <div class="text-holder">
                        <div class="duration">{{ $clip->minute }}:{{ $clip->second }}</div>
                        <div class="desc">{{ $clip->name }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>