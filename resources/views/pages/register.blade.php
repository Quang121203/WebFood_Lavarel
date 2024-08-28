@extends('layouts.master')

@section('content')
<!-- <section class="form-container">
   <form onsubmit="return false;">
      <h3>register now</h3>
      <input type="text" name="name"  placeholder="enter your name" class="box" maxlength="50">
      <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50"
         oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" required placeholder="enter your phone number" class="box" min="0" maxlength="12">
      <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50"
         oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirm your password" class="box" maxlength="50"
         oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" name="submit" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>
</section> -->

<div class="bs-stepper">
  <div class="bs-stepper-header" role="tablist">
    <div class="step" data-target="#step-1">
      <button type="button" class="step-trigger" role="tab" id="steppertrigger1" aria-controls="step-1">
        <span class="bs-stepper-circle">
          <span class="fas fa-user" aria-hidden="true"></span>
        </span>
        <span class="bs-stepper-label">User</span>
      </button>
    </div>
    <div class="line"></div>

    <div class="step" data-target="#step-2">
      <button type="button" class="step-trigger" role="tab" id="steppertrigger2" aria-controls="step-2">
        <span class="bs-stepper-circle">
          <span class="fas fa-map-marked" aria-hidden="true"></span>
        </span>
        <span class="bs-stepper-label">Address</span>
      </button>
    </div>
    <div class="line"></div>

    <div class="step" data-target="#step-3">
      <button type="button" class="step-trigger" role="tab" id="steppertrigger3" aria-controls="step">
        <span class="bs-stepper-circle">
          <span class="fas fa-save" aria-hidden="true"></span>
        </span>
        <span class="bs-stepper-label">Submit</span>
      </button>
    </div>
  </div>
  <div class="bs-stepper-content">
    <section class="form-container">
      <form onsubmit="return false;" id="form_register">
        <div id="step-1" class="content" role="tabpanel" aria-labelledby="steppertrigger1">
          <h3>register</h3>
          <input type="email" name="email" placeholder="enter your email" class="box" maxlength="255"
            oninput="this.value = this.value.replace(/\s/g, '')">
          <input type="password" name="password" placeholder="enter your password" class="box" maxlength="255"
            oninput="this.value = this.value.replace(/\s/g, '')">
          <input type="password" name="cpass" placeholder="confirm your password" class="box" maxlength="255"
            oninput="this.value = this.value.replace(/\s/g, '')">
          <input type="submit" value="next" name="submit" class="btn" onclick="stepUser()">
          <p>already have an account? <a href="/login">login now</a></p>
        </div>

        <div id="step-2" class="content" role="tabpanel" aria-labelledby="steppertrigger2">
          <input type="text" name="name" placeholder="enter your name" class="box" maxlength="255">
          <input type="number" name="phone" placeholder="enter your phone number" class="box" min="0" maxlength="11">
          <input type="text" name="address" placeholder="enter your address" class="box" maxlength="255">
          <input type="submit" value="back" name="submit" class="btn" onclick="stepper.previous()">
          <input type="submit" value="next" name="submit" class="btn" onclick="stepInfo()">
        </div>

        <div id="step-3" class="content" role="tabpanel" aria-labelledby="steppertrigger3">
          <h3>Nội dung Bước 3</h3>
          <p>Thông tin cho bước 3.</p>
          <!-- <button class="btn btn-secondary" onclick="stepper.previous()">
            Quay lại
          </button> -->
          <button class="btn btn-success" onclick="register()">Hoàn tất</button>
        </div>
      </form>
    </section>
  </div>
</div>

@endsection

@push('my_script')
  <script>
    var stepUser = () => {
    var formData = $("#form_register").serializeArray();
    var email = formData[0].value.trim();
    var pass = formData[1].value.trim();
    var cpass = formData[2].value.trim();

    if (!email || !pass || !cpass) {
      toast("please enter input")
    }
    else if (pass != cpass) {
      toast("password not equal confirm password")
    }
    else {
      stepper.next()
    }
    }

    var stepInfo = () => {
    var formData = $("#form_register").serializeArray();
    var name = formData[3].value.trim();
    var phone = formData[4].value.trim();
    var address = formData[5].value.trim();

    if (!name || !phone || !address) {
      toast("please enter input")
    }
    else {
      stepper.next()
    }
    }

    var register = () => {
    var formData = $("#form_register").serialize();
    $.ajax({
      url: baseUrl + "/register",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (data) {
      toast(data['msg'], data['success']);
      if (data['success']) {
        $(`#form_register`).trigger('reset');
        window.location.href = baseUrl + '/login';
      }
      else {
        stepper.to(1)
      }
      },
      error: function (data) {
      alert("Có lỗi xảy ra...", "error");
      }
    });
    }
  </script>
@endpush