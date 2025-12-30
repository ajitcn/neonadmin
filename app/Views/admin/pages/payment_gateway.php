<?= $this->extend('templates/theme1')?>
 
 <?= $this->section('side-menu')?>
 	<?= $this->include('admin/_parts/_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('top-menu')?>
    <?= $this->include('admin/_parts/_top_menu')?>
 <?= $this->endSection()?>

<?= $this->section('main-content')?>
<div class="row">
   <div class="col-md-4"><h3 class="custom-breadcrumb">Payment Gateway</h3></div>
   <div class="col-md-8 text-right"> 
       
      <!-- <button class="btn thin-btn" data-toggle="modal" data-target="#newPaymentGatewayModal" type="button">+ New Payment Gateway</button> -->
      
   </div> 
</div>
<div class="main-content">

   <?= display_session_msg()?>
   
   <section class="section">
      <div class="table-responsive">

      <table class="table custom-table table-striped" id="dataTable2">
         <thead>
            <tr>
               <th>Gateway Name</th>
               <th>API Key</th>
               <th>Secret Key</th>
               <th>Merchant ID</th>
               <th>Status</th>
               <th>Created At</th>
               <th>Updated At</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($paymentGateways as $pg):?>
                  
            <tr>
               <td>
                  <strong><?=$pg->payment_gateway_name?></strong>
                  
                  <div class="mt-1">
                     <button class="btn thin-btn thin-btn-gray" title="Edit" data-toggle="tooltip"  type="button" onclick="openPaymentGatewayEditForm(<?=$pg->id?>)">
                        <i class="fa-solid fa-pen-to-square"></i>
                     </button>
                     
                    <!--  <a class="btn thin-btn thin-btn-gray delete_clk" title="Delete" data-toggle="tooltip" href="<?= base_url('admin/delete-payment-gateway/'.$pg->id)?>">
                       <i class="fa-regular fa-trash-can"></i>
                     </a> -->
                    
                  </div>
                 
               </td>
               <td><?= $pg->api_key?></td>
               <td><?= $pg->secret_code?></td>
               <td><?= $pg->merchant_id?></td>
               <td><?= $pg->status?></td>
               <td><?= _date($pg->created_at)?></td>
               <td><?= _date($pg->updated_at)?></td>
                
            </tr>
            <?php endforeach?> 
         </tbody>
      </table>
      </div>
      
   </section>
   
</div>


<!-- Modal Section Start -->

<?= view('admin/pages/_payment_gateway_modals')?>

<!-- Modal Section End -->






 
<?= $this->endSection()?>