<?= $this->extend('templates/theme1')?>
 
 <?= $this->section('side-menu')?>
    <?= $this->include('admin/_parts/_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('top-menu')?>
    <?= $this->include('admin/_parts/_top_menu')?>
 <?= $this->endSection()?>

<?= $this->section('main-content')?>
<div class="row">
   <div class="col-md-4"><h3 class="custom-breadcrumb">Packages</h3></div>
   <div class="col-md-8 text-right"> 
       
      <button class="btn thin-btn" data-toggle="modal" data-target="#newPackageModal" type="button">+ New Package</button>
      
   </div> 
</div>
<div class="main-content">

   <?= display_session_msg()?>
   
   <section class="section">
      <div class="table-responsive">

      <table class="table custom-table table-bordered" id="dataTable2">
         <thead>
            <tr>
               <th>Package Name</th>
               <th>MRP</th>
               <th>Duration - Type</th>
               <th>Ad Free</th>
               <th>Device</th>
               <th>Quality</th>
               <th>On Rent</th>
               <th>Other Details</th>
               <th>Description</th>
               <th>Created At</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($packages as $pkg):?>
                  
            <tr>
               <td>
                  <strong><?=$pkg->package_name?></strong>
                  
                  <div class="mt-1">
                    <button class="btn thin-btn thin-btn-gray" title="Edit" data-toggle="tooltip" type="button" onclick="openPackageEditForm(<?=$pkg->id?>)">
    <i class="fa-solid fa-pen-to-square"></i>
</button>

                     
                     <a class="btn thin-btn thin-btn-gray delete_clk" title="Delete" data-toggle="tooltip" href="<?= base_url('admin/delete-package/'.$pkg->id)?>">
                       <i class="fa-regular fa-trash-can"></i>
                     </a>
                    
                  </div>
                 
               </td>
               <td><?= $pkg->package_mrp?></td>
               <td><?= $pkg->duration?> - <?= $pkg->duration_type?></td>
                
               <td><?= (int)$pkg->ad_free===1 ? 'Yes' : 'No'?></td>
               <td><?= $pkg->device?></td>
               <td><?= $pkg->quality?></td>
               <td><?= (int)$pkg->on_rent===1 ? 'Yes' : 'No'?></td>
               <td><?= $pkg->other_details?></td>
               <td><?= $pkg->description?></td>
               <td><?= _date($pkg->created_at)?></td>
                
            </tr>
            <?php endforeach?> 
         </tbody>
      </table>
      </div>
      
   </section>
   
</div>

<!-- Modal Section Start -->

<?= view('admin/pages/_package_modals')?>

<!-- Modal Section End -->

 
<?= $this->endSection()?>
