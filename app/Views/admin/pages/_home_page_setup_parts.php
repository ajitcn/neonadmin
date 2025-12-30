<ul class="m-0 p-0">
	<?php foreach($records as $data):?>
	<li class="d-inline-block border p-3 mb-2 text-center">
		<img class="img-thumbnail" style="max-width: 200px;" src="<?= $data->thumbnail_url?>">
		<h5 class="mt-2 text-center"><?= $data->title?></h5>
		<div class="mb-2">
			<span class="badge badge-light border"><?= $data->content_type?></span> 
			<span class="badge badge-light border"><?= $data->layout_type?></span> 
			<span class="badge badge-light border">#<?= $data->position_number?></span> 
		</div>
		<div>
         <button class="btn thin-btn thin-btn-gray" title="Edit" data-toggle="tooltip"  type="button" onclick="openHomePageSetupEditForm(<?=$data->id?>)">
            <i class="fa-solid fa-pen-to-square"></i>
         </button>
         
         
         <a class="btn thin-btn thin-btn-gray delete_clk" title="Delete" data-toggle="tooltip" href="<?= base_url('admin/delete-home-page-setup/'.$data->id)?>?section=<?=$section?>">
           <i class="fa-regular fa-trash-can"></i>
         </a>
      </div>
	</li>
	<?php endforeach?>
</ul>


<?php if(sizeof($records)===0):?>
	<p class="text-muted">Nothing found...</p>
<?php endif?>
