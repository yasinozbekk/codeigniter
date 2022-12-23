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
					<div class="col">
						<h6 class="mb-0 text-uppercase">Ürün Oluşturma Prototipi</h6>
						<hr/>
							<div class="card">
								<div class="card-body">
									<p> Bu prototip test için geliştirilmiştir.</p>

									<b>Kullanılan Teknolojiler : </b> 
									<li>Codeignither 3</li>
									<li>Jquery Ajax</li>
									<li>Bootstrap</li>
									<li>Mysql</li>
									<li>PHP</li>

									<b>Yapılacaklar : </b>
									<p>Kullanıcı sisteme hammadde tanımı yapacak ve hammaddelerden ürün
oluşturacak ve ürünleri birleştirip de yeni bir ürün oluşturabilecek.</p>

									<a href="<?php echo base_url(); ?>settings">
										<button class="btn btn-success">Projeye git</button>
									</a>
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


