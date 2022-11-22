<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socialmedia extends CI_Controller {


	public function __construct()
	{
		parent:: __construct();

		$this->load->model("default_model");//model dosyasını çağırıyoruz
	}

	public function accountSave() {//ayar güncelleme controlleri
		//$_POST["title"] == $this->input->post("title"); //saf php == codeigniter
		$title = $this->input->post("title");
		$icon = $this->input->post("icon");
		$link = $this->input->post("link");

		if(!$title || !$icon || !$link){

			$alert = array(
				"title" => "Dikkat Et!",
				"subTitle" => "Lütfen boş alan bırakmayınız!",
				"type" => "warning"
			);
			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));//yönlendirme


		}else{

			$insert = $this->default_model->insert("socialmedia", 
				array(
					"socialmedia_title" => $title,
					"socialmedia_icon" => $icon,
					"socialmedia_link" => $link
				)
			);
			if($insert){

				$alert = array(
					"title" => "Başarılı!",
					"subTitle" => "Veriler başarıyla kaydedildi!",
					"type" => "success"
				);


			}else{

				$alert = array(
					"title" => "Hata!",
					"subTitle" => "Sosyal medya eklenirken bir hata oluştu!",
					"type" => "error"
				);
			}

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));



		}
	}


	public function accountUpdate($id) {
		$title = $this->input->post("title");
		$icon = $this->input->post("icon");
		$link = $this->input->post("link");

		if(!$title || !$icon || !$link){

			$alert = array(
				"title" => "Dikkat Et!",
				"subTitle" => "Lütfen boş alan bırakmayınız!",
				"type" => "warning"
			);
			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));//yönlendirme


		}else{

			$update = $this->default_model->update("socialmedia", 
				array(
					"socialmedia_id" => $id
				),
				array(
					"socialmedia_title" => $title,
					"socialmedia_icon" => $icon,
					"socialmedia_link" => $link
				)
			);
			if($update){

				$alert = array(
					"title" => "Başarılı!",
					"subTitle" => "Veriler başarıyla kaydedildi!",
					"type" => "success"
				);


			}else{

				$alert = array(
					"title" => "Hata!",
					"subTitle" => "Sosyal medya eklenirken bir hata oluştu!",
					"type" => "error"
				);
			}

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));



		}
	}


	public function accountDelete($id) {

		$delete = $this->default_model->delete("socialmedia", //default_modelden deleteyi çağırıyoruz
			array(
				"socialmedia_id" => $id
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
				"subTitle" => "Sosyal medya silinirken bir hata oluştu!",
				"type" => "error"
			);
		}

		$this->session->set_flashdata('alert', $alert);
		redirect(base_url("settings"));


	}


	public function isactivesetter($id){
		if($id){
            $isActive = ($this->input->post("data") == "true") ? 1 : 0;
			$this->default_model->update("socialmedia",
				array(
					"socialmedia_id" => $id
				),
				array(
					"socialmedia_status" => $isActive
				)
			);
		}
	}


	public function ranksetter(){
		$data = $this->input->post("data");

		parse_str($data, $ranke);//düzenli okunabilir hale getir

		$value = $ranke["rank"];

		foreach($value as $rank => $id){
				$this->default_model->update("socialmedia",
				array(
					"socialmedia_id" => $id
				),
				array(
					"socialmedia_rank" => $rank
				));
		}
	}


}
