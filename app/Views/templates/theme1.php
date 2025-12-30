<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="generator" content="">
      <title>OTT::Admin::Panel</title>
      <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"/>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
      <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css?v='.date('dmy'))?>">
      <link rel="stylesheet" href="<?= base_url('public/assets/css/jquery-ui.css')?>">
      <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" />
      <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />
      <style>
         /*
         DEMO STYLE
         */
         @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
         a, a:hover, a:focus {
         color: inherit;
         text-decoration: none;
         transition: all 0.3s;
         }
         .navbar {
         padding: 15px 10px;
         background: #fff;
         border: none;
         border-radius: 0;
         margin-bottom: 40px;
         box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
         }
         .navbar-btn {
         box-shadow: none;
         outline: none !important;
         border: none;
         }
         .line {
         width: 100%;
         height: 1px;
         border-bottom: 1px dashed #ddd;
         margin: 40px 0;
         }
         /* ---------------------------------------------------
         SIDEBAR STYLE
         ----------------------------------------------------- */
         #sidebar {
         width: 225px;
         top: 0;
         left: 0;
         height: 100%;
         min-height: 100vh;
         z-index: 999;
         background: #000000;
         color: #000;
         transition: all 0.3s;
         }
         #sidebar.active {
         margin-left: -250px;
         }
         #sidebar .sidebar-header {
         padding: 8px;
         background: #000000;
         text-align: center;
         position: relative;
         margin-bottom: 0px;
         }
         #sidebar ul.components {
         padding: 0;
         }
         #sidebar ul p {
         color: #00b2ad;
         padding: 6px 10px 2px 10px;
         font-weight: 700;
         margin-bottom: 0px;
         }
         #sidebar ul li a {
         padding: 10px 20px;
         font-size: 14px;
         display: block;
         color: #afafaf;
         border-bottom: 1px solid #1b2430;
         font-weight: 500;
         }
         #sidebar ul li a:hover {
         color: #ffffff !important;
         background: #6da753;
         font-weight: 600;
         }
         #sidebar ul li.active > a, a[aria-expanded="true"] {
         color: #fff !important;
         background: #6da753;
         border-bottom: none !important;
         }
         a[data-toggle="collapse"] {
         position: relative;
         }
         a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {
         content: '\f105';
         display: block;
         position: absolute;
         right: 20px;
         top: 14px;
         font-family: 'Font Awesome 5 Free';
         font-size: 0.6em;
         font-weight: 600;
         }
         a[aria-expanded="true"]::before {
         content: '\f107';
         }
         ul ul a {
         font-size: 12px !important;
         padding-left: 30px !important;
         background: #fff;
         border-bottom: none !important;
         color: #4f4f4f !important;
         }
         ul.CTAs {
         padding: 20px;
         }
         ul.CTAs a {
         text-align: center;
         font-size: 0.9em !important;
         display: block;
         border-radius: 5px;
         margin-bottom: 5px;
         }
         a.download {
         background: #fff;
         color: #7386D5;
         }
         a.article, a.article:hover {
         background: #6d7fcc !important;
         color: #fff !important;
         }
         /* ---------------------------------------------------
         CONTENT STYLE
         ----------------------------------------------------- */
         #content {
         width: calc(100% - 225px);
         padding: 40px;
         min-height: 100vh;
         transition: all 0.3s;
         position: absolute;
         top: 0;
         right: 0;
         }
         #content.active {
         width: 100%;
         }
         .navbar-brand-img {
         width: 80px;
         }
         .wrapper{
         display: flex;
         }
         .side-menu{
         display: flex;
         flex-direction: column;
         }
         .content{
         display: flex;
         flex-direction: column;
         width: 100%;
         overflow: hidden;
         background: #fff;
         margin-bottom: 100px;
         padding-bottom: 100px;
         }
         .top-bar{
         background: #6db651;
         border-bottom: 1px solid #eaeaea;
         padding: 0 !important;
         margin-bottom: 10px;
         }
         .top-bar nav {
         padding: 11px;
         }
         .top-bar nav a{
         color: #000;
         padding: 0px 10px;
         font-size: 13px;
         }
         .tooltip-inner {
         background-color: #5a5a5a;
         color: #ffffff;
         }
         .tooltip-arrow {
         border-top-color: #5a5a5a;
         }
         /* ---------------------------------------------------
         MEDIAQUERIES
         ----------------------------------------------------- */
         @media (max-width: 768px) {
         .mobile-menu-header, 
         .mobile-menu-close{
         display: block;
         }
         .side-menu{
         display: block !important;
         position: fixed;
         top: 0;
         z-index: 9;
         }
         .top-bar {
         margin-top: 46px;
         }
         .top-bar nav {
         padding: 4px;
         display: none;
         }
         .top-bar .top-right-menu{
         position: absolute;
         top: 0px;
         right: 0px;
         display: flex;
         }
         .top-bar .top-right-menu .dropdown-menu.show{
         transform: none;
         }
         #sidebar {
         margin-left: -225px;
         }
         #sidebar.active {
         margin-left: 0;
         }
         #content {
         width: 100%;
         }
         #content.active {
         width: calc(100% - 225px);
         }
         #sidebarCollapse span {
         display: none;
         }
         .top-bar nav a {
         color: #4f4f4f;
         padding: 0px 6px;
         font-size: 10px;
         }
         }
      </style>
      <script type="text/javascript">
         var base_url = "<?= base_url()?>";
         var csrfName = "<?= csrf_token()?>";
         var csrfToken = "<?= csrf_hash()?>";
      </script>
   </head>


   <body>
      <div class="preloader parent_div" style="/* display: none; */">
         <div class="child_div">
            <div class="preloader_icon" style="display: block;">
               <div style="width: 150px;font-size: 20px;color: #ffffff;position: relative;top: 60px;left: -20px;">Please Wait...</div>
            </div>
         </div>
      </div>
      <div id="js_alert"></div>
      <div class="wrapper">
         <div class="fade-back"></div>
         <!-- menu bar for mobile-->
         <div class="mobile-menu-header">
            <div class="menu-toggle-btn" data-toggle="false">
               <i class="fa-solid fa-bars"></i>
               <img class="navbar-brand-img" src="<?= base_url('public/assets/img/temp_logo.jpg')?>">
            </div>
            <div class="top-menu-btn" data-toggle="false"><i class="fa-solid fa-chevron-down"></i></div>
         </div>
         <!-- side menu -->
         <?= $this->renderSection('side-menu')?>
         <div class="content">
            <?= $this->renderSection('top-menu')?>
            <div class="container">
               <?=  $this->renderSection('main-content');?>  
            </div>
         </div>





         <!-- password reset modal -->
         <div class="modal fade" id="updateUserPassword" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h6 class="modal-title">Update Password</h6>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <?php echo form_open('#', 'id="updatePasswordForm"')?>
                     <div class="mb-1">
                        <label>Old Password</label>
                        <input type="password" name="old_password" placeholder="Old Password" class="form-control">
                        <div class="validation-error" id="old_passwordErr"></div>
                     </div>
                     <div class="mb-1">
                        <label>New Password</label>
                        <input type="password" name="new_password" placeholder="New Password" class="form-control">
                        <div class="validation-error" id="new_passwordErr"></div>
                     </div>
                     <div class="mb-1">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                        <div class="validation-error" id="confirm_passwordErr"></div>
                     </div>
                     <div id="loadData"></div>
                     <div class="jsResponseMsg"></div>
                     <div class="text-right mt-3">
                        <button class="btn theme-btn" type="submit">Update Password</button>
                     </div>
                     <?php echo form_close()?>
                  </div>
               </div>
            </div>
         </div>



          
      </div>
      <div class="text-center">©<?= date('Y')?> Me</div>
      <footer>
         <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
         <script src="https://vjs.zencdn.net/7.20.3/video.js"></script>
         <script type="text/javascript">
            $(document).ready(function () {
               $(function () {
                 $('[data-toggle="tooltip"]').tooltip()
               });
            
               //datepicker
               var datepicker = $('.datepicker').datepicker({
                  format: 'dd-mm-yyyy', // Date format
                  autoclose: true, // Close the datepicker when a date is selected
                  todayHighlight: true,
                   
                  orientation: "bottom auto" // Position the datepicker dropdown below the input field
              });
            
            
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });
            
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar, #content').toggleClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
         </script>
         <script type="text/javascript">
            $('.menu-toggle-btn').click(function(){
               $('#sidebar').css('margin-left', '0px');
               $('.mobile-menu-close').addClass('active-close');
               $('.menu-toggle-btn').attr('data-toggle', 'true');
               fadeBack('active');
            });
            $('.mobile-menu-close').click(function(){
               $('#sidebar').css('margin-left', '-225px');
               $('.mobile-menu-close').removeClass('active-close');
               $('.menu-toggle-btn').attr('data-toggle', 'false');
               fadeBack('close');
            });
            $('.top-menu-btn').click(function(){
               
               if($(this).attr('data-toggle')==='false'){
                  $('.top-bar nav').css('display', 'block');
                  $(this).attr('data-toggle', 'true');
               }else{
                  $('.top-bar nav').css('display', 'none');
                  $(this).attr('data-toggle', 'false');
               }
            });
            
            //close menu when click outside
            $(document).on('click', function (e) {
               e.stopPropagation();
            
               if($(window).width() <=768){
                  const menu = $('.side-menu');
                  const menuTrigger  = $('.menu-toggle-btn');
                  if (!menu.is(event.target) && menu.has(event.target).length === 0 && !menuTrigger.is(event.target) && menuTrigger.has(event.target).length === 0) {
                     $('#sidebar').css('margin-left', '-225px');
                     $('.mobile-menu-close').removeClass('active-close');
                     $('.menu-toggle-btn').attr('data-toggle', 'false');
                     fadeBack('close');
                   }
               }
               
            });

           $(document).ready(function () {
             $('.submenu-toggle').on('click', function (e) {
               e.preventDefault();
               var target = $(this).data('target');
               var submenu = $(target);
               submenu.collapse('toggle');
             });
           });

            
            function fadeBack(operation) {
                  if(operation==='active'){
                     $('.fade-back').addClass('active');
                  }else{
                     $('.fade-back').removeClass('active');
                  }
               }
         </script>
         <script src="<?php echo base_url('public/assets/js/common.js?v='.date('dmyHi'))?>"></script>
         <script src="<?php echo base_url('public/assets/js/autocomplete/jquery-ui.js')?>"></script>
         <script src="<?php echo base_url('public/assets/js/autocomplete/jquery-ui.js')?>"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
         <script type="text/javascript">
            $('#dataTable1').DataTable({
              "aaSorting": []
            });
            $('#dataTable2').DataTable({
              "aaSorting": []
            });
         </script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
         <script>
            $(document).ready(function() {
                $('.btSelect').selectpicker();
            });
         </script>
         <?=  $this->renderSection('js');?>
      </footer>
   </body>
</html>