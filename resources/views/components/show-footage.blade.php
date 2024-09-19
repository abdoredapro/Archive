<style>
    label.upload, 
    label.upload:hover {
        background-color: #EDF2F6 !important;
        border: none;
        color: #707B81;
        text-align: center
    }

</style>

<div class="modal fade" id="staticBackdrop{{$clip->id}}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            
            <div class="modal-body">

                <form action="{{ route('dashboard.file.clip.delete', ['id' => $clip->id, 'type' => $type]) }}" method="POST" class="clip-delete-form" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-danger">حذف نهائى</button>
                </form>

                <form class="clip" method="POST" action="{{ route('dashboard.file.clip.update', ['id' => $clip->id, 'type' => $type]) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group d-flex align-items-center justify-content-center mb-3">
                        <label for="inputField" class="btn mt-2 text-center upload" style="">رفع مقطع اخر</label>
                        <input type="file" id="inputField" name="clip" style="display:none" onchange="displayVideos(event)">
                    </div>

                    <div class="mb-3 text-center">
                        <video style="max-width: 100%" class="video-js clip-video-upload" controls preload="auto" width="300px"
                            height="180px" data-setup="{}">
                            <source src="{{ $clip->clipUrl() }}" type="video/mp4" />
                            <source src="{{ $clip->clipUrl() }}" type="video/webm" />
                        </video>

                        <video style="max-width: 100%;margin:auto; display: none" controls preload="auto" width="300px"
                            height="180px"  class="clip-uploading">
                        </video>

                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="recipient-name" class="col-form-label">الاسم</label>
                                <input type="text" name="name" class="form-control" id="recipient-name"
                                    value="{{ $clip->name }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name" class="col-form-label">الدقيقه</label>
                                <input type="text" name="minute" class="form-control" id="recipient-name"
                                    value="{{ $clip->minute }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name" class="col-form-label">الثانيه</label>
                                <input type="text" name="second" class="form-control" id="recipient-name"
                                    value="{{ $clip->second }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">وصف المقطع</label>
                        <textarea required class="form-control" name="description"
                            id="message-text">{{ $clip->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <div class="text-danger text-center error" style="display: none">الرجاء ملئ جميع البيانات</div>
                    </div>


            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" class="SaveBtn">حفظ</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>

                </div>

            </form>
        </div>
    </div>
</div>


<script>


    function displayVideos(event) {

        
        let video = document.querySelector('form.clip .clip-video-upload');

        let clipUploading = document.querySelector('form.clip .clip-uploading');

        video.style.display = 'none';

        clipUploading.style.display = 'block';

        let reader = new FileReader();

        reader.onload = function (e) {


            clipUploading.src = e.target.result;

        }

        reader.readAsDataURL(event.target.files[0]);

    }



</script>