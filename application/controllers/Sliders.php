<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sliders extends CI_Controller {


	public function __construct()
	{
		parent:: __construct();

		$this->load->model("default_model");//model dosyasını çağırıyoruz
	}


	public function index()
	{
		$viewData = new stdClass();
		$sliders = $this->default_model->get_all("sliders", array(), "sliders_rank ASC");

		$viewData->sliders = $sliders;
		$this->load->view('sliders.php', $viewData);//ilk açılacak sayfa // welcome_message viewi açılsın
	}


	public function insert() {
		$content = $this->input->post("content");
		$btn_right = $this->input->post("btn_right");
		$btn_right_link = $this->input->post("btn_right_link");
		$btn_left = $this->input->post("btn_left");
		$btn_left_link = $this->input->post("btn_left_link");

		if(!$content || !$btn_right || !$btn_right_link || !$btn_left || !$btn_left_link){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("sliders"));//yönlendirme
		}else{
			if(!empty($_FILES['image']["name"])){//ismi boş mu değil mi
				//yükleme işlemleri

				//Dosyanın yüklenecek olan yolu
				$config["upload_path"] = "uploads/sliders/";
				//İzinli uzantılar
				$config["allowed_types"] = "gif|jpg|png|jpeg|svg";
				$config["file_name"] = uniqid();
				//upload kütüphanesini yükler
				$this->load->library("upload",$config);//configde autoloadda yapmama sebebimiz sadece burada kullanılacak heryerde kullanılmayacağı için

				//resim yükleme işlemi yapar
				$upload = $this->upload->do_upload("image");

				if($upload){
					//yüklenen dosyanın adını alıyoruz
					$uploaded_filename = $this->upload->data("file_name");

					//yeni kütüphanenin ayarları
					$config["image_library"] = "gd2";
					//bu fotoğrafın ayarlarıyla oynacak
					$config["source_image"] = "uploads/sliders/".$uploaded_filename;
					//thumbnail oluştursun mu
					$config["create_thumb"] = FALSE;
					//fotoğrafın oranları korunsun mu eşit düzyde
					$config["maintain_ratio"] = FALSE;
					//resmin kalitesi
					$config["quality"] = "100%";

					$config["width"] = 1280;
					$config["height"] = 560;

					$this->load->library("image_lib",$config);//çağırdığımız kütüphane çalışırken $config ayarlarını uygulayarak çalışsın
					$this->image_lib->resize();//işlemler tamamlandıktan sonra fotoğrafa uygula

					$insert = $this->default_model->insert("sliders",
						array(
							"sliders_content" => $content,
							"sliders_btn_left" => $btn_left,
							"sliders_btn_left_link" => $btn_left_link,
							"sliders_btn_right" => $btn_right,
							"sliders_btn_right_link" => $btn_right_link,
							"sliders_image" => "sliders/".$uploaded_filename,
							"sliders_status" => 1,
							"sliders_rank" => 0,
							"sliders_created_at" => date("Y-m-d")
						));

					//işlem başarılıysa
					if($insert){

						$alert = array(
							"title" => "Başarılı!",
							"subTitle" => "Veriler başarıyla eklendi!",
							"type" => "success"
						);


					}else{

						$alert = array(
							"title" => "Hata!",
							"subTitle" => "Güncellenirken bir hata oluştu!",
							"type" => "error"
						);
					}
					
				}else{//fotoğraf hatalıysa

					$alert = array(
						"title" => "Hata!",
						"subTitle" => "Fotoğraf yüklenirken bir hata oluştu!",
						"type" => "error"
					);
				}

			}else{

				$alert = array(
					"title" => "Dikkat!",
					"subTitle" => "Fotoğraf alanı boş bırakılamaz!",
					"type" => "warning"
				);
			}


			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("sliders"));
		}

	}

	public function update($id) {
		$content = $this->input->post("content");
		$btn_right = $this->input->post("btn_right");
		$btn_right_link = $this->input->post("btn_right_link");
		$btn_left = $this->input->post("btn_left");
		$btn_left_link = $this->input->post("btn_left_link");


		echo "<br>".$content;
		echo "<br>".$btn_right;
		echo "<br>".$btn_right_link;
		echo "<br>".$btn_left;
		echo "<br>".$btn_left_link;
		if(!$content || !$btn_right || !$btn_right_link || !$btn_left || !$btn_left_link){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("sliders"));//yönlendirme
		}else{
			if(!empty($_FILES['image']["name"])){//ismi boş mu değil mi

				$image_data = $this->default_model->get("sliders",
				array(
					"sliders_id" => $id
				));
				unlink("uploads/".$image_data->sliders_image);

				//yükleme işlemleri

				//Dosyanın yüklenecek olan yolu
				$config["upload_path"] = "uploads/sliders/";
				//İzinli uzantılar
				$config["allowed_types"] = "gif|jpg|png|jpeg|svg";
				$config["file_name"] = uniqid();
				//upload kütüphanesini yükler
				$this->load->library("upload",$config);//configde autoloadda yapmama sebebimiz sadece burada kullanılacak heryerde kullanılmayacağı için

				//resim yükleme işlemi yapar
				$upload = $this->upload->do_upload("image");

				if($upload){
					//yüklenen dosyanın adını alıyoruz
					$uploaded_filename = $this->upload->data("file_name");

					//yeni kütüphanenin ayarları
					$config["image_library"] = "gd2";
					//bu fotoğrafın ayarlarıyla oynacak
					$config["source_image"] = "uploads/sliders/".$uploaded_filename;
					//thumbnail oluştursun mu
					$config["create_thumb"] = FALSE;
					//fotoğrafın oranları korunsun mu eşit düzyde
					$config["maintain_ratio"] = FALSE;
					//resmin kalitesi
					$config["quality"] = "100%";

					$config["width"] = 1280;
					$config["height"] = 560;

					$this->load->library("image_lib",$config);//çağırdığımız kütüphane çalışırken $config ayarlarını uygulayarak çalışsın
					$this->image_lib->resize();//işlemler tamamlandıktan sonra fotoğrafa uygula

					$update = $this->default_model->update("sliders",
						array(
							"sliders_id" => $id
						),
						array(
							"sliders_content" => $content,
							"sliders_btn_left" => $btn_left,
							"sliders_btn_left_link" => $btn_left_link,
							"sliders_btn_right" => $btn_right,
							"sliders_btn_right_link" => $btn_right_link,
							"sliders_image" => "sliders/".$uploaded_filename
						));

					//işlem başarılıysa
					if($update){

						$alert = array(
							"title" => "Başarılı!",
							"subTitle" => "Veriler başarıyla güncellendi!",
							"type" => "success"
						);


					}else{

						$alert = array(
							"title" => "Hata!",
							"subTitle" => "Güncellenirken bir hata oluştu!",
							"type" => "error"
						);
					}
					
				}else{//fotoğraf hatalıysa

					$alert = array(
						"title" => "Hata!",
						"subTitle" => "Fotoğraf yüklenirken bir hata oluştu!",
						"type" => "error"
					);
				}

			}else{


				$update = $this->default_model->update("sliders",
					array(
						"sliders_id" => $id
					),
					array(
						"sliders_content" => $content,
						"sliders_btn_left" => $btn_left,
						"sliders_btn_left_link" => $btn_left_link,
						"sliders_btn_right" => $btn_right,
						"sliders_btn_right_link" => $btn_right_link
						//burda fotoğraf değiştirilmeyecek
					));

				//işlem başarılıysa
				if($update){

					$alert = array(
						"title" => "Başarılı!",
						"subTitle" => "Veriler başarıyla güncellendi!",
						"type" => "success"
					);


				}else{

					$alert = array(
						"title" => "Hata!",
						"subTitle" => "Güncellenirken bir hata oluştu!",
						"type" => "error"
					);
				}
					
			}


			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("sliders"));
		}

	}


	public function delete($id) {
		$image_data = $this->default_model->get("sliders",
		array(
			"sliders_id" => $id
		));
		unlink("uploads/".$image_data->sliders_image);

		$delete = $this->default_model->delete("sliders", //default_modelden deleteyi çağırıyoruz
			array(
				"sliders_id" => $id
			)
		);
		if($delete){

			$alert = array(
				"title" => "Başarılı!",
				"subTitle" => "Silme işlmi başarıyla gerçekleşti!",
				"type" => "success"
			);


		}else{

			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Veri silinirken bir hata oluştu!",
				"type" => "error"
			);
		}

		$this->session->set_flashdata('alert', $alert);
		redirect(base_url("sliders"));


	}


	public function statusupdate($id){//durum güncelleme
		if($id){
            $isActive = ($this->input->post("data") == "true") ? 1 : 0;
			$this->default_model->update("sliders",
				array(
					"sliders_id" => $id
				),
				array(
					"sliders_status" => $isActive
				)
			);
		}
	}


	public function ranksetter(){//sıralamayı güncelleme
		$data = $this->input->post("data");

		parse_str($data, $ranke);//düzenli okunabilir hale getir

		$value = $ranke["rank"];

		foreach($value as $rank => $id){
				$this->default_model->update("sliders",
				array(
					"sliders_id" => $id
				),
				array(
					"sliders_rank" => $rank
				));
		}
	}


}
