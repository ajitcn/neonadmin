<!-- new member modal -->
<!-- <div class="modal fade" id="newMemberModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Create New Member</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('#', 'id="memberForm"')?>
            <input type="hidden" name="status" value="inactive">
            
            <div class="mb-1">
               <label>Member Name</label>
               <input type="text" class="form-control" name="member_name" placeholder="Full Name">
               <div class="validation-error" id="member_nameErr"></div>
            </div>
            <div class="mb-1">
               <label>Mobile Number</label>
               <input type="text" class="form-control" name="mobile_number" placeholder="Mobile Number">
               <div class="validation-error" id="mobile_numberErr"></div>
            </div>
            <div class="mb-1">
               <label>Email Id</label>
               <input type="email" class="form-control" name="member_email" placeholder="Email Id">
               <div class="validation-error" id="member_emailErr"></div>
            </div>
             
            <div class="jsResponseMsg"></div>
            <div class="text-right mt-3">
               <button class="btn theme-btn" type="submit">Create</button>
            </div>
            <?php echo form_close()?>
         </div>
      </div>
   </div>
</div> -->



<!-- edit member modal -->
<div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="newUserModal" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Edit Member</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('#', 'id="editMemberForm"')?>
            <input type="hidden" name="member_id" value="">
            <div class="mb-1">
               <label>Member Name</label>
               <input type="text" class="form-control" name="member_name" placeholder="Full Name">
               <div class="validation-error" id="member_nameErr"></div>
            </div>
            <div class="mb-1">
               <label>Mobile Number</label>
               <input type="text" class="form-control" name="mobile_number" placeholder="Mobile Number">
               <div class="validation-error" id="mobile_numberErr"></div>
            </div>
            <div class="mb-1">
               <label>Email Id</label>
               <input type="email" class="form-control" name="member_email" placeholder="Email Id">
               <div class="validation-error" id="member_emailErr"></div>
            </div>

            <div class="mb-1">
               <label>Status</label>
                <select name="status" class="form-control">
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



<!-- new subscription modal -->
<div class="modal fade" id="subscriptionFormModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Member Subscription</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php echo form_open('#', 'id="subscriptionForm"')?>
            <input type="hidden" name="member_id" value="">
             
            <div class="mb-1">
               <label>Member Name</label>
               <input type="text" class="form-control" id="member_name" placeholder="Full Name" readonly>
            </div>
            <div class="mb-1">
               <label>Amount</label>
               <input type="text" class="form-control" name="amount" placeholder="Amount">
               <div class="validation-error" id="amountErr"></div>
            </div>

            <div class="mb-1">
               <label>Duration</label>
               <select class="form-control" name="duration">
                  <option value="">--- Select ---</option>
                  <?php for ($i=1; $i <= 36 ; $i++) :?>
                     <option value="<?= $i?>"><?= $i?> Month<?= $i>1 ? 's' : '' ?></option>
                  <?php endfor?>
                     
               </select>
               <div class="validation-error" id="durationErr"></div>
            </div>
             
            <div class="jsResponseMsg"></div>
            <div class="text-right mt-3">
               <button class="btn theme-btn" type="submit">Create Subscription</button>
            </div>
            <?php echo form_close()?>
         </div>
      </div>
   </div>
</div>



<!-- member filter modal -->
<div class="modal fade" id="memberFilterModal" tabindex="-1" role="dialog" aria-labelledby="newUserModal" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Filter</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="<?= base_url('admin/members/1')?>" autocomplete="off" method="get">
               <div class="row">
                  <div class="col-6">
                     <div class="mb-1">
                        <label>Search</label>
                        <input type="text" class="form-control" name="search_term" placeholder="Name, Mobile, Email" value="<?= service('request')->getVar('search_term')?>">
                     </div>
                  </div>
                   <div class="col-6">
                     <div class="mb-1">
                     <label>Order By</label>
                      <select name="order_by" class="form-control">
                          <option value="created_at-DESC" <?= set_selected_option('created_at-DESC', service('request')->getVar('order_by'))?>>Entry Date (DESC)</option>
                          <option value="created_at-ASC" <?= set_selected_option('created_at-ASC', service('request')->getVar('order_by'))?>>Entry Date (ASC)</option>
                          <option value="member_name-DESC" <?= set_selected_option('member_name-DESC', service('request')->getVar('order_by'))?>>Member (DESC)</option>
                          <option value="member_name-ASC" <?= set_selected_option('member_name-ASC', service('request')->getVar('order_by'))?>>Member (ASC)</option>
                          
                      </select>
                  </div>
                  </div>
                  <div class="col-6">
                     <div class="mb-1">
                     <label>Member Status</label>
                      <select name="member_status" class="form-control">
                          <option value="" <?= set_selected_option('', service('request')->getVar('member_status'))?>>All</option>
                          <option value="active" <?= set_selected_option('active', service('request')->getVar('member_status'))?>>Active</option>
                          <option value="inactive" <?= set_selected_option('inactive', service('request')->getVar('member_status'))?>>Inactive</option>
                      </select>
                  </div>
                  </div>
                  <div class="col-6">
                     <div class="mb-1">
                     <label>Subscription Validity</label>
                      <select name="subscription_validity" class="form-control">
                          <option value="" <?= set_selected_option('', service('request')->getVar('subscription_validity'))?>>All</option>
                          <option value="active" <?= set_selected_option('active', service('request')->getVar('subscription_validity'))?>>Active</option>
                          <option value="expired" <?= set_selected_option('expired', service('request')->getVar('subscription_validity'))?>>Expired</option>
                      </select>
                  </div>
                  </div>
               </div>
            

            
             
            <div class="text-right mt-3">
               <button class="btn theme-btn" type="submit">Filter</button>
            </div>
           </form>
         </div>
      </div>
   </div>
</div>
