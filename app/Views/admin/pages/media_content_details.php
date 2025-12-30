<?= $this->extend('templates/theme1')?>
 
 <?= $this->section('side-menu')?>
 	<?= $this->include('admin/_parts/_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('top-menu')?>
    <?= $this->include('admin/_parts/_top_menu')?>
 <?= $this->endSection()?>

<?= $this->section('main-content')?>
<div class="row">
   <div class="col-md-4"><h3 class="custom-breadcrumb">Media Content Details</h3></div>
   <div class="col-md-8 text-right"> 
      <button class="btn thin-btn" data-toggle="modal" data-target="#newMediaSegmentModal" type="button">+ New Segment</button>
      
   </div> 
</div>
<div class="main-content">

   <?= display_session_msg()?>
   
   <section class="section">
       
       <div class="row">
          <div class="col-md-12">
            <h3><strong><?= $mediaContent->title?></strong></h3>
          
            <ul class="flex-style">
               <li><?= $mediaContent->category_name?></li>
               <li><?= $mediaContent->genres?></li>
               <li>Release : <?= $mediaContent->release_date?></li>
                <li><?= $mediaContent->duration?></li>
               <li><?= $mediaContent->language?></li>
               <li><?= $mediaContent->age_rating?></li>
            </ul>
             
         
           
          </div>
          <div class="col-md-4">
             <div class="text-left">
                 <img class="img-thumbnail" style="max-width: 200px;" src="<?= $mediaContent->thumbnail_url?>">
             </div>
          </div>
          <div class="col-md-8">
             <div class="border p-3">

                 <p class="">
                    <strong>Description: </strong>
                     <?= $mediaContent->description?>
                 </p>

                 <h5><strong>Director</strong>: <?= $mediaContent->director?></h5>
                 <h5><strong>Cast</strong>: <?= $mediaContent->cast?></h5>
                 <h5><strong>Links</strong>: 
                     <a class="btn text-info" target="_blank" href="<?= $mediaContent->trailer_link?>">Trailer</a>
                     <a class="btn text-info" target="_blank" href="<?= $mediaContent->landscape_image_url?>">Landscape Image</a>
                     <a class="btn text-info" target="_blank" href="<?= $mediaContent->portrait_image_url?>">Portrait Image</a>
                     <a class="btn text-info" target="_blank" href="<?= $mediaContent->cast_image_link?>">Cast Image</a>
                 </h5>
             </div>
          </div>
       </div>
      
   </section>

    <section class="section">
      <hr>
      <!-- segments -->
      <h3 class="text-muted">Media Segment / Part / Episode</h3>
      <ul class="inline-flex-ul">
      <?php foreach ($mediaContentSegments as $segment):?>
         <li class="inline-flex-ul-item">
            <div class="">
                  
                 <video
                   id="my-video"
                   class="video-js"
                   controls
                   preload="auto"
                   width="280"
                   height="150"
                   data-setup="{}"
                 >
                   <source src="<?=$segment->media_url?>" type="video/mp4" />
                   Your browser does not support HTML5 video.
                 </video>
                 <ul class="flex-style mt-2">
                     <li><?=$segment->segment_title?></li>
                     <li><?=$segment->duration?></li>
                     <li>Release: <?=$segment->release_date?></li>
                     <li><?=$segment->resolution?></li>
                     <li><?=$segment->media_language?></li>
                     <li>At: <?= _date($segment->created_at)?></li>
                      
                  </ul>
                  <p><?= $segment->description?></p>
                  <div>
                     <button class="btn thin-btn thin-btn-gray" title="Edit" data-toggle="tooltip"  type="button" onclick="openSegmentEditForm(<?=$segment->id?>)">
                        <i class="fa-solid fa-pen-to-square"></i>
                     </button>
                     
                     
                     <a class="btn thin-btn thin-btn-gray delete_clk" title="Delete" data-toggle="tooltip" href="<?= base_url('admin/delete-media-content-segment/'.$segment->id.'?mediaId='.$segment->media_content_id)?>">
                       <i class="fa-regular fa-trash-can"></i>
                     </a>
                  </div>
                 
             </div>

         </li>

      <?php endforeach?>
      </ul>

      <?php if(sizeof($mediaContentSegments)===0):?>
         <p class="text-muted">No video found!</p>
      <?php endif?>

    </section>
   
</div>


<!-- Modal Section Start -->

<?= view('admin/pages/_media_content_segment_modals')?>

<!-- Modal Section End -->


 






 
<?= $this->endSection()?>