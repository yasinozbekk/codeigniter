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
						<h6 class="mb-0 text-uppercase">Danger Nav Tabs</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<!-- Site ayarları, İletişim ayarları, Smtp ayarları, logo ve favicon ayarları, sosyalmedya auarları -->

								<ul class="nav nav-pills nav-pills-danger mb-3" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" data-bs-toggle="pill" href="#danger-pills-siteayar" role="tab" aria-selected="true">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
												</div>
												<div class="tab-title">Site Ayarları</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="pill" href="#danger-pills-iletisimayar" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class='bx bx-mail-send font-18 me-1'></i>
												</div>
												<div class="tab-title">İletişim Ayarları</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="pill" href="#danger-pills-smtpayar" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class='bx bx-envelope font-18 me-1'></i>
												</div>
												<div class="tab-title">Smtp Ayarları</div>
											</div>
										</a>
									</li>



									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="pill" href="#danger-pills-logoayar" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class='bx bx-paint font-18 me-1'></i>
												</div>
												<div class="tab-title">Logo & Favicon Ayarları</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="pill" href="#danger-pills-sosyalayar" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class='bx bx-share-alt font-18 me-1'></i>
												</div>
												<div class="tab-title">Sosyal Medya Ayarları</div>
											</div>
										</a>
									</li>

								</ul>

								<!------------------------------------------------------------------------------------------------------------------------>
								<!------------------------------------------------------------------------------------------------------------------------>
								<!------------------------------------------------------------------------------------------------------------------------>
								<div class="tab-content" id="danger-pills-tabContent">
									<div class="tab-pane fade show active" id="danger-pills-siteayar" role="tabpanel">

										<form action="settings/updateSettings/<?php echo $settings->id; ?>" method="POST" enctype="multipart/form-data">

											<div class="form-group">
												<label>Site Title</label>
												<input type="text" value="<?php echo $settings->title; ?>" name="title" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<label>Site Description</label>
												<input type="text" value="<?php echo $settings->description; ?>"  name="description" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<label>Site Keywords</label>
												<input type="text" value="<?php echo $settings->keywords; ?>"  name="keywords" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<label>Site Author</label>
												<input type="text" value="<?php echo $settings->author; ?>"  name="author" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<label>Site Footer</label>
												<input type="text" value="<?php echo $settings->footer; ?>"  name="footer" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<input type="submit"  name="footer" class="btn btn-primary" value="Güncelle">
											</div>

										</form>

									</div>
									<div class="tab-pane fade" id="danger-pills-iletisimayar" role="tabpanel">
										

										<form action="settings/updateContactSettings/<?php echo $settings->id; ?>" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label>Telefon</label>
												<input type="text" value="<?php echo $settings->phone; ?>" name="phone" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<label>Mail</label>
												<input type="text" value="<?php echo $settings->mail; ?>" name="mail" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<label>Adres</label>
												<input type="text" value="<?php echo $settings->address; ?>" name="address" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<label>Harita</label>
												<textarea rows="5" class="form-control form-control-lg mb-3" name="map"><?php echo $settings->map; ?></textarea>
											</div>
											<div class="form-group">
												<input type="submit" name="footer" class="btn btn-primary" value="Güncelle">
											</div>

										</form>

									</div>
									<div class="tab-pane fade" id="danger-pills-smtpayar" role="tabpanel">
										
										<form action="settings/updateSmtpSettings/<?php echo $settings->id; ?>" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label>Host</label>
												<input type="text" value="<?php echo $settings->host; ?>" name="host" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<label>Kullanıcı Mail</label>
												<input type="text" value="<?php echo $settings->user_mail; ?>" name="user_mail" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<label>Şifre</label>
												<input type="text" value="<?php echo $settings->user_password; ?>" name="user_password" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<label>Port</label>
												<input type="text" value="<?php echo $settings->port; ?>" name="port" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<label>Bilgilendirme Mail</label>
												<input type="text" value="<?php echo $settings->notification_mail; ?>" name="notification_mail" class="form-control form-control-lg mb-3">
											</div>
											<div class="form-group">
												<input type="submit" name="footer" class="btn btn-primary" value="Güncelle">
											</div>

										</form>

									</div>


									<div class="tab-pane fade" id="danger-pills-logoayar" role="tabpanel">
										
										<form action="settings/updateLogoSettings/<?php echo $settings->id; ?>" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label>Yüklü Olan Logo</label>
												<img src="uploads/<?php echo $settings->logo; ?>" width="200" height="100" class="img-thumbnail">
											</div>

											<div class="form-group">
												<label>Yüklenecek Logo</label>
												<input type="file" name="logo" class="form-control form-control-lg mb-3">
											</div>

											<div class="form-group">
												<input type="submit" name="footer" class="btn btn-primary" value="Güncelle">
											</div>
										</form>
<hr>


										<form action="settings/updateFaviconSettings/<?php echo $settings->id; ?>" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label>Yüklü Olan Favicon</label>
												<img src="uploads/<?php echo $settings->favicon; ?>" width="100" height="50" class="img-thumbnail">
											</div>

											<div class="form-group">
												<label>Yüklenecek Favicon</label>
												<input type="file" name="favicon" class="form-control form-control-lg mb-3">
											</div>
											
											<div class="form-group">
												<input type="submit" name="footer" class="btn btn-primary" value="Güncelle">
											</div>
										</form>


									</div>
									<div class="tab-pane fade" id="danger-pills-sosyalayar" role="tabpanel">
						<div class="card-body">
												<div class="d-flex align-items-center">
													<div>
														<h5 class="mb-0">Hesap Listesi</h5>
													</div>
													<div class="font-18 ms-auto">
														<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="bx bx-plus"></i>Yeni Ekle
														</button>
														<!-- Yeni Ekle Modal -->
														<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">Sosyal Medya Ekle</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																	</div>
																	<div class="modal-body">

																		<form action="socialmedia/accountSave/" method="POST" enctype="multipart/form-data">

																			<div class="form-group">
																				<label>Başlık</label>
																				<input type="text" name="title" class="form-control form-control-lg mb-3">
																			</div>
																			<div class="form-group">
																				<label>Icon</label>
																				<small>Icon seçmek için buraya <a href="https://lineicons.com/icons/" target="_blank">tıklayınız</a></small>
																				<input type="text" name="icon" class="form-control form-control-lg mb-3">
																			</div>
																			<div class="form-group">
																				<label>Link</label>
																				<input type="text" name="link" class="form-control form-control-lg mb-3">
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
																<th>Icon</th>
																<th>Başlık</th>
																<th>Link</th>
																<th>Durum</th>
																<th>İşlem</th>
															</tr>
														</thead>
														<tbody id="sortable" data-url="<?php echo base_url("socialmedia/ranksetter"); ?>">

																<?php 
																	if ($socialmedia) {
																		foreach ($socialmedia as $socialmedia) {
																			?>

																				<tr id="rank-<?php echo $socialmedia->socialmedia_id ?>">
																					<td><i class="lni lni-full-screen"></i></td>

																					<td>#<?php echo $socialmedia->socialmedia_id ?></td>
																					<td>
																						<div class="ms-2">
																							<h6 class="mb-1 font-14"><i class="<?php echo $socialmedia->socialmedia_icon ?>"></i></h6>
																						</div>
																					</td>
																					<td><?php echo $socialmedia->socialmedia_title ?></td>
																					<td><?php echo $socialmedia->socialmedia_link ?></td>
																					<td>

																						<div class="form-check form-switch">
																							<input class="form-check-input" type="checkbox" data-url="<?php echo base_url( "socialmedia/isactivesetter/$socialmedia->socialmedia_id") ?>" id="isActive" <?php echo $socialmedia->socialmedia_status == 1 ? "checked" : "" ?>>
																						</div>
																					</td>
																					<td>
																						<div class="d-flex order-actions">	
																							<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editSocialModal_<?php echo $socialmedia->socialmedia_id ?>" class=""><i class="bx bx-edit"></i></a>
																							<a class="ms-4 deleteSocialMedia" data-id="<?php echo $socialmedia->socialmedia_id ?>" data-url="<?php echo base_url( "socialmedia/accountDelete/$socialmedia->socialmedia_id") ?>"><i class="bx bx-trash"></i></a>
																						</div>
																					</td>
																				</tr>


																				<!-- Düzenle Modal -->
																				<div class="modal fade" id="editSocialModal_<?php echo $socialmedia->socialmedia_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
																					<div class="modal-dialog">
																						<div class="modal-content">
																							<div class="modal-header">
																								<h5 class="modal-title" id="exampleModalLabel">Sosyal Medya Güncelle</h5>
																								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																							</div>
																							<div class="modal-body">

																								<form action="socialmedia/accountUpdate/<?php echo $socialmedia->socialmedia_id ?>" method="POST" enctype="multipart/form-data">

																									<div class="form-group">
																										<label>Başlık</label>
																										<input type="text" name="title" value="<?php echo $socialmedia->socialmedia_title ?>" class="form-control form-control-lg mb-3">
																									</div>
																									<div class="form-group">
																										<label>Icon</label>
																										<small>Icon seçmek için buraya <a href="https://lineicons.com/icons/" target="_blank">tıklayınız</a></small>
																										<input type="text" name="icon" value="<?php echo $socialmedia->socialmedia_icon ?>" class="form-control form-control-lg mb-3">
																									</div>
																									<div class="form-group">
																										<label>Link</label>
																										<input type="text" name="link" value="<?php echo $socialmedia->socialmedia_link ?>" class="form-control form-control-lg mb-3">
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
																			<tr><td colspan="7">Herhangi bir hesap eklenmemiştir.</td></tr>
																		<?php
																	}

																?>

														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
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
	$( ".deleteSocialMedia" ).click(function() {//Sosyal medya silme
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
