<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teams extends CI_Controller {


	public function __construct()
	{
		parent:: __construct();

		$this->load->model("default_model");//model dosyasını çağırıyoruz
	}


	public function index()
	{
		$viewData = new stdClass();
		$teams = $this->default_model->get_all("teams", array(), "teams_rank ASC");

		$viewData->teams = $teams;
		$this->load->view('teams.php', $viewData);//ilk açılacak sayfa // welcome_message viewi açılsın
	}


	public function insert() {
		$name = $this->input->post("name");
		$degree = $this->input->post("degree");

		if(!$name || !$degree){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("teams"));//yönlendirme
		}else{
			if(!empty($_FILES['image']["name"])){//ismi boş mu değil mi
				//yükleme işlemleri

				//Dosyanın yüklenecek olan yolu
				$config["upload_path"] = "uploads/teams/";
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
					$config["source_image"] = "uploads/teams/".$uploaded_filename;
					//thumbnail oluştursun mu
					$config["create_thumb"] = FALSE;
					//fotoğrafın oranları korunsun mu eşit düzyde
					$config["maintain_ratio"] = FALSE;
					//resmin kalitesi
					$config["quality"] = "100%";

					$config["width"] = 360;
					$config["height"] = 360;

					$this->load->library("image_lib",$config);//çağırdığımız kütüphane çalışırken $config ayarlarını uygulayarak çalışsın
					$this->image_lib->resize();//işlemler tamamlandıktan sonra fotoğrafa uygula

					$insert = $this->default_model->insert("teams",

						array(
							"teams_name" => $name,
							"teams_degree" => $degree,
							"teams_image" => "teams/".$uploaded_filename,
							"teams_status" => 1,
							"teams_rank" => 0,
							"teams_created_at" => date("Y-m-d")
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
			redirect(base_url("teams"));
		}

	}

	public function update($id) {
		$name = $this->input->post("name");
		$degree = $this->input->post("degree");

		if(!$name || !$degree){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("teams"));//yönlendirme
		}else{
			if(!empty($_FILES['image']["name"])){//ismi boş mu değil mi

				$image_data = $this->default_model->get("teams",
				array(
					"teams_id" => $id
				));
				unlink("uploads/".$image_data->teams_image);

				//yükleme işlemleri

				//Dosyanın yüklenecek olan yolu
				$config["upload_path"] = "uploads/teams/";
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
					$config["source_image"] = "uploads/teams/".$uploaded_filename;
					//thumbnail oluştursun mu
					$config["create_thumb"] = FALSE;
					//fotoğrafın oranları korunsun mu eşit düzyde
					$config["maintain_ratio"] = FALSE;
					//resmin kalitesi
					$config["quality"] = "100%";

					$config["width"] = 360;
					$config["height"] = 360;

					$this->load->library("image_lib",$config);//çağırdığımız kütüphane çalışırken $config ayarlarını uygulayarak çalışsın
					$this->image_lib->resize();//işlemler tamamlandıktan sonra fotoğrafa uygula

					$update = $this->default_model->update("teams",
						array(
							"teams_id" => $id
						),
						array(
							"teams_name" => $name,
							"teams_degree" => $degree,
							"teams_image" => "teams/".$uploaded_filename,
							"teams_status" => 1,
							"teams_rank" => 0
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


				$update = $this->default_model->update("teams",
					array(
						"teams_id" => $id
					),
					array(
							"teams_name" => $name,
							"teams_degree" => $degree,
							"teams_status" => 1,
							"teams_rank" => 0
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
			redirect(base_url("teams"));
		}

	}


	public function delete($id) {
		$image_data = $this->default_model->get("teams",
		array(
			"teams_id" => $id
		));
		unlink("uploads/".$image_data->teams_image);

		$delete = $this->default_model->delete("teams", //default_modelden deleteyi çağırıyoruz
			array(
				"teams_id" => $id
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
		redirect(base_url("teams"));


	}


	public function statusupdate($id){//durum güncelleme
		if($id){
            $isActive = ($this->input->post("data") == "true") ? 1 : 0;
			$this->default_model->update("teams",
				array(
					"teams_id" => $id
				),
				array(
					"teams_status" => $isActive
				)
			);
		}
	}


	public function ranksetter(){//sıralamayı güncelleme
		$data = $this->input->post("data");

		parse_str($data, $ranke);//düzenli okunabilir hale getir

		$value = $ranke["rank"];

		foreach($value as $rank => $id){
				$this->default_model->update("teams",
				array(
					"teams_id" => $id
				),
				array(
					"teams_rank" => $rank
				));
		}
	}


}
