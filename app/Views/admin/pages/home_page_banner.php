<?= $this->extend('templates/theme1')?>
 
 <?= $this->section('side-menu')?>
 	<?= $this->include('admin/_parts/_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('top-menu')?>
    <?= $this->include('admin/_parts/_top_menu')?>
 <?= $this->endSection()?>

<?= $this->section('main-content')?>
<div class="row">
   
   <div class="col-md-4"><h3 class="custom-breadcrumb">Home Page Banner</h3></div>
    
</div>
<div class="main-content">

   <?= display_session_msg()?>
   
   <section class="section">

      <div class="row">
         <div class="col-md-3">
            <h4>Banner Title</h4>
             <ul class="nav2">
                  <li class="nav-item <?= strcasecmp($currentSection, 'Main')===0? 'active' : ''?>">
                     <a class="nav-link" href="<?= base_url('admin/home-page-banner/main')?>">Main</a>
                  </li>
                  <li class="nav-item <?= strcasecmp($currentSection, 'second')===0? 'active' : ''?>">
                     <a class="nav-link" href="<?= base_url('admin/home-page-banner/second')?>">Second</a>
                  </li>
            </ul>
         </div>
         <div class="col-md-9">
            <div id="load-home-setup" class="mb-5">
              <ul class="m-0 p-0">
                  <?php foreach($records as $data):?>
                  <li class="d-inline-block border p-3 mb-2">
                     <img class="img-thumbnail" style="max-width: 200px;" src="<?= $data->banner_url?>">
                     <h4>Position: <?= $data->position?></h4>
                     <div>
                          
                        <a class="btn thin-btn thin-btn-gray delete_clk" title="Delete" data-toggle="tooltip" href="<?= base_url('admin/delete-home-page-banner/'.$data->id)?>?section=<?=$currentSection?>">
                          <i class="fa-regular fa-trash-can"></i>
                        </a>
                     </div>
                  </li>
                  <?php endforeach?>
               </ul>


               <?php if(sizeof($records)===0):?>
                  <p class="text-muted">Nothing found...</p>
               <?php endif?>

                  
            </div>


             <?= form_open('', 'id="homePageBannerForm" autocomplete="off"')?>
            <input type="hidden" name="section" value="<?= $currentSection?>">
            <input type="hidden" name="status" value="active">
            <div class="border p-3" style="max-width:500px">
               <label>Add New Banner</label>
               <div class="input-group mb-3">
                  <div class="input-group-append mr-2">
                   <select name="position" class="form-control">
                     <option value="">-- Position No. --</option>
                      <?php for ($i=1; $i <=10 ; $i++):?>
                        <option value="<?= $i?>"><?= $i?></option>
                      <?php endfor?>
                   </select>
                 </div>
                 <input type="text" class="form-control"   name="banner_url" placeholder="Banner URL">
                 <div class="input-group-append">
                   <button  class="input-group-text theme-btn" type="submit">Add To List</button>
                 </div>
               </div>
               <div class="validation-error" id="positionErr"></div>
               <div class="validation-error" id="banner_urlErr"></div>
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
                   <select name="position_order" class="form-control">
                     <option value="">-- Position No. --</option>
                      <?php for ($i=1; $i <=10 ; $i++):?>
                        <option value="<?= $i?>"><?= $i?></option>
                      <?php endfor?>
                   </select>
                 </div>
                 <input type="text" class="form-control" id="mediaContentSearch2" name="media_content" placeholder="Search Media...">
                  
               </div>
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
 

<!-- Modal Section End -->


<?= $this->endSection()?>