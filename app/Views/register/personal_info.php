<div class="d-flex">
  <hr class="my-auto flex-grow-1">
  <div class="px-4">PERSONAL INFORMATION</div>
  <hr class="my-auto flex-grow-1">
</div>
<br>
<div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="first_name" class="required">First name</label>
      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="middle_name" class="required">Middle Name</label>
      <div class="input-group">
        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" required>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="last_name" class="required">Last name</label>
      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6 mb-3">
        <label class="required">Birthdate:</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" name="birthdate" data-target="#reservationdate" required/>
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label class="required">Gender:</label>
        <div class="row">
            <div class="form-check form-check-inline control-label gender">
                <input class="form-check-input" type="radio" name="gender" id="male" value="1" checked>
                <label class="form-check-label" for="gender">
                    Male
                </label>
            </div>
            <div class="form-check form-check-inline gender">
                <input class="form-check-input" type="radio" name="gender" id="female" value="2" checked>
                <label class="form-check-label" for="gender">
                    Female
                </label>
            </div>
        </div>
    </div>
</div>

<!-- address -->
<div class="form-group">
    <label class="required">Address</label>
    <textarea name="address" class="form-control" rows="3" placeholder="Enter ..." required></textarea>
</div>

<div class="form-row">
    <!-- E-mail address -->
    <div class="col">
      <label class="required">E-mail address</label>
      <input type="email" class="form-control" placeholder="" name="email" required>
    </div>
    <!-- Contact Number -->
    <div class="col">  
      <label class="required">Contact Number</label>
      <input type="text" class="form-control" placeholder="" name="contact_number" required>
    </div>
</div>

<!-- Account Info -->
<br>
<div class="d-flex">
  <hr class="my-auto flex-grow-1">
  <div class="px-4">ACCOUNT INFORMATION</div>
  <hr class="my-auto flex-grow-1">
</div>
<br>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="username" class="required">Username</label>
      <input type="text" class="form-control  <?php if(session()->getFlashdata('user')) echo 'is-invalid';?>" id="username" name="username" placeholder="Username" required>
      <?php if(session()->getFlashdata('user')): ?>
        <small id="emailHelp" class="form-text text-danger"><?= session()->getFlashdata('user') ?></small>
      <?php endif; ?>
    </div>
    <div class="form-group col-md-6">
      <label for="password" class="required">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>
</div>

<div class="form-group">
    <label for="exampleInputFile">Profile Picture</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input <?php if(!empty($errors['image'])) echo 'is-invalid';?>" id="annImage" name="image" required>
            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
    </div>
    <?php if(!empty($errors['image'])): ?>
        <small id="emailHelp" class="form-text text-danger"><?= $errors['image']?></small>
    <?php endif; ?>
</div>