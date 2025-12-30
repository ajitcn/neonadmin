<div class="mb-1">
   <label>User Name</label>
   <input type="hidden" name="user_id" value="<?= $user->id?>">
   <input type="text" class="form-control" name="user_name" placeholder="User Name" value="<?= $user->user_name?>">
   <div class="validation-error" id="user_nameErr"></div>
</div>
<div class="mb-1">
   <label>Email Id</label>
   <input type="text" class="form-control" name="user_email" placeholder="Email Id" value="<?= $user->email_id?>">
   <div class="validation-error" id="user_emailErr"></div>
</div>
<div class="mb-1">
   <label>Mobile Number</label>
   <input type="text" class="form-control" name="user_mobile" placeholder="Mobile Number" value="<?= $user->mobile_number?>">
   <div class="validation-error" id="user_mobileErr"></div>
</div>
<div class="mb-1">
   <label>Set Password</label>
   <input type="password" class="form-control" name="user_password" placeholder="Set Password">
   <div class="validation-error" id="user_passwordErr"></div>
</div>
<div class="mb-1">
   <label>Status</label>
   <select class="form-control" name="status">
     <option value="1" <?= set_selected_option('1', $user->is_active)?>>Active</option>
     <option value="0" <?= set_selected_option('0', $user->is_active)?>>InActive</option>
   </select>
   <div class="validation-error" id="statusErr"></div>
</div>

<div  class="mb-1 p-3 mt-3" style="background: #e0e0e0;">
   <label>Set User Access</label>
   <h5 class="text-info">Student: </h5>
   <!-- student -->
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="checkbox" id="eua1" name="user_access[]" value="Create Student" <?= set_checkbox_opt_arr('Create Student', $user->userAccess)?>>
     <label class="form-check-label" for="eua1">Create Student</label>
   </div>
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="checkbox" id="eua2" name="user_access[]" value="View Student" <?= set_checkbox_opt_arr('View Student', $user->userAccess)?>>
     <label class="form-check-label" for="eua2">View Student</label>
   </div>
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="checkbox" id="eua3" name="user_access[]" value="Update Student" <?= set_checkbox_opt_arr('Update Student', $user->userAccess)?>>
     <label class="form-check-label" for="eua3">Update Student</label>
   </div>

   <h5 class="text-info">Book: </h5>
   <!-- book -->
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="checkbox" id="eua4" name="user_access[]" value="Create Book" <?= set_checkbox_opt_arr('Create Book', $user->userAccess)?>>
     <label class="form-check-label" for="eua4">Create Book</label>
   </div>
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="checkbox" id="eua5" name="user_access[]" value="View Book" <?= set_checkbox_opt_arr('View Book', $user->userAccess)?>>
     <label class="form-check-label" for="eua5">View Book</label>
   </div>
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="checkbox" id="eua6" name="user_access[]" value="Update Book" <?= set_checkbox_opt_arr('Update Book', $user->userAccess)?>>
     <label class="form-check-label" for="eua6">Update Book</label>
   </div>

   <h5 class="text-info">Book Assignment: </h5>
   <!-- assignment -->
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="checkbox" name="user_access[]" id="eua7" value="Create Assignment" <?= set_checkbox_opt_arr('Create Assignment', $user->userAccess)?>>
     <label class="form-check-label" for="eua7">Create Assignment</label>
   </div>
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="checkbox" name="user_access[]" id="eua8" value="View Assignment" <?= set_checkbox_opt_arr('View Assignment', $user->userAccess)?>>
     <label class="form-check-label" for="eua8">View Assignment</label>
   </div>
   <div class="form-check form-check-inline">
     <input class="form-check-input" type="checkbox" name="user_access[]" id="eua9" value="Update Assignment" <?= set_checkbox_opt_arr('Update Assignment', $user->userAccess)?>>
     <label class="form-check-label" for="eua9">Update Assignment</label>
   </div>
</div>
