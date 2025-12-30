<?= $this->extend('templates/theme1')?>
 
 <?= $this->section('side-menu')?>
    <?= $this->include('admin/_parts/_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('top-menu')?>
    <?= $this->include('admin/_parts/_top_menu')?>
 <?= $this->endSection()?>

<?= $this->section('main-content')?>
<div class="row">
   <div class="col-md-4"><h3 class="custom-breadcrumb">Promo Codes</h3></div>
   <div class="col-md-8 text-right"> 
       
      <button class="btn thin-btn" data-toggle="modal" data-target="#newPromoCodeModal" type="button">+ New Promo Code</button>
      
   </div> 
</div>
<div class="main-content">

   <?= display_session_msg()?>
   
   <section class="section">
      <div class="table-responsive">

      <table class="table custom-table table-striped" id="dataTable2">
         <thead>
            <tr>
               <th>Promo Code Name</th>
               <th>Discount Type</th>
               <th>Discount</th>
               <th>Max Use</th>
               <th>Valid From</th>
               <th>Valid Till</th>
               <th>Status</th>
               <th>Description</th>
               <th>Created At</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($promo_codes as $promo):?>
                  
            <tr>
               <td>
                  <strong><?=$promo->promo_code_name?></strong>
                  
                  <div class="mt-1">
                    <button class="btn thin-btn thin-btn-gray" title="Edit" data-toggle="tooltip" type="button" onclick="openPromoCodeEditForm(<?=$promo->id?>)">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                     <a class="btn thin-btn thin-btn-gray delete_clk" title="Delete" data-toggle="tooltip" href="<?= base_url('admin/delete-promo-code/'.$promo->id)?>">
                       <i class="fa-regular fa-trash-can"></i>
                     </a>
                    
                  </div>
                 
               </td>
               <td><?= $promo->discount_type?></td>
               <td><?= $promo->discount?></td>
               <td><?= $promo->max_use?></td>
               <td><?= _dateOnly($promo->valid_from)?></td>
               <td><?= _dateOnly($promo->valid_till)?></td>
               <td><?= $promo->status?></td>
               <td><?= $promo->description?></td>
               <td><?= _date($promo->created_at)?></td>
                
            </tr>
            <?php endforeach?> 
         </tbody>
      </table>
      </div>
      
   </section>
   
</div>

<!-- Modal Section Start -->
<?= view('admin/pages/_promocode_modals')?>
<!-- Modal Section End -->

<?= $this->endSection()?>
