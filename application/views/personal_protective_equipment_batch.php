<?php 
include 'include/header.php';
include 'include/sidebar.php';
?>

<nav class="navbar navbar--blue navbar-static-top">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<div class="navbar-left">
				<ul class="navbar-breadcrumbs list-inline">
					<li><a href="<?php echo base_url();?>ppeims">Dashboard</a></li>
					<li>/</li>
					<li>Batch</li>
				</ul>
			</div>
	   	 	<ul class="nav navbar-nav navbar-right">
	   	 		<li class="dropdown">
	   	 			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $Lname;?> <span class="caret"></span></a>
	   	 			<ul class="dropdown-menu">
	   	 				<li><a href="<?php echo base_url();?>ppeims/emp_logout">Log Out</a></li>
	   	 			</ul>
	   	 		</li>
	   	 	</ul>
   	 	</div>
	</div>
</nav>
		
<div class="content">
	<div class="container-fluid">
		<section class="section">
			<div class="row">
				<div class="col-md-12">
				<?php if($message){
					  if (strpos($message, 'Completed') !== false || strpos($message, 'Saved') !== false){
				?>
						<!-- Alert for success -->
						<div class="alert alert-success alert-dismissable" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Success!</strong> <?=$message;?>
						</div><?php }else{?>
						<div class="alert alert-danger alert-dismissable" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Success!</strong> <?=$message;?>
						</div>
				<?php }} else{}?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="row-header">	
						<div class="row">
							<div class="col-md-8">
								<h1 class="page-title">Equipment Batch</h1>
							</div>
							<div class="col-md-4">
								<?php foreach ($gettransaction_last as $lt): ?>

									<?php if ($lt->Status == 0): ?>
										
										<a href="<?php echo base_url();?>ppeims/update_inventory/<?php echo "new_entry"?>" class="btn btn-success"><i class="glyphicon glyphicon-share-alt" aria-hidden="true"></i> Resume</a>
								
									<?php else: ?>
									
									<?php echo form_open("ppeims/addbatch"); ?>
										
										<input type="hidden" value="add-ui" name="access">
										<input type="hidden" class="form-control" value="<?php echo $Fname[0].". ".$Lname;?>" name="Pb">
										
										<?php 
											$data = [
												'class' => "btn btn-primary pull-right",
												'title' => 'Add Batch',
												'type' => 'submit'
											];
											echo form_button($data, '<i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Add');
											echo form_close();
										?>
									
									<?php endif; ?>
								
								<?php endforeach; ?>
								
								<a href="<?php echo base_url();?>ppeims/equipment_batch_drafts" class="btn btn-primary">
									Batch Drafts <span class="badge"><?php foreach ($getEquipmentListDraftCount as $row): echo $row->draftcount; endforeach; ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-4">
									<label for="search-item" class="sr-only">Search Batch</label>
									<div class="input-group">
										<input type="search" id="search-item" class="form-control" placeholder="Search batch...">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button">
												<i class="glyphicon glyphicon-search"></i>
												<span class="sr-only">Search</span>
											</button>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="col-md-1">No.</th>
										<th>Batch</th>
										<th>Total Item</th>
										<th>Completed</th>
										<th class="col-md-1">Action</th>
										<th class="col-md-1">View</th>
									</tr>
								</thead>
								<tbody>
								<?php $i=1;
								foreach ($getEquipmentList as $row){?>
								<tr>
									<th scope="row"><?= $i++;?></th>
									<td><?= $row->Tr_No;?></td>
									<td>0</td>
									<td><?= date('F d , Y',strtotime($row->Tr_Date));?></td>
									<td class="col-md-1">
										<a href="<?php echo base_url();?>ppeims/update_inventory/<?php echo $row->Tr_No;?>" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-wrench" aria-hidden="true"></i> <span class="sr-only">Adjust</span></a>
									</td>
									<td class="col-md-1">
										<a href="#" class="btn btn-default btn-xs" role="button" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-search"></i> <span class="sr-only">View</span></a>
									</td>
								</tr>
								<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4>Batch No. 003</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
						<tr class="active">
							<th>No.</th>
							<th>Particulars</th>
							<th>Added Stock</th>
							<th>Subtracted Stock</th>
							<th>Total Stock</th>
							<th>Reorder Point</th>
							<th>Expiration Date</th>
							<th>Remarks</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">1</th>
							<td>Hard Hat (Yellow)</td>
							<td>30 pcs</td>
							<td>0 pcs</td>
							<td>79 pcs</td>
							<td>10</td>
							<td>01-01-2018</td>
							<td></td>
						</tr>
						<tr>
							<th scope="row">2</th>
							<td>Protective Eyewear</td>
							<td>20 pcs</td>
							<td>0 pcs</td>
							<td>35 pcs</td>
							<td>10</td>
							<td>01-01-2018</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
						</tr>
						<tr>
							<th scope="row">3</th>
							<td>Face Shield</td>
							<td>50 pcs</td>
							<td>0 pcs</td>
							<td>50 pcs</td>
							<td>10</td>
							<td>01-01-2018</td>
							<td>Lorem ipsum dolor sit amet, consectetur.</td>
						</tr>
					</tbody>
				</table>
				<p>Date: 04-20-2017</p>
				<p>Prepared By: G. Manlimos</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-print" aria-hidden="true"></i> Print</button>
			</div>
		</div>
	</div>
</div>

<?php include 'include/footer.php';

// EOF