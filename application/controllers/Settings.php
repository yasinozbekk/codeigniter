<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model("default_model");
	}
	public function index()
	{
		$viewData = new stdClass();
		$viewData->url="settings";

		$products = $this->default_model->get_all("products", array(), "products_id DESC");
		$viewData->products = $products;

		$materials = $this->default_model->get_all("materials", array(), "materials_id DESC");
		$viewData->materials = $materials;

		$materialsselect = $this->default_model->get_all("materials", array("materials_id"=>@$id), "");
		$viewData->materialsselect = $materialsselect;

		$this->load->view('settings.php', $viewData);
	}
	public function deneme($id) {
		$viewData = new stdClass();
		$products = $this->default_model->get_all("products", array(), "products_id DESC");
		$viewData->products = $products;
		$result = $this->default_model->join(array(
			"table" => "product_to_product",
			"condition" => "products.products_id = product_to_product.products_id",
			"from" => "products",
			"column" => "products.products_id",
			"value" => $id
		),
			"product_to_product.products_child_id",
		);

		$resultview =array();
		foreach ($result as $results) {
			$resultprint = $this->default_model->join(array(
				"table" => "product_to_product",
				"condition" => "products.products_id = product_to_product.products_child_id",
				"from" => "products",
				"column" => "products.products_id",
				"value" => $results->products_child_id
			),
				"products.products_id,products.products_name",
			);
			array_push($resultview,$resultprint[0]);
		}
		/*-----------------------------------------Materials-----------------------------------------*/
		$result = $this->default_model->join(array(
			"table" => "product_to_material",
			"condition" => "products.products_id = product_to_material.products_id",
			"from" => "products",
			"column" => "products.products_id",
			"value" => $id
		),
			"product_to_material.materials_id",
		);

		foreach ($result as $results) {
			$resultprint = $this->default_model->join(array(
				"table" => "product_to_material",
				"condition" => "materials.materials_id = product_to_material.materials_id",
				"from" => "materials",
				"column" => "materials.materials_id",
				"value" => $results->materials_id
			),
				"materials.materials_id,materials.materials_name",
			);
			array_push($resultview,$resultprint[0]);
		}

		echo json_encode($resultview);
		/*----------------------------------------- Materials -----------------------------------------*/
	}

	public function insertproduct() {
		$productName = $this->input->post("productName");
		$productParentId = $this->input->post("productParentId");
		$materialsId = $this->input->post("materialsId");
		if(!$productName || !$productParentId<0){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);
			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));
		}else{
			$insert = $this->default_model->insert("products",
				array(
					"products_name" => $productName
				));
			$insertId = $this->db->insert_id();
			if($productParentId){
				foreach ($productParentId as $row) {
					$insert = $this->default_model->insert("product_to_product",
						array(
							"products_id" => $insertId,
							"products_child_id" => $row
						));
				}
			}
			if($materialsId){
				foreach ($materialsId as $row) {
					$insert = $this->default_model->insert("product_to_material",
						array(
							"products_id" => $insertId,
							"materials_id" => $row
						));
				}
			}
			if($insert){
				$alert = array("title" => "Başarılı!","subTitle" => "Veriler başarıyla eklendi!","type" => "success");
			}else{
				$alert = array("title" => "Hata!","subTitle" => "Eklenirken bir hata oluştu!","type" => "error");
			}
			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));
		}

	}



	public function insertmaterials() {
		$materialName = $this->input->post("materialName");

		if(!$materialName){
			$alert = array(
				"title" => "Hata!",
				"subTitle" => "Boş alanları doldurunuz!",
				"type" => "warning"
			);

			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));
		}else{
			
			$insert = $this->default_model->insert("materials",
				array(
					"materials_name" => $materialName
				));
			if($insert){
				$alert = array("title" => "Başarılı!","subTitle" => "Veriler başarıyla eklendi!","type" => "success");
			}else{
				$alert = array("title" => "Hata!","subTitle" => "Eklenirken bir hata oluştu!","type" => "error");
			}
			$this->session->set_flashdata('alert', $alert);
			redirect(base_url("settings"));
		}

	}

	public function deleteproduct($id) {
		$delete = $this->default_model->delete("products", 
			array(
				"products_id" => $id
			)
		);

		$deletematerial = $this->default_model->delete("product_to_material", 
			array(
				"products_id" => $id
			)
		);
		$deletesubproduct = $this->default_model->delete("product_to_product", 
			array(
				"products_id" => $id
			)
		);

		if($delete && $deletematerial && $deletesubproduct){
			$alert = array("title" => "Başarılı!","subTitle" => "Silme işlemi başarıyla gerçekleşti!","type" => "success");
		}else{
			$alert = array("title" => "Hata!","subTitle" => "Veri silinirken bir hata oluştu!","type" => "error");
		}
		$this->session->set_flashdata('alert', $alert);
		redirect(base_url("settings"));
	}

	public function deletematerial($id) {
		$delete = $this->default_model->delete("materials",
			array(
				"materials_id" => $id
			)
		);

		$deletematerial = $this->default_model->delete("product_to_material", 
			array(
				"materials_id" => $id
			)
		);

		if($delete && $deletematerial){
			$alert = array("title" => "Başarılı!","subTitle" => "Silme işlemi başarıyla gerçekleşti!","type" => "success");
		}else{
			$alert = array("title" => "Hata!","subTitle" => "Veri silinirken bir hata oluştu!","type" => "error");
		}
		$this->session->set_flashdata('alert', $alert);
		redirect(base_url("settings"));
	}



}
