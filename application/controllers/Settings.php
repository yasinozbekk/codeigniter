<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {


	//aşağıda index vb. yazılan tüm metotların içine default metotu yüklesin demek
	public function __construct()
	{
		parent:: __construct();

		$this->load->model("default_model");//model dosyasını çağırıyoruz
	}


	public function index()
	{
		
		//verileri objeye çeviriyor array
		$viewData = new stdClass();

		$settings = $this->default_model->get("settings", array("id" => 1)); //model içinde default_model içinde geti bul settings tablosunda idsi 1 olanı getir

		$socialmedia = $this->default_model->get_all("socialmedia", array(), "socialmedia_rank ASC");//bütün social media tablosunu çek. Şart yoksa(WHERE) arrayı boş gönderiyoruz

		$viewData->settings = $settings; //settings.php ye settings adında gönder 
		$viewData->socialmedia = $socialmedia;

		$viewData->url="settings";//sayfada $url diye çekilebilir

		$this->load->view('settings.php', $viewData);//ilk açılacak sayfa // welcome_message viewi açılsın
		//viewData ile settings dosyasına veri gönder
	}


	public function updateSettings($id) {//ayar güncelleme controlleri
		//$_POST["title"] == $this->input->post("title"); //saf php == codeigniter
		$title = $this->input->post("title");
		$description = $this->input->post("description");
		$keywords = $this->input->post("keywords");
		$author = $this->input->post("author");
		$footer = $this->input->post("footer");

		if(!$title || !$description || !$keywords || !$author || !$footer){


			$alert = array(
				"title" => "Dikkat Et!",
				"subTitle" => "Lütfen boş alan bırakmayınız!",
				"type" => "warning"
			);
			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));//yönlendirme


		}else{

			$update = $this->default_model->update("settings", 
				array(
					"id" => $id
					), 
				array(
					"title" => $title,
					"description" => $description,
					"keywords" => $keywords,
					"author" => $author,
					"footer" => $footer
				)
			); //güncellenecek veriler
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

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));



		}
	}

	public function updateContactSettings($id){
		$phone = $this->input->post("phone");
		$mail = $this->input->post("mail");
		$address = $this->input->post("address");
		$map = $this->input->post("map");
		if(!$phone || !$mail || !$address || !$map){

			$alert = array(
				"title" => "Dikkat Et!",
				"subTitle" => "Lütfen boş alan bırakmayınız!",
				"type" => "warning"
			);
			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));//yönlendirme
		}else{

			$update = $this->default_model->update("settings", 
				array(
					"id" => $id
					), 
				array(
					"phone" => $phone,
					"mail" => $mail,
					"address" => $address,
					"map" => $map
				)
			); //güncellenecek veriler
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

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));



		}
	}

	public function updateSmtpSettings($id){
		$host = $this->input->post("host");
		$user_mail = $this->input->post("user_mail");
		$user_password = $this->input->post("user_password");
		$port = $this->input->post("port");
		$notification_mail = $this->input->post("notification_mail");

		echo $host." ------- ";
		echo $user_mail." ------- ";
		echo $user_password." ------- ";
		echo $port." ------- ";
		echo $notification_mail." ------- ";

		if(!$host || !$user_mail || !$user_password || !$port || !$notification_mail){

			$alert = array(
				"title" => "Dikkat Et!",
				"subTitle" => "Lütfen boş alan bırakmayınız!",
				"type" => "warning"
			);
			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));//yönlendirme
		}else{

			$update = $this->default_model->update("settings", 
				array(
					"id" => $id
					), 
				array(
					"host" => $host,
					"user_mail" => $user_mail,
					"user_password" => $user_password,
					"port" => $port,
					"notification_mail" => $notification_mail

				)
			); //güncellenecek veriler
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

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));



		}
	}



	//resim güncelleme
	public function updateLogoSettings($id){

		if(!empty($_FILES['logo']["name"])){//ismi boş mu değil mi

			$logo_data = $this->default_model->get("settings",
			array(
				"id" => $id
			));
			unlink("uploads/".$logo_data->logo);
			//die();

			//yükleme işlemleri

			//Dosyanın yüklenecek olan yolu
			$config["upload_path"] = "uploads/logofavicon/";
			//İzinli uzantılar
			$config["allowed_types"] = "gif|jpg|png|jpeg|svg";
			$config["file_name"] = uniqid();
			//upload kütüphanesini yükler
			$this->load->library("upload",$config);//configde autoloadda yapmama sebebimiz sadece burada kullanılacak heryerde kullanılmayacağı için

			//resim yükleme işlemi yapar
			$upload = $this->upload->do_upload("logo");

			if($upload){
				//yüklenen dosyanın adını alıyoruz
				$uploaded_filename = $this->upload->data("file_name");

				//yeni kütüphanenin ayarları
				$config["image_library"] = "gd2";
				//bu fotoğrafın ayarlarıyla oynacak
				$config["source_image"] = "uploads/logofavicon/".$uploaded_filename;
				//thumbnail oluştursun mu
				$config["create_thumb"] = FALSE;
				//fotoğrafın oranları korunsun mu eşit düzyde
				$config["maintain_ratio"] = FALSE;
				//resmin kalitesi
				$config["quality"] = "100%";

				$this->load->library("image_lib",$config);//çağırdığımız kütüphane çalışırken $config ayarlarını uygulayarak çalışsın
				$this->image_lib->resize();//işlemler tamamlandıktan sonra fotoğrafa uygula

				$update = $this->default_model->update("settings",
					array(
						"id" => $id
					),
					array(
						"logo" => "logofavicon/".$uploaded_filename
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

			$alert = array(
				"title" => "Dikkat!",
				"subTitle" => "Fotoğraf alanı boş bırakılamaz!",
				"type" => "warning"
			);
		}


		$this->session->set_flashdata('alert', $alert);
		redirect(base_url("settings"));
	}

	public function updateFaviconSettings($id){

		if(!empty($_FILES['favicon']["name"])){//ismi boş mu değil mi

			$logo_data = $this->default_model->get("settings",
			array(
				"id" => $id
			));
			unlink("uploads/".$logo_data->favicon);
			//die();

			//yükleme işlemleri

			//Dosyanın yüklenecek olan yolu
			$config["upload_path"] = "uploads/logofavicon/";
			//İzinli uzantılar
			$config["allowed_types"] = "gif|jpg|png|jpeg|svg";
			$config["file_name"] = uniqid();
			//upload kütüphanesini yükler
			$this->load->library("upload",$config);//configde autoloadda yapmama sebebimiz sadece burada kullanılacak heryerde kullanılmayacağı için

			//resim yükleme işlemi yapar
			$upload = $this->upload->do_upload("favicon");

			if($upload){
				//yüklenen dosyanın adını alıyoruz
				$uploaded_filename = $this->upload->data("file_name");

				//yeni kütüphanenin ayarları
				$config["image_library"] = "gd2";
				//bu fotoğrafın ayarlarıyla oynacak
				$config["source_image"] = "uploads/logofavicon/".$uploaded_filename;
				//thumbnail oluştursun mu
				$config["create_thumb"] = FALSE;
				//fotoğrafın oranları korunsun mu eşit düzyde
				$config["maintain_ratio"] = TRUE;
				$config["width"] = 100;
				$config["height"] = 100;
				$
				//resmin kalitesi
				$config["quality"] = "100%";

				$this->load->library("image_lib",$config);//çağırdığımız kütüphane çalışırken $config ayarlarını uygulayarak çalışsın
				$this->image_lib->resize();//işlemler tamamlandıktan sonra fotoğrafa uygula

				$update = $this->default_model->update("settings",
					array(
						"id" => $id
					),
					array(
						"favicon" => "logofavicon/".$uploaded_filename
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

			$alert = array(
				"title" => "Dikkat!",
				"subTitle" => "Fotoğraf alanı boş bırakılamaz!",
				"type" => "warning"
			);
		}


		$this->session->set_flashdata('alert', $alert);
		redirect(base_url("settings"));
	}





}
