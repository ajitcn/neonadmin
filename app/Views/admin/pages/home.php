<?= $this->extend('templates/theme1')?>
 
 <?= $this->section('side-menu')?>
 	<?= $this->include('admin/_parts/_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('top-menu')?>
    <?= $this->include('admin/_parts/_top_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('main-content')?>
 	<h3 class="custom-breadcrumb">Dashboard</h3>
    

 
    <div class="main-content dashboard">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="box box-color1">
                    <div class="row">
                        <div class="col"><div class="box-icon"><i class="fa-solid fa-users"></i></div></div>
                        <div class="col-8">
                            <div class="box-down">Lifetime Members</div>
                            <div class="box-right"><?= $totalMember?></div>
                        </div>
                         
                    </div>

                </div>
            </div>
            
            <div class="col-12 col-md-3">
                <div class="box box-color2">
                    <div class="row">
                        <div class="col"><div class="box-icon"><i class="fa-solid fa-user-check"></i></div></div>
                        <div class="col-8">
                            <div class="box-down">Active Member</div>
                            <div class="box-right"><?= $activeMember?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="box box-color2">
                    <div class="row">
                        <div class="col"><div class="box-icon"><i class="fa-solid fa-sack-dollar"></i></div></div>
                        <div class="col-8">
                            <div class="box-down">Total Payments</div>
                            <div class="box-right"><?= $totalPayment?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="box box-color2">
                    <div class="row">
                        <div class="col"><div class="box-icon"><i class="fa-solid fa-sack-dollar"></i></div></div>
                        <div class="col-8">
                            <div class="box-down">30 Days Payments </div>
                            <div class="box-right"><?= $last30DaysPayment?></div>
                        </div>
                    </div>
                </div>
            </div>
             
             
        </div>





          <section class="section">
            <div class="row">
                
            <div class="col-6">
                <div class="card">
                  <div class="card-header">
                     Recent Members
                  </div>
                  <div class="card-body">
                     <table class="table custom-table">
                         <thead>
                             <tr>
                                 <th>Member</th>
                                 <th>Created At</th>
                             </tr>
                         </thead>
                         <tbody>
                            <?php foreach($recentMembers as $rm):?>
                             <tr>
                                 <td>
                                     <strong><?= $rm->member_name?></strong>
                                 </td>
                                 <td><?= _date($rm->created_at)?></td>
                             </tr>
                            <?php endforeach?>
                         </tbody>
                         <?php if(sizeof($recentMembers)===0):?>
                            <tr>
                                <td colspan="2"><p class="text-muted">Nothing to show...</p></td>
                            </tr>
                         <?php endif?>
                     </table>
                  </div>
                  
                </div>
            </div>


            <div class="col-6">
                <div class="card">
                  <div class="card-header">
                     Recent Transactions
                  </div>
                  <div class="card-body">
                     <table class="table custom-table">
                         <thead>
                             <tr>
                                 <th>Member</th>
                                 <th>Amount</th>
                                 <th>Created At</th>
                             </tr>
                         </thead>
                         <tbody>
                            <?php foreach($payments as $payment):?>
                             <tr>
                                 <td>
                                     <strong><?= $payment->member_name?></strong>
                                 </td>
                                 <td>
                                     <strong><?= $payment->amount?></strong>
                                 </td>
                                 <td><?= _date($payment->created_at)?></td>
                             </tr>
                            <?php endforeach?>
                         </tbody>
                         <?php if(sizeof($payments)===0):?>
                            <tr>
                                <td colspan="2"><p class="text-muted">Nothing to show...</p></td>
                            </tr>
                         <?php endif?>
                     </table>
                  </div>
                  
                </div>
            </div>
             

            
        </div>
        </section>


    
        
    </div>
 




 <?= $this->endSection()?>