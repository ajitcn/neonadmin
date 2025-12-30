<?= $this->extend('templates/theme1')?>
 
 <?= $this->section('side-menu')?>
 	<?= $this->include('admin/_parts/_menu')?>
 <?= $this->endSection()?>

 <?= $this->section('top-menu')?>
    <?= $this->include('admin/_parts/_top_menu')?>
 <?= $this->endSection()?>

<?= $this->section('main-content')?>
<div class="row">
   <div class="col-md-4"><h3 class="custom-breadcrumb">Media Category</h3></div>
   <div class="col-md-8 text-right"> 
       
      <button class="btn thin-btn" data-toggle="modal" data-target="#newCategoryModal" type="button">+ New Category</button>
      
   </div> 
</div>
<div class="main-content">

   <?= display_session_msg()?>
   
   <section class="section">
      <div class="table-responsive">

      <table class="table custom-table table-striped" id="dataTable2">
         <thead>
            <tr>
               <th>Category</th>
               <th>Description</th>
               <th>Created At</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($categories as $cat):?>
                  
            <tr>
               <td>
                  <strong><?=$cat->category_name?></strong>
                  
                  <div class="mt-1">
                     <button class="btn thin-btn thin-btn-gray" title="Edit" data-toggle="tooltip"  type="button" onclick="openCategoryEditForm(<?=$cat->id?>)">
                        <i class="fa-solid fa-pen-to-square"></i>
                     </button>
                     
                     <a class="btn thin-btn thin-btn-gray delete_clk" title="Delete" data-toggle="tooltip" href="<?= base_url('admin/delete-media-category/'.$cat->id)?>">
                       <i class="fa-regular fa-trash-can"></i>
                     </a>
                    
                  </div>
                 
               </td>
               <td><?= $cat->description?></td>
               <td><?= _date($cat->created_at)?></td>
                
            </tr>
            <?php endforeach?> 
         </tbody>
      </table>
      </div>
      
   </section>
   
</div>


<!-- Modal Section Start -->

<?= view('admin/pages/_category_modals')?>

<!-- Modal Section End -->






 
<?= $this->endSection()?>