<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {


	public function __construct()
	{
		parent:: __construct();

		$this->load->model("default_model");//model dosyasını çağırıyoruz
	}


	public function index()
	{
		$viewData = new stdClass();
		$albums = $this->default_model->get_all("albums", array(), "albums_rank ASC");

		$viewData->albums = $albums;
		$viewData->url = "albums";
		$this->load->view('albums.php', $viewData);//ilk açılacak sayfa // welcome_message viewi açılsın
	}


	public function insert() {
		$title = $this->input->post("title");

		if(!$title){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("albums"));//yönlendirme
		}else{
			if(!empty($_FILES['image']["name"])){//ismi boş mu değil mi
				//yükleme işlemleri

				//Dosyanın yüklenecek olan yolu
				$config["upload_path"] = "uploads/albums/";
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
					$config["source_image"] = "uploads/albums/".$uploaded_filename;
					//thumbnail oluştursun mu
					$config["create_thumb"] = FALSE;
					//fotoğrafın oranları korunsun mu eşit düzyde
					$config["maintain_ratio"] = FALSE;
					//resmin kalitesi
					$config["quality"] = "100%";

					$config["width"] = 1920;
					$config["height"] = 1080;

					$this->load->library("image_lib",$config);//çağırdığımız kütüphane çalışırken $config ayarlarını uygulayarak çalışsın
					$this->image_lib->resize();//işlemler tamamlandıktan sonra fotoğrafa uygula

					$insert = $this->default_model->insert("albums",
						array(
							"albums_title" => $title,
							"albums_image" => "albums/".$uploaded_filename,
							"albums_status" => 1,
							"albums_rank" => 0,
							"albums_created_at" => date("Y-m-d")
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
			redirect(base_url("albums"));
		}

	}

	public function update($id) {
		$title = $this->input->post("title");

		if(!$title){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("albums"));//yönlendirme
		}else{
			if(!empty($_FILES['image']["name"])){//ismi boş mu değil mi

				$image_data = $this->default_model->get("albums",
				array(
					"albums_id" => $id
				));
				unlink("uploads/".$image_data->albums_image);

				//yükleme işlemleri

				//Dosyanın yüklenecek olan yolu
				$config["upload_path"] = "uploads/albums/";
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
					$config["source_image"] = "uploads/albums/".$uploaded_filename;
					//thumbnail oluştursun mu
					$config["create_thumb"] = FALSE;
					//fotoğrafın oranları korunsun mu eşit düzyde
					$config["maintain_ratio"] = FALSE;
					//resmin kalitesi
					$config["quality"] = "100%";

					$config["width"] = 1920;
					$config["height"] = 1080;

					$this->load->library("image_lib",$config);//çağırdığımız kütüphane çalışırken $config ayarlarını uygulayarak çalışsın
					$this->image_lib->resize();//işlemler tamamlandıktan sonra fotoğrafa uygula

					$update = $this->default_model->update("albums",
						array(
							"albums_id" => $id
						),
						array(
							"albums_title" => $title,
							"albums_image" => "albums/".$uploaded_filename,
							"albums_status" => 1,
							"albums_rank" => 0

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


				$update = $this->default_model->update("albums",
					array(
						"albums_id" => $id
					),
					array(
							"albums_title" => $title,
							"albums_status" => 1,
							"albums_rank" => 0
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
			redirect(base_url("albums"));
		}

	}


	public function delete($id) {
		$image_data = $this->default_model->get("albums",
		array(
			"albums_id" => $id
		));
		unlink("uploads/".$image_data->albums_image);

		$delete = $this->default_model->delete("albums", //default_modelden deleteyi çağırıyoruz
			array(
				"albums_id" => $id
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
		redirect(base_url("albums"));


	}


	public function statusupdate($id){//durum güncelleme
		if($id){
            $isActive = ($this->input->post("data") == "true") ? 1 : 0;
			$this->default_model->update("albums",
				array(
					"albums_id" => $id
				),
				array(
					"albums_status" => $isActive
				)
			);
		}
	}


	public function ranksetter(){//sıralamayı güncelleme
		$data = $this->input->post("data");

		parse_str($data, $ranke);//düzenli okunabilir hale getir

		$value = $ranke["rank"];

		foreach($value as $rank => $id){
				$this->default_model->update("albums",
				array(
					"albums_id" => $id
				),
				array(
					"albums_rank" => $rank
				));
		}
	}




	//Çoklu fotoğraf yükleme bölümü

	public function uploadpage($id)
	{
		$viewData = new stdClass();
		$viewData->url = "albums";

		$album = $this->default_model->get("albums", array("albums_id" => $id));//tek veri çekme
		$albums = $this->default_model->get_all("albumimages", array("albumimages_albumid" => $id), "albumimages_rank ASC");

		$viewData->albums = $albums;
		$viewData->album = $album;

		$this->load->view("album_images", $viewData);
	}

	public function uploadimages($id)//dropzonedan gelenleri kaydet
	{
		
		//yükleme işlemleri

		//Dosyanın yüklenecek olan yolu
		$config["upload_path"] = "uploads/album_images/";
		//İzinli uzantılar
		$config["allowed_types"] = "gif|jpg|png|jpeg|svg";
		$config["file_name"] = uniqid();
		//upload kütüphanesini yükler
		$this->load->library("upload",$config);//configde autoloadda yapmama sebebimiz sadece burada kullanılacak heryerde kullanılmayacağı için

		//resim yükleme işlemi yapar
		$upload = $this->upload->do_upload("file");//dropzoneden namesi file olarak geçiyor

		if($upload){
			//yüklenen dosyanın adını alıyoruz
			$uploaded_filename = $this->upload->data("file_name");

			//yeni kütüphanenin ayarları
			$config["image_library"] = "gd2";
			//bu fotoğrafın ayarlarıyla oynacak
			$config["source_image"] = "uploads/album_images/".$uploaded_filename;
			//thumbnail oluştursun mu
			$config["create_thumb"] = FALSE;
			//fotoğrafın oranları korunsun mu eşit düzyde
			$config["maintain_ratio"] = FALSE;
			//resmin kalitesi
			$config["quality"] = "100%";


			$this->load->library("image_lib",$config);//çağırdığımız kütüphane çalışırken $config ayarlarını uygulayarak çalışsın
			$this->image_lib->resize();//işlemler tamamlandıktan sonra fotoğrafa uygula

			$insert = $this->default_model->insert("albumimages",
				array(
					"albumimages_albumid" => $id,
					"albumimages_image" => "album_images/".$uploaded_filename,
					"albumimages_status" => 1,
					"albumimages_rank" => 0,
					"albumimages_created_at" => date("Y-m-d")
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

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("albums/uploadpage/".$id));

	}



}
