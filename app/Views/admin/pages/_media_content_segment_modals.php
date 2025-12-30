
<!-- media segment video -->

<div class="modal fade" id="newMediaSegmentModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Create New Media Segment Video</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('#', 'id="mediaContentSegmentForm" enctype="multipart/form-data" autocomplete="off"')?> 
            <input type="hidden" name="media_content_id" value="<?= $mediaID?>">
            <div class="row">
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Segment Title</label>
                     <input type="text" class="form-control" name="segment_title" placeholder="Title">
                     <div class="validation-error" id="segment_titleErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Segment / Episode Number</label>
                     <select name="segment_number" class="form-control">
                        <?php for ($i=1; $i < 50; $i++):?>
                           <option value="<?= $i?>"><?= $i?></option>
                        <?php endfor?>
                        
                     </select>
                     <div class="validation-error" id="segment_numberErr"></div>
                  </div>
               </div>
                
                
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Resolution / Quality</label>
                     <select name="resolution" class="form-control">
                        <option value="480p">480p</option>
                        <option value="720p">720p</option>
                        <option value="1080p">1080p</option>
                        <option value="2160p">2160p</option>
                        <option value="4k">4K</option>
                     </select>
                     <div class="validation-error" id="resolutionErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Release Date</label>
                     <input type="text" class="form-control datepicker" name="release_date" placeholder="dd-mm-yyyy">
                     <div class="validation-error" id="release_dateErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Duration</label>
                     <input type="text" class="form-control" name="duration" placeholder="Duration">
                     <div class="validation-error" id="durationErr"></div>
                  </div>
               </div>
                
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Language</label>
                      <select name="language" class="form-control">
                          <option value="Hindi">Hindi</option>
                          <option value="English">English</option>
                          <option value="Bhojpuri">Bhojpuri</option>
                          <option value="Bengali">Bengali</option>
                          <option value="Marathi">Marathi</option>
                          <option value="Telugu">Telugu</option>
                       </select>
                    </div>
                     <div class="validation-error" id="languageErr"></div>
               </div>

              
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Video Link</label>
                     <input type="text" name="media_video" class="form-control" placeholder="Link">
                     <div class="validation-error" id="media_videoErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Cover Image Link</label>
                     <input type="text" name="cover_image_link" class="form-control" placeholder="Link">
                     <div class="validation-error" id="cover_image_linkErr"></div>
                  </div>
               </div>
                <div class="col-md-6">
                  <div class="mb-1">
                     <label>Vertical Video</label>
                     <select name="vertical_video" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                     </select>
                     <div class="validation-error" id="vertical_videoErr"></div>
                  </div>
               </div>
               
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Status</label>
                     <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                     </select>
                     <div class="validation-error" id="statusErr"></div>
                  </div>
               </div>
               
               
                
               <div class="col-md-12">
                  <div class="mb-1">
                     <label>Description</label>
                     <textarea class="form-control" name="description" placeholder="Description"></textarea>
                     <div class="validation-error" id="descriptionErr"></div>
                  </div>
               </div>
            </div>
            <div class="jsResponseMsg"></div>
            <div class="text-right mt-3">
               <button class="btn theme-btn" type="submit">Create</button>
            </div>
            <?php echo form_close()?>
         </div>
      </div>
   </div>
</div>



<!--edit media segment video -->

<div class="modal fade" id="editMediaSegmentModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Edit Media Segment Video</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('#', 'id="editMediaContentSegmentForm" enctype="multipart/form-data" autocomplete="off"')?> 
            <input type="hidden" name="segment_id" value="">
            <div class="row">
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Segment Title</label>
                     <input type="text" class="form-control" name="segment_title" placeholder="Title">
                     <div class="validation-error" id="segment_titleErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Segment / Episode Number</label>
                     <select name="segment_number" class="form-control">
                        <?php for ($i=1; $i < 50; $i++):?>
                           <option value="<?= $i?>"><?= $i?></option>
                        <?php endfor?>
                        
                     </select>
                     <div class="validation-error" id="segment_numberErr"></div>
                  </div>
               </div>
                
                
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Resolution / Quality</label>
                     <select name="resolution" class="form-control">
                        <option value="480p">480p</option>
                        <option value="720p">720p</option>
                        <option value="1080p">1080p</option>
                        <option value="2160p">2160p</option>
                        <option value="4k">4K</option>
                     </select>
                     <div class="validation-error" id="resolutionErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Release Date</label>
                     <input type="text" class="form-control datepicker" name="release_date" placeholder="dd-mm-yyyy">
                     <div class="validation-error" id="release_dateErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Duration</label>
                     <input type="text" class="form-control" name="duration" placeholder="Duration">
                     <div class="validation-error" id="durationErr"></div>
                  </div>
               </div>
                
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Language</label>
                      <select name="language" class="form-control">
                          <option value="Hindi">Hindi</option>
                          <option value="English">English</option>
                          <option value="Bhojpuri">Bhojpuri</option>
                          <option value="Bengali">Bengali</option>
                          <option value="Marathi">Marathi</option>
                          <option value="Telugu">Telugu</option>
                       </select>
                    </div>
                     <div class="validation-error" id="languageErr"></div>
               </div>
               
              <div class="col-md-6">
                  <div class="mb-1">
                     <label>Video Link</label>
                     <input type="text" name="media_video" class="form-control" placeholder="Link">
                     <div class="validation-error" id="media_videoErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Cover Image Link</label>
                     <input type="text" name="cover_image_link" class="form-control" placeholder="Link">
                     <div class="validation-error" id="cover_image_linkErr"></div>
                  </div>
               </div>
                <div class="col-md-6">
                  <div class="mb-1">
                     <label>Vertical Video</label>
                     <select name="vertical_video" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                     </select>
                     <div class="validation-error" id="vertical_videoErr"></div>
                  </div>
               </div>
               
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Status</label>
                     <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                     </select>
                     <div class="validation-error" id="statusErr"></div>
                  </div>
               </div>
               
                
               <div class="col-md-12">
                  <div class="mb-1">
                     <label>Description</label>
                     <textarea class="form-control" name="description" placeholder="Description"></textarea>
                     <div class="validation-error" id="descriptionErr"></div>
                  </div>
               </div>
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
 