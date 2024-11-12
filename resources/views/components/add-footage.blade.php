
<div class="video-trimmer">
    <div class="row align-items-center">
            <div class="col-md-3">
                <div class="d-flex align-items-center video-settings">
                    <i class="fa-solid fa-gears"></i>
                    <h3 class="m-2">اعدادات الفديو</h3>
                </div>
            </div>

            <div class="col-md-3 ">
                <div class="skip-seconds d-flex align-items-center">
                    <label for="skip-time">عدد ثواني التخطي</label>
                    <input type="number" id="skipSeconds" class="skip-input m-2" min="1" value="5">
                </div>
            </div>

            <div class="col-md-6">
                <div class="controls">
                    <p class="control-button forward" onclick="goForward()"><i class="fa-solid fa-forward "></i></p>

                    <p class="control-button pause" onclick="pause()">
                        <i class="fa-solid fa-pause "></i>
                    </p>

                    <p class="control-button back" onclick="goBack()"><i class="fa-solid fa-backward"></i></p>
                </div>
            </div>
    </div>

        <div class="time-inputs">
            <p class="time-button" onclick="startDate()">بداية</p>
            <div class="time-box">
                <input type="text" id="startTime" name="startTime" class="time-display" value="00:00:00" readonly>
            </div>
        
            <p class="time-button" onclick="endDate()">نهاية</p>
            <div class="time-box">
                <input type="text" id="endTime" name="endTime" class="time-display" value="00:00:00" readonly>
            </div>
        </div>
        
        <input type="text" class="footage-name" placeholder="أدخل اسم المقطع">
        <p class="add-clip-button mt-4" onclick="addFootage()">إضافة المقطع</لا>

</div>