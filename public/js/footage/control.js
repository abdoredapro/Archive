let video = document.getElementById("uploaded-video");
let pauseBtn = document.querySelector(".video-trimmer .controls .pause");
let startDateInput = document.querySelector(".video-trimmer #startTime");

let endDateInput = document.querySelector(".video-trimmer #endTime");


function goBack() {
    let skipSeconds = document.querySelector(".video-trimmer #skipSeconds").value;

    let forwardSeconds = skipSeconds;

    video.currentTime = Math.min(
        video.currentTime - forwardSeconds,
        video.duration
    );

}

function pause() {

    if (video.paused) {
        video.play();
    } else {
        video.pause();
    }
}

function goForward() {

    let skipSeconds = parseInt(
        document.querySelector(".video-trimmer #skipSeconds").value
    );

    let forwardSeconds = skipSeconds;


    video.currentTime = Math.min(
        video.currentTime + forwardSeconds,
        video.duration
    );
}

function startDate()
{

    const totalSeconds = Math.floor(video.currentTime);

    const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, "0"); 
    const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(
        2,
        "0"
    );
    const seconds = String(totalSeconds % 60).padStart(2, "0");

    startDateInput.value = `${hours}:${minutes}:${seconds}`;

}

function endDate() {

    const totalSeconds = Math.floor(video.currentTime);

    const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, "0");

    const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(
        2,
        "0"
    );
    const seconds = String(totalSeconds % 60).padStart(2, "0");

    endDateInput.value = `${hours}:${minutes}:${seconds}`;
}


function addFootage() {
    let StartTime = document.querySelector(".video-trimmer #startTime").value;
    let EndTime = document.querySelector(".video-trimmer #endTime").value;
    let FootageName = document.querySelector(
        ".video-trimmer .footage-name"
    ).value;
    let fileId = document.querySelector("#fileId").value;

    let Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {
            toastr.success("تم اضافة المقطع!");
        }
    }
    Request.open("POST", AddFootage, true);
    Request.setRequestHeader("Content-Type", 'application/x-www-form-urlencoded');
    Request.setRequestHeader("X-CSRF-TOKEN", csrf);
    Request.send(
        `StartTime=${StartTime}&EndTime=${EndTime}&FootageName=${FootageName}&fileId=${fileId}`
    );


}
