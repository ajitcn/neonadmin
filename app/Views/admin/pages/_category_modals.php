<!-- new category modal -->
<div class="modal fade" id="newCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Create New Category</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('#', 'id="categoryForm"')?> 
            
            <div class="mb-1">
               <label>Category Name</label>
               <input type="text" class="form-control" name="category_name" placeholder="Name">
               <div class="validation-error" id="category_nameErr"></div>
            </div>
            <div class="mb-1">
               <label>Description</label>
               <textarea class="form-control" name="description"></textarea>
               <div class="validation-error" id="descriptionErr"></div>
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



<!-- edit category modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="newUserModal" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Edit Category</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('#', 'id="editCategoryForm"')?>
            <input type="hidden" name="category_id" value="">
             <div class="mb-1">
               <label>Category Name</label>
               <input type="text" class="form-control" name="category_name" placeholder="Name">
               <div class="validation-error" id="category_nameErr"></div>
            </div>
            <div class="mb-1">
               <label>Description</label>
               <textarea class="form-control" name="description"></textarea>
               <div class="validation-error" id="descriptionErr"></div>
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


 