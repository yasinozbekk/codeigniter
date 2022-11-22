<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {


	public function __construct()
	{
		parent:: __construct();

		$this->load->model("default_model");//model dosyasını çağırıyoruz
	}


	public function index()
	{
		$viewData = new stdClass();
		$comments = $this->default_model->get_all("comments", array(), "comments_rank ASC");

		$viewData->comments = $comments;
		$this->load->view('comments.php', $viewData);//ilk açılacak sayfa // welcome_message viewi açılsın
	}


	public function insert() {
		$name = $this->input->post("name");
		$degree = $this->input->post("degree");
		$content = $this->input->post("content");

		if(!$name || !$degree || !$content){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("comments"));//yönlendirme
		}else{
			if(!empty($_FILES['image']["name"])){//ismi boş mu değil mi
				//yükleme işlemleri

				//Dosyanın yüklenecek olan yolu
				$config["upload_path"] = "uploads/comments/";
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
					$config["source_image"] = "uploads/comments/".$uploaded_filename;
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

					$insert = $this->default_model->insert("comments",
						array(
							"comments_name" => $name,
							"comments_degree" => $degree,
							"comments_image" => "comments/".$uploaded_filename,
							"comments_content" => $content,
							"comments_status" => 1,
							"comments_rank" => 0,
							"comments_created_at" => date("Y-m-d")
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
			redirect(base_url("comments"));
		}

	}

	public function update($id) {
		$name = $this->input->post("name");
		$degree = $this->input->post("degree");
		$content = $this->input->post("content");

		if(!$name || !$degree || !$content){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("comments"));//yönlendirme
		}else{
			if(!empty($_FILES['image']["name"])){//ismi boş mu değil mi

				$image_data = $this->default_model->get("comments",
				array(
					"comments_id" => $id
				));
				unlink("uploads/".$image_data->comments_image);

				//yükleme işlemleri

				//Dosyanın yüklenecek olan yolu
				$config["upload_path"] = "uploads/comments/";
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
					$config["source_image"] = "uploads/comments/".$uploaded_filename;
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

					$update = $this->default_model->update("comments",
						array(
							"comments_id" => $id
						),
						array(
							"comments_name" => $name,
							"comments_degree" => $degree,
							"comments_image" => "comments/".$uploaded_filename,
							"comments_content" => $content,
							"comments_status" => 1,
							"comments_rank" => 0

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


				$update = $this->default_model->update("comments",
					array(
						"comments_id" => $id
					),
					array(
							"comments_name" => $name,
							"comments_degree" => $degree,
							"comments_content" => $content,
							"comments_status" => 1,
							"comments_rank" => 0
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
			redirect(base_url("comments"));
		}

	}


	public function delete($id) {
		$image_data = $this->default_model->get("comments",
		array(
			"comments_id" => $id
		));
		unlink("uploads/".$image_data->comments_image);

		$delete = $this->default_model->delete("comments", //default_modelden deleteyi çağırıyoruz
			array(
				"comments_id" => $id
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
		redirect(base_url("comments"));


	}


	public function statusupdate($id){//durum güncelleme
		if($id){
            $isActive = ($this->input->post("data") == "true") ? 1 : 0;
			$this->default_model->update("comments",
				array(
					"comments_id" => $id
				),
				array(
					"comments_status" => $isActive
				)
			);
		}
	}


	public function ranksetter(){//sıralamayı güncelleme
		$data = $this->input->post("data");

		parse_str($data, $ranke);//düzenli okunabilir hale getir

		$value = $ranke["rank"];

		foreach($value as $rank => $id){
				$this->default_model->update("comments",
				array(
					"comments_id" => $id
				),
				array(
					"comments_rank" => $rank
				));
		}
	}


}
