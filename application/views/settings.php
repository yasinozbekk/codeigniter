<!-- TOP HEADER -->
<?php $this->load->view("top-header.php"); ?>
<!-- END TOP HEADER -->
	<!--wrapper-->
	<div class="wrapper">
		<!-- HEADER -->
		<?php $this->load->view("header.php"); ?>
		<!-- END HEADER -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col col-md-6">
						<h6 class="mb-0 text-uppercase">Ürün veya Hammade oluştur</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<ul class="nav nav-pills nav-pills-danger mb-3" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" data-bs-toggle="pill" href="#danger-pills-siteayar" role="tab" aria-selected="true">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
												</div>
												<div class="tab-title">Ürün Ekle</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="pill" href="#danger-pills-iletisimayar" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class='bx bx-mail-send font-18 me-1'></i>
												</div>
												<div class="tab-title">Hammadde Ekle</div>
											</div>
										</a>
									</li>
								</ul>
								<!------------------------------------------------------------------------------------------------------------------------>
								<!------------------------------------------------------------------------------------------------------------------------>
								<!------------------------------------------------------------------------------------------------------------------------>
								<div class="tab-content" id="danger-pills-tabContent">
									<div class="tab-pane fade show active" id="danger-pills-siteayar" role="tabpanel">
										<form action="settings/insertproduct/" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label>Ürün Adı</label>
												<input type="text" value=""  name="productName" class="form-control form-control-lg mb-3">
											</div>
											<hr>
											<center><h4>İçindekiler</h4></center>
											<div class="form-group col-md-6 float-start">
												<label>Ürün Seç</label>
												<select class="form-control mb-3 multiple-select" data-placeholder="Choose anything" multiple="multiple" name="productParentId[]">
													<?php 
														foreach ($products as $products1) {
															?>
																<option value="<?php echo $products1->products_id ?>"><?php echo $products1->products_name ?></option>
															<?php
														}
													?>
												</select>
											</div>
											<div class="form-group col-md-6 float-end">
												<label>Hammadde Seç</label>

												<select class="form-control mb-3 multiple-select" data-placeholder="Choose anything" multiple="multiple" name="materialsId[]">
													<?php 
														foreach ($materials as $materials1) {
															?>
																<option value="<?php echo $materials1->materials_id ?>"><?php echo $materials1->materials_name ?></option>
															<?php
														}
													?>
												</select>
											</div>
										
											<div class="form-group float-end mt-4">
												<input type="submit" name="footer" class="btn btn-primary" value="Kaydet">
											</div>
										</form>
									</div>
									<div class="tab-pane fade" id="danger-pills-iletisimayar" role="tabpanel">
										<form action="settings/insertmaterials/" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label>Hammadde Adı</label>
												<input type="text" value="" name="materialName" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group float-end mt-4">
												<input type="submit" name="footer" class="btn btn-primary" value="Kaydet">
											</div>

										</form>

									</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col col-md-3">
							<h6 class="mb-0 text-uppercase">Ürünler</h6>
							<hr/>
							<div class="card">
								<div class="card-body">
									<div class="tab-content" id="danger-pills-tabContent">
										<div class="tab-pane fade show active" id="danger-pills-siteayar" role="tabpanel">
											<?php 
												foreach ($products as $productsList) {
													?>
														<li class="dataPrint_<?php echo $productsList->products_id ?>"><b><?php echo $productsList->products_name ?> </b>
																(<?php echo $this->dm->count("product_to_product",array("products_id" => $productsList->products_id)); ?> Ürün, 
																<?php echo $this->dm->count("product_to_material",array("products_id" => $productsList->products_id)); ?> Madde)
																<i class="bx bx-plus-circle font-18 text-primary productDetail" data-id="<?php echo $productsList->products_id ?>" data-url="<?php echo base_url( "settings/deneme/$productsList->products_id") ?>"></i>
																<i class="bx bx-trash font-18 text-danger deleteProduct" data-id="<?php echo $productsList->products_id ?>" data-url="<?php echo base_url( "settings/deleteproduct/$productsList->products_id") ?>"></i>
															<?php 
															foreach ($materialsselect as $materialsselect1) {
																echo "<ul><li>".$materialsselect1->materials_name."</li></ul>";
															}
															?>
														</li>
													<?php
												}
											?>
										</div>

									</div>
								</div>
							</div>
						</div>
					<div class="col col-md-3">
							<h6 class="mb-0 text-uppercase">Hammaddeler</h6>
							<hr/>
							<div class="card">
								<div class="card-body">
									<div class="tab-content" id="danger-pills-tabContent">
										<div class="tab-pane fade show active" id="danger-pills-siteayar" role="tabpanel">
											
											<?php 
												foreach ($materials as $materialsList) {
													// $parentId = $materialsList->materials_parent_id > 0 ? "(Baba)" : "";
													?>
														<li><?php echo $materialsList->materials_name ?> 
																<i class="bx bx-trash font-18 text-danger deleteProduct" data-id="<?php echo $materialsList->materials_id ?>" data-url="<?php echo base_url( "settings/deletematerial/$materialsList->materials_id") ?>"></i>
															<?php 
															foreach ($materialsselect as $materialsselect1) {
																echo "<ul><li>".$materialsselect1->materials_name."</li></ul>";
															}
															?>
														</li>
													<?php
												}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
				   </div><!--End Row-->
			</div>
		</div>
		<div class="overlay toggle-icon"></div>
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

<!-- footer -->
	<?php $this->load->view("footer.php"); ?>
<!-- end footer -->


<!-- bottom footer -->
	<?php $this->load->view("bottom-footer.php"); ?>
<!-- end  bottom footer -->

<script src="<?php echo base_url(); ?>assets/js/product.js"></script>


