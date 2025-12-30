<?= $this->extend('templates/theme1')?>
 
 <?= $this->section('side-menu')?>
 	<?= $this->include('admin/_parts/_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('top-menu')?>
    <?= $this->include('admin/_parts/_top_menu')?>
 <?= $this->endSection()?>

<?= $this->section('main-content')?>
<div class="row">
   <div class="col-md-4"><h3 class="custom-breadcrumb">Members</h3></div>
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
               <th>Member Status</th>
               <th>Mobile#</th>
               <th>Email</th>
               <th>Subscription Validity</th>
               <th>Created At</th>
            </tr>
         </thead>
         <tbody>
            <?php
               foreach ($members as $member):
                  $status = ($member->status==='active')? 'success': 'danger';
               ?> 
            <tr>
               <td>
                  <strong><?=$member->member_name?></strong>
                  
                  <div class="mt-1">
                     <button class="btn thin-btn thin-btn-gray" title="Edit" data-toggle="tooltip"  type="button" onclick="openMemberEditForm(<?=$member->id?>)">
                        <i class="fa-solid fa-pen-to-square"></i>
                     </button>
                    <!--  <button class="btn thin-btn thin-btn-gray" title="Subscription" data-toggle="tooltip" type="button" onclick="openSubscriptionForm(<?=$member->id?>, '<?=$member->member_name?>')">
                        <i class="fa-solid fa-money-bill-1"></i>
                     </button> -->
                          
                     <a class="btn thin-btn thin-btn-gray" title="History" data-toggle="tooltip" href="#">
                       <i class="fa-solid fa-clock-rotate-left"></i>
                     </a>
                     <a class="btn thin-btn thin-btn-gray delete_clk" title="Delete" data-toggle="tooltip" href="<?= base_url('admin/delete-member/'.$member->id)?>">
                       <i class="fa-regular fa-trash-can"></i>
                     </a>
                    
                  </div>
                 
               </td>
                
               <td><span class="badge badge-<?= $status?>"><?=$member->status?></span></td>
               <td><?= $member->mobile_number?></td>
               <td><?= $member->member_email?></td>
                
               <td>
                  <?php if(strtotime($member->end_of_subscription)> strtotime('2024-01-01')):?>

                     <?= _dateOnly($member->end_of_subscription)?>

                     <?php if (strtotime($member->end_of_subscription)>= strtotime(date('Y-m-d'))):?>
                        <div class="badge badge-success">On</div>
                     <?php else:?>
                        <div class="badge badge-danger">Expired!</div>
                     <?php endif?>
                  <?php endif?>      
               </td>
               <td><?= _date($member->created_at)?></td>
                
            </tr>
            <?php endforeach?> 
         </tbody>
      </table>
      </div>
      <?= $link?>
   </section>
   
</div>


<!-- Modal Section Start -->

<?= view('admin/pages/_member_modals')?>

<!-- Modal Section End -->






 
<?= $this->endSection()?>