<?= $this->extend('templates/theme1')?>
 
 <?= $this->section('side-menu')?>
 	<?= $this->include('admin/_parts/_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('top-menu')?>
    <?= $this->include('admin/_parts/_top_menu')?>
 <?= $this->endSection()?>

<?= $this->section('main-content')?>
<div class="row">
   <div class="col-md-4"><h3 class="custom-breadcrumb">Payment Transaction</h3></div>
   <div class="col-md-8 text-right"> 
       
      <button class="btn thin-btn" data-toggle="modal" data-target="#memberFilterModal" type="button"><i class="fa-solid fa-filter"></i> Filter</button>
      <!-- <button class="btn thin-btn" data-toggle="modal" data-target="#newMemberModal" type="button">+ New Member</button> -->
      
   </div> 
</div>
<div class="main-content">

   <?= display_session_msg()?>
   
   <section class="section">
      <div class="table-responsive">

      <table class="table custom-table table-bordered">
         <thead>
            <tr>
               <th>Member</th>
               <th>Mobile#</th> 
               <th>Gateway</th> 
               <th>Amount</th> 
               <th>Payment Method</th> 
               <th>Trans. ref.</th> 
               <th>Payment Status</th>  
               <th>Trans. Date</th>
               <th>Created At</th>
            </tr>
         </thead>
         <tbody>
            <?php
               foreach ($transactions as $trans): ?> 
            <tr>
               <td>
                  <strong><?=$trans->member_name?></strong>
               </td>
               <td><?=$trans->mobile_number?></td>
               <td><?=$trans->payment_gateway_name?></td>
               <td><?=$trans->amount?> <span> <?=$trans->currency?></span></td>
               <td><?=$trans->payment_method?></td>
               <td><?=$trans->transaction_ref?></td>
               <td><?=$trans->payment_status?></td>
               <td><?= _date($trans->transaction_date)?></td>
               <td><?= _date($trans->created_at)?></td>
                
            </tr>
            <?php endforeach?> 
         </tbody>
      </table>
      </div>
      <?= $link?>
   </section>
   
</div>

 





 
<?= $this->endSection()?>