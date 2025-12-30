<?= $this->extend('templates/theme1')?>
 
 <?= $this->section('side-menu')?>
 	<?= $this->include('admin/_parts/_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('top-menu')?>
    <?= $this->include('admin/_parts/_top_menu')?>
 <?= $this->endSection()?>

<?= $this->section('main-content')?>
<div class="row">
   <div class="col-md-4"><h3 class="custom-breadcrumb">Media Content</h3></div>
   <div class="col-md-8 text-right"> 
       
      <button class="btn thin-btn" data-toggle="modal" data-target="#memberFilterModal" type="button"><i class="fa-solid fa-filter"></i> Filter</button>
      <button class="btn thin-btn" data-toggle="modal" data-target="#newMediaModal" type="button" onclick="_setMultiCheckboxTextView('.genreAdd', '.selectedGenre');">+ New Content</button>
      
   </div> 
</div>
<div class="main-content">

   <?= display_session_msg()?>
   
   <section class="section">
      <div class="table-responsive">

      <table class="table custom-table table-striped table-bordered">
         <thead>
            <tr>
               <th>Title</th>
               <th>Basic Details</th> 
               <!-- <th>Parent Season</th> -->
               <th>Description</th>
               <th>Status</th>
               <th>Created At</th>
               <th>Updated At</th>
            </tr>
         </thead>

         <thead>
            <?php foreach($mediaContents as $md):?>
               <tr>
                  <td>
                     <img class="img-thumbnail" src="<?= $md->thumbnail_url?>">
                     <h5><?= $md->title?></h5>
                     <div class="mt-1" style="min-width: 120px;">
                     <button class="btn thin-btn thin-btn-gray" title="Edit" data-toggle="tooltip"  type="button" onclick="openMediaContentEditForm(<?=$md->id?>)">
                        <i class="fa-solid fa-pen-to-square"></i>
                     </button>
                     
                     <a class="btn thin-btn thin-btn-gray" title="View Details" data-toggle="tooltip" href="<?= base_url('admin/media-content-details/'.$md->id)?>">
                       <i class="fa-solid fa-eye"></i>
                     </a>
                     <a class="btn thin-btn thin-btn-gray delete_clk" title="Delete" data-toggle="tooltip" href="<?= base_url('admin/delete-media-content/'.$md->id.'?currentPage='.$currentPage)?>">
                       <i class="fa-regular fa-trash-can"></i>
                     </a>
                    
                  </div>
                  </td>
                  <td>
                     <div style="min-width: 200px;">
                        <div><strong>Category: </strong><?= $md->category_name?></div>
                        <div><strong>Type: </strong><?= $md->content_type?></div>
                        <div><strong>Genre: </strong><?= $md->genres?></div>
                        <div><strong>Language: </strong><?= $md->language?></div>
                        <div><strong>Duration: </strong><?= $md->duration?></div>
                        <div><strong>Age Rating: </strong><?= $md->age_rating?></div>
                        <div><strong>Vertical: </strong><?= ((int)$md->vertical_video===0)? 'No' : 'Yes'?></div>
                        <div><strong>Release Date: </strong><?=  _dateOnly($md->release_date)?></div>
                     </div>
                  </td>
                   
                  
                   
                  
                   
                  
                  
                   
                  <!-- <td><?= $md->parent_season?></td> -->
                  <td><?= $md->description?></td>
                  <td><?= $md->status?></td>
                  <td><?= _date($md->created_at)?></td>
                  <td><?= _date($md->updated_at)?></td>
               </tr>
            <?php endforeach?>
         </thead>
        
      </table>
      </div>
      
   </section>
   
</div>


<!-- Modal Section Start -->

<?= view('admin/pages/_media_content_modals')?>

<!-- Modal Section End -->






 
<?= $this->endSection()?>