<!-- new promo code modal -->
<div class="modal fade" id="newPromoCodeModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Create New Promo Code</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <div class="modal-body">
            <?php echo form_open(base_url('admin/create-promo-code'), 'id="promoCodeForm"  autocomplete="off"') ?>

            <div class="row">
               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Promo Code Name</label>
                     <input type="text" class="form-control" name="promo_code_name" placeholder="Promo Code Name">
                     <div class="validation-error" id="promo_code_nameErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Discount Type</label>
                     <select class="form-control" name="discount_type">
                        <option value="Flat">Flat</option>
                        <option value="Percentage">Percentage</option>
                     </select>
                     <div class="validation-error" id="discount_typeErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Discount</label>
                     <input type="number" class="form-control" name="discount" placeholder="Discount">
                     <div class="validation-error" id="discountErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Max Use</label>
                     <input type="number" class="form-control" name="max_use" placeholder="Max Use">
                     <div class="validation-error" id="max_useErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Valid From</label>
                     <input type="text" class="form-control datepicker" name="valid_from" placeholder="dd-mm-yyyy">
                     <div class="validation-error" id="valid_fromErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Valid Till</label>
                     <input type="text" class="form-control datepicker" name="valid_till" placeholder="dd-mm-yyyy">
                     <div class="validation-error" id="valid_tillErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Status</label>
                     <select class="form-control" name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                     </select>
                     <div class="validation-error" id="statusErr"></div>
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="mb-2">
                     <label>Description</label>
                     <textarea class="form-control" name="description" rows="2"></textarea>
                     <div class="validation-error" id="descriptionErr"></div>
                  </div>
               </div>
            </div>

            <div class="jsResponseMsg"></div>
            <div class="text-right mt-3">
               <button class="btn theme-btn" type="submit">Create</button>
            </div>
            <?php echo form_close() ?>
         </div>
      </div>
   </div>
</div>

<!-- edit promo code modal -->
<div class="modal fade" id="editPromoCodeModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Edit Promo Code</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <div class="modal-body">
            <?php echo form_open(base_url('admin/update-promo-code'), 'id="editPromoCodeForm" autocomplete="off"') ?>

            <input type="hidden" name="id" value="">

            <div class="row">
               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Promo Code Name</label>
                     <input type="text" class="form-control" name="promo_code_name" placeholder="Promo Code Name">
                     <div class="validation-error" id="promo_code_nameErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Discount Type</label>
                     <select class="form-control" name="discount_type">
                        <option value="Flat">Flat</option>
                        <option value="Percentage">Percentage</option>
                     </select>
                     <div class="validation-error" id="discount_typeErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Discount</label>
                     <input type="number" class="form-control" name="discount" placeholder="Discount">
                     <div class="validation-error" id="discountErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Max Use</label>
                     <input type="number" class="form-control" name="max_use" placeholder="Max Use">
                     <div class="validation-error" id="max_useErr"></div>
                  </div>
               </div>

              <div class="col-md-6">
                  <div class="mb-2">
                     <label>Valid From</label>
                     <input type="text" class="form-control datepicker" name="valid_from" placeholder="dd-mm-yyyy">
                     <div class="validation-error" id="valid_fromErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Valid Till</label>
                     <input type="text" class="form-control datepicker" name="valid_till" placeholder="dd-mm-yyyy">
                     <div class="validation-error" id="valid_tillErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Status</label>
                     <select class="form-control" name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                     </select>
                     <div class="validation-error" id="statusErr"></div>
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="mb-2">
                     <label>Description</label>
                     <textarea class="form-control" name="description" rows="2"></textarea>
                     <div class="validation-error" id="descriptionErr"></div>
                  </div>
               </div>
            </div>

            <div class="jsResponseMsg"></div>
            <div class="text-right mt-3">
               <button class="btn theme-btn" type="submit">Update</button>
            </div>
            <?php echo form_close() ?>
         </div>
      </div>
   </div>
</div>
