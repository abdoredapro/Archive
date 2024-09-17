<input type="file" class="form-control hidden-input" id="photo" name="image" accept="image/*"
    onchange="displayImage(event)">

<div class="custom-button" onclick="document.getElementById('photo').click();">
    <p class="up">{{ $text }}</p>
</div>

@error('image')
<div class="text-center text-danger">{{ $message }}</div>
@enderror