<!-- new package modal -->
<div class="modal fade" id="newPackageModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Create New Package</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <div class="modal-body">
            <?php echo form_open(base_url('admin/create-package'), 'id="packageForm" autocomplete="off"') ?>

            <div class="row">
               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Package Name</label>
                     <input type="text" class="form-control" name="package_name" placeholder="Name" autocomplete="off">
                     <div class="validation-error" id="package_nameErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Package MRP</label>
                     <input type="text" class="form-control" name="package_mrp" placeholder="MRP" autocomplete="off">
                     <div class="validation-error" id="package_mrpErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Duration</label>
                     <input type="number" class="form-control" name="duration" placeholder="Duration" autocomplete="off">
                     <div class="validation-error" id="durationErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Duration Type</label>
                     <select class="form-control" name="duration_type" autocomplete="off">
                        <option value="Days">Days</option>
                        <option value="Week">Week</option>
                        <option value="Month">Month</option>
                        <option value="Year">Year</option>
                     </select>
                     <div class="validation-error" id="duration_typeErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Ad Free</label>
                     <select class="form-control" name="ad_free" autocomplete="off">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                     </select>
                     <div class="validation-error" id="ad_freeErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>On Rent</label>
                     <select class="form-control" name="on_rent" autocomplete="off">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                     </select>
                     <div class="validation-error" id="on_rentErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Device</label>
                     <input type="number" class="form-control" name="device" placeholder="Device" autocomplete="off">
                     <div class="validation-error" id="deviceErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Quality</label>
                     <select name="quality" class="form-control">
                        <option value="Upto 720p">Quality Upto 720p</option>
                        <option value="High Quality Video" selected>High Quality Video</option>
                     </select>
                      
                     <div class="validation-error" id="qualityErr"></div>
                  </div>
               </div>
                

               <div class="col-md-12">
                  <div class="mb-2">
                     <label>Description</label>
                     <textarea class="form-control" name="description" rows="2" autocomplete="off"></textarea>
                     <div class="validation-error" id="descriptionErr"></div>
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="mb-2">
                     <label>Other Details</label>
                     <textarea class="form-control" name="other_details" rows="2" autocomplete="off"></textarea>
                     <div class="validation-error" id="other_detailsErr"></div>
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


<!-- edit package modal -->
<div class="modal fade" id="editPackageModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h6 class="modal-title">Edit Package</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <div class="modal-body">
            <?php echo form_open(base_url('admin/update-package'), 'id="editPackageForm" autocomplete="off"') ?>

            <input type="hidden" name="id" value="">

            <div class="row">
               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Package Name</label>
                     <input type="text" class="form-control" name="package_name" placeholder="Name" autocomplete="off">
                     <div class="validation-error" id="package_nameErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Package MRP</label>
                     <input type="text" class="form-control" name="package_mrp" placeholder="MRP" autocomplete="off">
                     <div class="validation-error" id="package_mrpErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Duration</label>
                     <input type="number" class="form-control" name="duration" placeholder="Duration" autocomplete="off">
                     <div class="validation-error" id="durationErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Duration Type</label>
                     <select class="form-control" name="duration_type" autocomplete="off">
                        <option value="Days">Days</option>
                        <option value="Week">Week</option>
                        <option value="Month">Month</option>
                        <option value="Year">Year</option>
                     </select>
                     <div class="validation-error" id="duration_typeErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Ad Free</label>
                     <select class="form-control" name="ad_free" autocomplete="off">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                     </select>
                     <div class="validation-error" id="ad_freeErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>On Rent</label>
                     <select class="form-control" name="on_rent" autocomplete="off">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                     </select>
                     <div class="validation-error" id="on_rentErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Device</label>
                     <input type="number" class="form-control" name="device" placeholder="Device" autocomplete="off">
                     <div class="validation-error" id="deviceErr"></div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="mb-2">
                     <label>Quality</label>
                     <select name="quality" class="form-control">
                        <option value="Upto 720p">Quality Upto 720p</option>
                        <option value="High Quality Video">High Quality Video</option>
                     </select>
                     <div class="validation-error" id="qualityErr"></div>
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="mb-2">
                     <label>Description</label>
                     <textarea class="form-control" name="description" rows="2" autocomplete="off"></textarea>
                     <div class="validation-error" id="descriptionErr"></div>
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="mb-2">
                     <label>Other Details</label>
                     <textarea class="form-control" name="other_details" rows="2" autocomplete="off"></textarea>
                     <div class="validation-error" id="other_detailsErr"></div>
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
