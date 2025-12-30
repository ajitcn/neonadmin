<!-- Section Management Modal -->
<div class="modal fade" id="newSectionModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Manage Sections</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <div class="modal-body">
             
            <!-- Add Section Form -->
            <?php echo form_open(base_url('admin/save-section'), 'id="sectionForm" autocomplete="off"') ?>
                
               <div class="mb-3">
                  <label>Section Name</label>
                  <input type="text" class="form-control" name="section_name" placeholder="Enter Section Name" required>
                  <div class="validation-error" id="section_nameErr"></div>
               </div>
               <div class="mb-3">
                  <label>Status</label>
                  <select class="form-control" name="status">
                     <option value="active">Active</option>
                     <option value="inactive">Inactive</option>
                  </select>
                  <div class="validation-error" id="statusErr"></div>
               </div>
               
               <div class="text-right mt-3">
                  <button type="submit" class="btn theme-btn">
                     </i> Save
                  </button>

                  
               </div>
            <?php echo form_close() ?>

          

         </div>
      </div>
   </div>
</div>
<!-- Edit Section Modal -->
<div class="modal fade" id="editSectionModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Edit Section</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('', 'id="editSectionForm"') ?> 

            <div class="mb-3">
               <label>Select Section</label>
               <select name="old_section_name" class="form-control" id="editSectionDropdown" required>
                  <option value="">-- Select Section --</option>
                  
                     <?php foreach($setionRecords as $section): ?>
                        <option value="<?= $section->id ?>" data-status="<?= $section->status ?>"><?= $section->section_name ?></option>
                     <?php endforeach; ?>
                   
               </select>
               <div class="validation-error" id="old_section_nameErr"></div>
            </div>
            <div class="mb-3">
                  <label>Status</label>
                  <select class="form-control" name="status">
                     <option value="">--- Select ---</option>
                     <option value="active">Active</option>
                     <option value="inactive">Inactive</option>
                  </select>
                  <div class="validation-error" id="statusErr"></div>
               </div>

            <div class="mb-3">
               <label>Update Section Name</label>
               <input type="text" class="form-control" name="section_name" placeholder="Enter new name" >
               <div class="validation-error" id="section_nameErr"></div>
            </div>

            <div class="jsResponseMsg"></div>

            <div class="text-right mt-3">
               <a class="text-danger mr-3 delete_clk btn" href="javascript:void(0)" data-toggle="tooltip" title="Select section to delete" id="deleteSectionBtn">Delete</a>
               <button class="btn theme-btn" type="submit">Update</button>

            </div>

            <?php echo form_close() ?>
         </div>
      </div>
   </div>
</div>
