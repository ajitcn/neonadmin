<?= $this->extend('templates/theme1')?>
 
 <?= $this->section('side-menu')?>
 	<?= $this->include('admin/_parts/_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('top-menu')?>
    <?= $this->include('admin/_parts/_top_menu')?>
 <?= $this->endSection()?>

<?= $this->section('main-content')?>
<div class="row">
   
   <div class="col-md-4"><h3 class="custom-breadcrumb">Home Page Setup</h3></div>
    <div class="col-md-8 text-right"> 
      <button class="btn thin-btn" data-toggle="modal" data-target="#editSectionModal" type="button">Edit Session</button>
      <button class="btn thin-btn" data-toggle="modal" data-target="#newSectionModal" type="button">+ New Session</button>
      
   </div> 
</div>
<div class="main-content">

   <?= display_session_msg()?>
   
   <section class="section">

      <div class="row">
         <div class="col-md-3">
            <h4><strong>Banner Title</strong></h4>
             <ul class="nav2">
               <?php foreach($setionRecords as $sec):?>
                  <li class="nav-item <?= strcasecmp($currentSection, $sec->section_name)===0? 'active' : ''?>">
                     <a class="nav-link position-relative" href="<?= base_url('admin/home-page-setup/'. $sec->section_name)?>"><?= ucfirst($sec->section_name)?> <span class="status-indicator badge badge-<?= cssClass($sec->status)?>"></span></a>
                 </li>
               <?php endforeach?>
              
              
            </ul>
         </div>
         <div class="col-md-9">
            <div id="load-home-setup" class="mb-5">
               <?= $trending?>
               <!-- ajax -->
                  
            </div>


             <?= form_open('', 'id="homePageSetupForm" autocomplete="off"')?>
            <input type="hidden" name="section" value="<?= $currentSection?>">
            <input type="hidden" name="status" value="active">
            <div class="border p-3"  >
               <label>Add New Item</label>
               <div class="input-group mb-3">
                  <div class="input-group-append mr-2">
                   <select name="content_type" class="form-control">
                     <option value="">-- Content Type --</option>
                     <option value="BANNER">Banner</option>
                     <option value="VERTICAL">Vertical</option>
                     <option value="HORIZONTAL">Horizontal</option> 
                   </select>
                 </div>
                 <div class="input-group-append mr-2">
                 <select name="layout_type" class="form-control">
                     <option value="">-- Layout Type --</option>
                     <option value="Landscape">Landscape</option>
                     <option value="Portrait">Portrait</option> 
                   </select>
                 </div>
                 
                 <div class="input-group-append mr-2">
                   <select name="position_order" class="form-control">
                     <option value="">-- Position No. --</option>
                      <?php for ($i=1; $i <=10 ; $i++):?>
                        <option value="<?= $i?>"><?= $i?></option>
                      <?php endfor?>
                   </select>
                 </div>
                 
               </div>
               <div class="input-group mb-3">
                   
                 <input type="text" class="form-control" id="mediaContentSearch" name="media_content" placeholder="Search Media...">
                 <div class="input-group-append">
                   <button  class="input-group-text theme-btn" type="submit">Add To List</button>
                 </div>
               </div>
               
               <div class="validation-error" id="content_typeErr"></div>
               <div class="validation-error" id="layout_typeErr"></div>
               <div class="validation-error" id="position_orderErr"></div>
               <div class="validation-error" id="media_contentErr"></div>

              
               <div id="recentMedia" style="display:none;">
                  <h5 class="text-muted">Choose from recent media list</h5>
                  <ul class="shortMediaList">
                     <?php foreach($recentMediaContents as $media):?>
                     <li onclick="$('#mediaContentSearch').val('<?= $media->title?>')">
                        <img class="img-thumbnail" src="<?= $media->thumbnail_url?>">
                        <h5 class="mt-2 text-center"><?= $media->title?></h5>
                     </li>
                     <?php endforeach?>
                  </ul>
               </div>
                <button class="btn btn-sm btn-secondary" type="button" onclick="$('#recentMedia').toggle()">See Recent Media</button>
            </div>
            <?= form_close();?>
            
         </div>

      </div>
       
     

      

     
   </section>
   
</div>





<!-- modal section -->
<div class="modal fade" id="editPageSetupModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Edit Page Setup</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('#', 'id="editPageSetupForm"')?> 
            
            <input type="hidden" name="section" value="<?= $currentSection?>">
            <input type="hidden" name="status" value="active">
            <input type="hidden" name="page_id" value="">
            <div class="border p-3" style="max-width:500px">
               <div class="input-group mb-3">
                  <div class="input-group-append mr-2">
                   <select name="content_type" class="form-control">
                     <option value="">-- Content Type --</option>
                     <option value="BANNER">Banner</option>
                     <option value="VERTICAL">Vertical</option>
                     <option value="HORIZONTAL">Horizontal</option> 
                   </select>
                 </div>
                 <div class="input-group-append mr-2">
                 <select name="layout_type" class="form-control">
                     <option value="">-- Layout Type --</option>
                     <option value="Landscape">Landscape</option>
                     <option value="Portrait">Portrait</option> 
                   </select>
                 </div>
                 
                 <div class="input-group-append mr-2">
                   <select name="position_order" class="form-control">
                     <option value="">-- Position No. --</option>
                      <?php for ($i=1; $i <=10 ; $i++):?>
                        <option value="<?= $i?>"><?= $i?></option>
                      <?php endfor?>
                   </select>
                 </div>
                 
               </div>
               <div class="input-group mb-3">
                   
                 <input type="text" class="form-control" id="mediaContentSearch" name="media_content" placeholder="Search Media...">
                 <div class="input-group-append">
                   <button  class="input-group-text theme-btn" type="submit">Add To List</button>
                 </div>
               </div>
               <div class="validation-error" id="content_typeErr"></div>
               <div class="validation-error" id="layout_typeErr"></div>
               <div class="validation-error" id="position_orderErr"></div>
               <div class="validation-error" id="media_contentErr"></div>
            </div>

            <div class="jsResponseMsg"></div>
            <div class="text-right mt-3">
               <button class="btn theme-btn" type="submit">Update</button>
            </div>
            <?php echo form_close()?>
         </div>
      </div>
   </div>
</div>



 
<!-- Modal Section Start -->

<?= view('admin/pages/_home_page_setup_modals')?>

<!-- Modal Section End -->


<?= $this->endSection()?>