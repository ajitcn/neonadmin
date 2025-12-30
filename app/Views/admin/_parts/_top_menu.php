<div class="d-flex flex-column flex-md-row top-bar">
   <div class="my-0 mr-md-auto">
      <nav>
      <a class="mob-link" href="#">Upload Subtitle</a>
      <a class="mob-link" href="#"></a>
       
      
   </nav>
   </div>
   
  <div class="top-right-menu">
 
     
     <div class="custom-dropdown">
       <button class="dropdown-toggle" type="button" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="profile-title"><?= ucfirst(substr(session('user_name'), 0,1)) ?></span>
       </button>
       <div class="dropdown-menu profileDropdownList" aria-labelledby="profileDropdown">
        <div class="dropdown-item">Welcome! <?= ucfirst(session('user_name')) ?></div>
          
         <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateUserPassword" >Reset Password</a>
          
         <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= base_url('admin/account/logout-user')?>"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
       </div>
     </div>
   </div>
</div>

 