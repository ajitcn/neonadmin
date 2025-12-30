<!-- new payment gateway modal -->
<div class="modal fade" id="newPaymentGatewayModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Create New Payment Gateway</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('#', 'id="paymentGatewayForm" autocomplete="off"')?> 
            
            <div class="mb-1">
               <label>Payment Gateway Name</label>
               <input type="text" class="form-control" name="payment_gateway_name" placeholder="Title">
               <div class="validation-error" id="payment_gateway_nameErr"></div>
            </div>
            <div class="mb-1">
               <label>API Key</label>
               <input type="text" class="form-control" name="api_key" placeholder="API Key">
               <div class="validation-error" id="api_keyErr"></div>
            </div>
            <div class="mb-1">
               <label>Secret Code</label>
               <input type="text" class="form-control" name="secret_code" placeholder="Secret Code">
               <div class="validation-error" id="secret_codeErr"></div>
            </div>
            <div class="mb-1">
               <label>Merchant ID</label>
               <input type="text" class="form-control" name="merchant_id" placeholder="Merchant ID">
               <div class="validation-error" id="merchant_idErr"></div>
            </div>
            <div class="mb-1">
               <label>Status</label>
               <select class="form-control" name="status">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
               </select>
               <div class="validation-error" id="statusErr"></div>
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



<!-- edit Genre modal -->
<div class="modal fade" id="editPaymentGatewayModal" tabindex="-1" role="dialog" aria-labelledby="newUserModal" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Edit Payment Gateway</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('#', 'id="editPaymentGatewayForm"  autocomplete="off"')?>
            <input type="hidden" name="id" value="">
             <div class="mb-1">
               <label>Payment Gateway Name</label>
               <input type="text" class="form-control" name="payment_gateway_name" placeholder="Title" readonly>
               <div class="validation-error" id="payment_gateway_nameErr"></div>
            </div>
            <div class="mb-1">
               <label>API Key</label>
               <input type="text" class="form-control" name="api_key" placeholder="API Key">
               <div class="validation-error" id="api_keyErr"></div>
            </div>
            <div class="mb-1">
               <label>Secret Code</label>
               <input type="text" class="form-control" name="secret_code" placeholder="Secret Code">
               <div class="validation-error" id="secret_codeErr"></div>
            </div>
            <div class="mb-1">
               <label>Merchant ID</label>
               <input type="text" class="form-control" name="merchant_id" placeholder="Merchant ID">
               <div class="validation-error" id="merchant_idErr"></div>
            </div>
            <div class="mb-1">
               <label>Status</label>
               <select class="form-control" name="status">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
               </select>
               <div class="validation-error" id="statusErr"></div>
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


 