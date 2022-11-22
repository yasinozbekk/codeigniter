<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {


	public function __construct()
	{
		parent:: __construct();

		$this->load->model("default_model");//model dosyasını çağırıyoruz
	}


	public function index()
	{
		$viewData = new stdClass();
		$projects = $this->default_model->get_all("projects", array(), "projects_rank ASC");

		$viewData->projects = $projects;
		$this->load->view('projects.php', $viewData);//ilk açılacak sayfa // welcome_message viewi açılsın
	}


	public function insert() {
		$title = $this->input->post("title");
		$content = $this->input->post("content");
		$link = $this->input->post("link");

		if(!$title || !$content || !$link){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("projects"));//yönlendirme
		}else{
			if(!empty($_FILES['image']["name"])){//ismi boş mu değil mi
				//yükleme işlemleri

				//Dosyanın yüklenecek olan yolu
				$config["upload_path"] = "uploads/projects/";
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
					$config["source_image"] = "uploads/projects/".$uploaded_filename;
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

					$insert = $this->default_model->insert("projects",
						array(
							"projects_title" => $title,
							"projects_content" => $content,
							"projects_image" => "projects/".$uploaded_filename,
							"projects_link" => $link,
							"projects_status" => 1,
							"projects_rank" => 0,
							"projects_created_at" => date("Y-m-d")
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
			redirect(base_url("projects"));
		}

	}

	public function update($id) {
		$title = $this->input->post("title");
		$content = $this->input->post("content");
		$link = $this->input->post("link");

		if(!$title || !$content || !$link){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("projects"));//yönlendirme
		}else{
			if(!empty($_FILES['image']["name"])){//ismi boş mu değil mi

				$image_data = $this->default_model->get("projects",
				array(
					"projects_id" => $id
				));
				unlink("uploads/".$image_data->projects_image);

				//yükleme işlemleri

				//Dosyanın yüklenecek olan yolu
				$config["upload_path"] = "uploads/projects/";
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
					$config["source_image"] = "uploads/projects/".$uploaded_filename;
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

					$update = $this->default_model->update("projects",
						array(
							"projects_id" => $id
						),
						array(
							"projects_title" => $title,
							"projects_content" => $content,
							"projects_image" => "projects/".$uploaded_filename,
							"projects_link" => $link,
							"projects_status" => 1,
							"projects_rank" => 0

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


				$update = $this->default_model->update("projects",
					array(
						"projects_id" => $id
					),
					array(
							"projects_title" => $title,
							"projects_content" => $content,
							"projects_link" => $link,
							"projects_status" => 1,
							"projects_rank" => 0
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
			redirect(base_url("projects"));
		}

	}


	public function delete($id) {
		$image_data = $this->default_model->get("projects",
		array(
			"projects_id" => $id
		));
		unlink("uploads/".$image_data->projects_image);

		$delete = $this->default_model->delete("projects", //default_modelden deleteyi çağırıyoruz
			array(
				"projects_id" => $id
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
		redirect(base_url("projects"));


	}


	public function statusupdate($id){//durum güncelleme
		if($id){
            $isActive = ($this->input->post("data") == "true") ? 1 : 0;
			$this->default_model->update("projects",
				array(
					"projects_id" => $id
				),
				array(
					"projects_status" => $isActive
				)
			);
		}
	}


	public function ranksetter(){//sıralamayı güncelleme
		$data = $this->input->post("data");

		parse_str($data, $ranke);//düzenli okunabilir hale getir

		$value = $ranke["rank"];

		foreach($value as $rank => $id){
				$this->default_model->update("projects",
				array(
					"projects_id" => $id
				),
				array(
					"projects_rank" => $rank
				));
		}
	}


}
