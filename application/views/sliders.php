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
					<iv class="col">
						<h6 class="mb-0 text-uppercase">Sliderler</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								

												<div class="d-flex align-items-center">
													<div>
														<h5 class="mb-0">Slider Listesi</h5>
													</div>
													<div class="font-18 ms-auto">
														<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="bx bx-plus"></i>Yeni Ekle
														</button>
														<!-- Yeni Ekle Modal -->
														<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">Slider Ekle</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																	</div>
																	<div class="modal-body">

																		<form action="sliders/insert/" method="POST" enctype="multipart/form-data">

																			<div class="form-group">
																				<label>Resim</label>
																				<input type="file" name="image" class="form-control form-control-lg mb-3">
																			</div>
																			<div class="form-group">
																				<label>İçerik</label>
																				<textarea name="content" class="ckeditor" class="form-control form-control-lg mb-3"></textarea>
																			</div>

																			<div class="col-md-6 float-start">
																				<div class="form-group">
																					<label>Sol Buton</label>
																					<input type="text" name="btn_left" class="form-control form-control-lg mb-3">
																				</div>
																				<div class="form-group">
																					<label>Sol Buton Link</label>
																					<input type="text" name="btn_left_link" class="form-control form-control-lg mb-3">
																				</div>
																			</div>
																			<div class="col-md-6 float-end">
																				<div class="form-group">
																					<label>Sağ Buton</label>
																					<input type="Sağ Buton" name="btn_right" class="form-control form-control-lg mb-3">
																				</div>
																				<div class="form-group">
																					<label>Sağ Buton Link</label>
																					<input type="text" name="btn_right_link" class="form-control form-control-lg mb-3">
																				</div>
																			</div>

																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
																				<button type="submit" class="btn btn-primary">Ekle</button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>
														<!-- !Yeni Ekle Modal -->
													</div>
												</div>
												<hr>

												<div class="table-responsive">
													<table class="table align-middle mb-0 table-hover">
														<thead class="table-light">
															<tr>
																<th><i class="lni lni-full-screen"></i></th>
																<th>#</th>
																<th>Resim</th>
																<th>Başlık</th>
																<th>Sol Buton</th>
																<th>Sağ buton</th>
																<th>Durum</th>
																<th>İşlem</th>
															</tr>
														</thead>
														<tbody id="sortable" data-url="<?php echo base_url("sliders/ranksetter"); ?>">

																<?php 
																	if ($sliders) {
																		foreach ($sliders as $sliders) {
																			?>

																				<tr id="rank-<?php echo $sliders->sliders_id ?>">
																					<td><i class="lni lni-full-screen"></i></td>

																					<td>#<?php echo $sliders->sliders_id ?></td>
																					<td>
																						<div class="ms-2">
																							<img class="rounded" src="uploads/<?php echo $sliders->sliders_image ?>" alt="" width="100">
																						</div>
																					</td>
																					<td><?php echo $sliders->sliders_content ?></td>
																					<td><?php echo $sliders->sliders_btn_left ?></td>
																					<td><?php echo $sliders->sliders_btn_right ?></td>
																					<td>

																						<div class="form-check form-switch">
																							<input class="form-check-input" type="checkbox" data-url="<?php echo base_url( "sliders/statusupdate/$sliders->sliders_id") ?>" id="isActive" <?php echo $sliders->sliders_status == 1 ? "checked" : "" ?>>
																						</div>
																					</td>
																					<td>
																						<div class="d-flex order-actions">	
																							<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editSocialModal_<?php echo $sliders->sliders_id ?>" class=""><i class="bx bx-edit"></i></a>
																							<a class="ms-4 deletesliders" data-id="<?php echo $sliders->sliders_id ?>" data-url="<?php echo base_url( "sliders/delete/$sliders->sliders_id") ?>"><i class="bx bx-trash"></i></a>
																						</div>
																					</td>
																				</tr>


																				<!-- Düzenle Modal -->
																				<div class="modal fade" id="editSocialModal_<?php echo $sliders->sliders_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
																					<div class="modal-dialog modal-lg">
																						<div class="modal-content">
																							<div class="modal-header">
																								<h5 class="modal-title" id="exampleModalLabel">Slider Güncelle</h5>
																								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																							</div>
																							<div class="modal-body">

																								<form action="sliders/update/<?php echo $sliders->sliders_id ?>" method="POST" enctype="multipart/form-data">


																									<div class="form-group">
																										<label>Resim</label>
																										<img width="100" src="uploads/<?php echo $sliders->sliders_image ?>">
																										<input type="file" name="image" class="form-control form-control-lg mb-3">
																									</div>
																									<div class="form-group">
																										<label>İçerik</label>
																										<textarea name="content" class="ckeditor" class="form-control form-control-lg mb-3"><?php echo $sliders->sliders_content ?></textarea>
																									</div>

																									<div class="col-md-6 float-start">
																										<div class="form-group">
																											<label>Sol Buton</label>
																											<input type="text" name="btn_left" class="form-control form-control-lg mb-3" value="<?php echo $sliders->sliders_btn_left ?>">
																										</div>
																										<div class="form-group">
																											<label>Sol Buton Link</label>
																											<input type="text" name="btn_left_link" class="form-control form-control-lg mb-3" value="<?php echo $sliders->sliders_btn_left_link ?>">
																										</div>
																									</div>
																									<div class="col-md-6 float-end">
																										<div class="form-group">
																											<label>Sağ Buton</label>
																											<input type="Sağ Buton" name="btn_right" class="form-control form-control-lg mb-3" value="<?php echo $sliders->sliders_btn_right ?>">
																										</div>
																										<div class="form-group">
																											<label>Sağ Buton Link</label>
																											<input type="text" name="btn_right_link" class="form-control form-control-lg mb-3" value="<?php echo $sliders->sliders_btn_right_link ?>">
																										</div>
																									</div>


																									<div class="modal-footer">
																										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
																										<button type="submit" class="btn btn-primary">Güncelle</button>
																									</div>
																								</form>
																							</div>
																						</div>
																					</div>
																				</div>
																				<!-- !Düzenle Modal -->

																			<?php
																		}
																	}else{
																		?>
																			<tr><td colspan="7">Herhangi bir slider eklenmemiştir.</td></tr>
																		<?php
																	}

																?>

														</tbody>
													</table>
												</div>



							</div>
						</div>
			   
					
				   </div><!--End Row-->




					  

			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->

<!-- footer -->
	<?php $this->load->view("footer.php"); ?>
<!-- end footer -->


<!-- bottom footer -->
	<?php $this->load->view("bottom-footer.php"); ?>
<!-- end  bottom footer -->



<script type="text/javascript">
	$( ".deletesliders" ).click(function() {//Sosyal medya silme
	  	var id = $(this).attr("data-id");
	  	var url = $(this).attr("data-url");
		Swal.fire({
			title: 'Silmek istediğinizden emin misiniz?',
			// showDenyButton: true,
			showCancelButton: true,
			cancelButtonText: "İptal",
			confirmButtonText: 'Evet, Sil',
			// denyButtonText: `Don't save`,
		}).then((result) => {
		/* Read more about isConfirmed, isDenied below */
		if (result.isConfirmed) {
			$(location).attr('href', url);

			// Swal.fire('Saved!', '', 'success')
		} else if (result.isDenied) {
			Swal.fire('Changes are not saved', '', 'info')
		}
		})
	});
</script>
