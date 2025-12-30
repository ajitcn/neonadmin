<!-- new media content modal -->
<div class="modal fade" id="newMediaModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Create New Media</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('#', 'id="mediaContentForm" enctype="multipart/form-data" autocomplete="off"')?> 
            
            <div class="row">
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Title</label>
                     <input type="text" class="form-control" name="media_title" placeholder="Title">
                     <div class="validation-error" id="media_titleErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Genre</label>
                     <div class="dropdown">
                      <button class="btn dropdown-toggle form-control text-left border" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Genres
                      </button>
                      <div class="dropdown-menu">
                        <?php foreach($genres as $gen):?>
                        <label class="dropdown-item">
                          <input type="checkbox" name="genre[]" value="<?= $gen->id?>" class="genreAdd" data-label="<?= $gen->genre_name?>"> <?= $gen->genre_name?>
                        </label>
                        <?php endforeach?>
                      </div>
                    </div>
                    <div class="small text-muted mt-1 selectedGenre"></div>
                     <div class="validation-error" id="genreErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Category</label>
                     <select name="category" class="form-control">
                        <?php foreach($categories as $cat):?>
                           <option value="<?= $cat->id?>"><?= $cat->category_name?></option>
                        <?php endforeach?>
                     </select>
                     <div class="validation-error" id="categoryErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Content Type</label>
                     <select name="content_type" class="form-control">
                        <option value="Regular">Regular</option>
                        <option value="Rent">Rent</option>
                        <option value="Upcoming">Upcoming</option>
                     </select>
                     <div class="validation-error" id="content_typeErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Vertical Video</label>
                     <select name="vertical_video" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                     </select>
                     <div class="validation-error" id="vertical_videoErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Release Date</label>
                     <input type="text" class="form-control datepicker" name="release_date" placeholder="dd-mm-yyyy">
                     <div class="validation-error" id="release_dateErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Duration</label>
                     <input type="text" class="form-control" name="duration" placeholder="Duration">
                     <div class="validation-error" id="durationErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Age Rating</label>
                     <select name="age_rating" class="form-control">
                        <option value="U">U</option>
                        <option value="UA">UA</option>
                        <option value="A">A</option>
                        <option value="13+">13+</option>
                        <option value="16+">16+</option>
                        <option value="18+">18+</option>
                     </select>
                     <div class="validation-error" id="age_ratingErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Director</label>
                     <input type="text" class="form-control" name="director" placeholder="Director Name">
                     <div class="validation-error" id="directorErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Cast</label>
                     <input type="text" class="form-control" name="cast"  placeholder="Cast">
                     <div class="validation-error" id="castErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Language</label>
                     <div class="dropdown">
                      <button class="btn dropdown-toggle form-control text-left border" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Languages
                      </button>
                      <div class="dropdown-menu">
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="Hindi" data-label="Hindi" class="langAdd"> Hindi</label>
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="English" data-label="English" class="langAdd"> English</label>
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="Bhojpuri" data-label="Bhojpuri" class="langAdd"> Bhojpuri</label>
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="Bengali" data-label="Bengali" class="langAdd"> Bengali</label>
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="Marathi" data-label="Marathi" class="langAdd"> Marathi</label>
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="Telugu" data-label="Telugu" class="langAdd"> Telugu</label>
                     </div>
                    </div>
                    <div class="small text-muted mt-1 selectedLang">Select</div>
                     <div class="validation-error" id="genre_nameErr"></div>
                  </div>
               </div>
                
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Status</label>
                     <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                     </select>
                     <div class="validation-error" id="statusErr"></div>
                  </div>
               </div>

               <input type="hidden" name="parent_media_season" value="1">
               <!-- <div class="col-md-4">
                  <div class="mb-1">
                     <label>Parent Media (Previous 1st Season/Parts)</label>
                     <select name="parent_media_season" class="form-control">
                        <option value="1">1</option>
                         
                     </select>
                     <div class="validation-error" id="parent_media_seasonErr"></div>
                  </div>
               </div> -->
               <!-- <div class="col-md-4">
                  <div class="mb-1">
                     <label>Thumbnail/Cover image</label>
                     <input type="file" name="thumbnail_image" class="form-control">
                     <div class="validation-error" id="thumbnail_imageErr"></div>
                  </div>
               </div> -->
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Thumbnail/Cover image</label>
                     <input type="text" name="thumbnail_image_link" class="form-control" placeholder="Link">
                     <div class="validation-error" id="thumbnail_image_linkErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Landscape Image</label>
                     <input type="text" name="landscape_image_link" class="form-control" placeholder="Link">
                     <div class="validation-error" id="landscape_image_linkErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Portrait Image</label>
                     <input type="text" name="portrait_image_link" class="form-control" placeholder="Link">
                     <div class="validation-error" id="portrait_image_linkErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Trailer</label>
                     <input type="text" name="trailer_link" class="form-control" placeholder="Link">
                     <div class="validation-error" id="trailer_linkErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Cast Image(s)</label>
                     <input type="text" name="cast_image" class="form-control" placeholder="Image Link1,Image Link2,...">
                     <div class="validation-error" id="cast_imageErr"></div>
                  </div>
               </div>
                
               <div class="col-md-6">
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





<!-- edit media content modal -->
<div class="modal fade" id="editMediaModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Edit Media Content</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <div class="modal-body">
            <?php echo form_open('#', 'id="editMediaContentForm" enctype="multipart/form-data" autocomplete="off"')?> 

            <input type="hidden" name="id" value="">

            <div class="row">
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Title</label>
                     <input type="text" class="form-control" name="media_title" id="edit_media_title" placeholder="Title">
                     <div class="validation-error" id="edit_media_titleErr"></div>
                  </div>
               </div>

               <div class="col-md-4">
                 <div class="mb-1">
                   <label>Genre</label>
                   <div class="dropdown">
                     <button class="btn dropdown-toggle form-control text-left border" type="button" id="editDropdownGenre" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Select Genres
                     </button>
                     <div class="dropdown-menu" id="edit_genre_options">
                       <?php foreach($genres as $gen):?>
                         <label class="dropdown-item">
                           <input type="checkbox" name="genre[]" class="genreUpdate" value="<?= $gen->id?>" data-label="<?= $gen->genre_name?>"> <?= $gen->genre_name?>
                         </label>
                       <?php endforeach?>
                     </div>
                   </div>
                   
                   <div class="small text-muted mt-1 selectedGenre"></div>

                   <div class="validation-error" id="edit_genreErr"></div>
                 </div>
               </div>


               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Category</label>
                     <select name="category" id="edit_category" class="form-control">
                        <?php foreach($categories as $cat):?>
                           <option value="<?= $cat->id?>"><?= $cat->category_name?></option>
                        <?php endforeach?>
                     </select>
                     <div class="validation-error" id="edit_categoryErr"></div>
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Content Type</label>
                     <select name="content_type" id="edit_content_type" class="form-control">
                        <option value="Regular">Regular</option>
                        <option value="Rent">Rent</option>
                        <option value="Upcoming">Upcoming</option>
                     </select>
                     <div class="validation-error" id="edit_content_typeErr"></div>
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Vertical Video</label>
                     <select name="vertical_video" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                     </select>
                     <div class="validation-error" id="vertical_videoErr"></div>
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Release Date</label>
                     <input type="text" class="form-control datepicker" name="release_date" id="edit_release_date" placeholder="dd-mm-yyyy">
                     <div class="validation-error" id="edit_release_dateErr"></div>
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Duration</label>
                     <input type="text" class="form-control" name="duration" id="edit_duration" placeholder="Duration">
                     <div class="validation-error" id="edit_durationErr"></div>
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Age Rating</label>
                     <select name="age_rating" id="edit_age_rating" class="form-control">
                        <option value="U">U</option>
                        <option value="UA">UA</option>
                        <option value="A">A</option>
                        <option value="13+">13+</option>
                        <option value="16+">16+</option>
                        <option value="18+">18+</option>
                     </select>
                     <div class="validation-error" id="edit_age_ratingErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Director</label>
                     <input type="text" class="form-control" name="director" placeholder="Director Name">
                     <div class="validation-error" id="directorErr"></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Cast</label>
                     <input type="text" class="form-control" name="cast"  placeholder="Cast">
                     <div class="validation-error" id="castErr"></div>
                  </div>
               </div>
              <div class="col-md-4">
                 <div class="mb-1">
                   <label>Language</label>
                   <div class="dropdown">
                     <button class="btn dropdown-toggle form-control text-left border" type="button" id="editDropdownLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Select Languages
                     </button>
                     <div class="dropdown-menu">
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="Hindi" data-label="Hindi" class="langUpdate"> Hindi</label>
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="English" data-label="English" class="langUpdate"> English</label>
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="Bhojpuri" data-label="Bhojpuri" class="langUpdate"> Bhojpuri</label>
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="Bengali" data-label="Bengali" class="langUpdate"> Bengali</label>
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="Marathi" data-label="Marathi" class="langUpdate"> Marathi</label>
                       <label class="dropdown-item"><input type="checkbox" name="language[]" value="Telugu" data-label="Telugu" class="langUpdate"> Telugu</label>
                     </div>
                   </div>
                   <div class="small text-muted mt-1 selectedLang">Select</div>
                    

                   <div class="validation-error" id="edit_languageErr"></div>
                 </div>
               </div>
 

               <div class="col-md-4">
                  <div class="mb-1">
                     <label>Status</label>
                     <select name="status" id="edit_status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                     </select>
                     <div class="validation-error" id="edit_statusErr"></div>
                  </div>
               </div>

               <input type="hidden" name="parent_media_season" value="1">
               <!-- <div class="col-md-4">
                  <div class="mb-1">
                     <label>Parent Media (Previous 1st Season/Parts)</label>
                     <select name="parent_media_season" id="edit_parent_media_season" class="form-control">
                        <option value="1">1</option>
                     </select>
                     <div class="validation-error" id="edit_parent_media_seasonErr"></div>
                  </div>
               </div> -->

               <!-- <div class="col-md-4">
                  <div class="mb-1">
                     <label>Thumbnail/Cover Image</label>
                     <input type="file" name="thumbnail_image" class="form-control" id="edit_thumbnail_image">
                     <div class="validation-error" id="edit_thumbnail_imageErr"></div>
                  </div>
               </div> -->
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Thumbnail/Cover image</label>
                     <input type="text" name="thumbnail_image_link" class="form-control" placeholder="Link">
                     <div class="validation-error" id="thumbnail_image_linkErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Landscape Image</label>
                     <input type="text" name="landscape_image_link" class="form-control" placeholder="Link">
                     <div class="validation-error" id="landscape_image_linkErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Portrait Image</label>
                     <input type="text" name="portrait_image_link" class="form-control" placeholder="Link">
                     <div class="validation-error" id="portrait_image_linkErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Trailer</label>
                     <input type="text" name="trailer_link" class="form-control" placeholder="Link">
                     <div class="validation-error" id="trailer_linkErr"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Cast Image(s)</label>
                     <input type="text" name="cast_image" class="form-control" placeholder="Image Link1,Image Link2,...">
                     <div class="validation-error" id="cast_imageErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-1">
                     <label>Description</label>
                     <textarea class="form-control" name="description" id="edit_description" placeholder="Description"></textarea>
                     <div class="validation-error" id="edit_descriptionErr"></div>
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








 