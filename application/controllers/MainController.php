<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController  extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(["ClientesModel","ChamadosModel","PedidosModel"]);
		$this->load->helper(["html","form","url"]);
		$this->load->library(["form_validation",'pagination']);
	}

	public function index(){

		if($this->input->post()){
			$this->form_validation->set_rules('email', 'Email','required|valid_email|is_unique[clientes.email]');
			if($this->form_validation->run() == false){
				echo validation_errors();
			}else{
				$data = $this->input->post();
				$data["clientes_id"] = $this->ClientesModel->percist(
					['nome' => $data['nome'],'email' => $data['email']]
				);
				$data["pedidos_id"] = $this->PedidosModel->getByNumber($data['numero'])[0]->id;
				//print_r($data["pedidos_id"]);
				$this->ChamadosModel->percist(
					[
						'titulo' => $data['titulo'],'observacao' => $data['observacao'],
						"pedidos_id" => $data["pedidos_id"],'clientes_id' => $data['clientes_id']
					]
				);
				redirect("/MainController/list");
			}
		}
		$this->load->view("add");
	}

	public function list(){
		$config = array(
			"base_url" => base_url('chamados/p'),
			"per_page" => 10,
			"num_links" => 3,
			"uri_segment" => 3,
			"total_rows" => $this->ChamadosModel->CountAll(),
			"full_tag_open" => "<ul class='pagination'>",
			"full_tag_close" => "</ul>",
			"first_link" => FALSE,
			"last_link" => FALSE,
			"first_tag_open" => "<li>",
			"first_tag_close" => "</li>",
			"prev_link" => "Anterior",
			"prev_tag_open" => "<li class='prev'>",
			"prev_tag_close" => "</li>",
			"next_link" => "Próxima",
			"next_tag_open" => "<li class='next'>",
			"next_tag_close" => "</li>",
			"last_tag_open" => "<li>",
			"last_tag_close" => "</li>",
			"cur_tag_open" => "<li class='active'><a href='#'>",
			"cur_tag_close" => "</a></li>",
			"num_tag_open" => "<li>",
			"num_tag_close" => "</li>"
		);

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();

		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['chamados'] = $this->ChamadosModel->GetAll('ch.id','desc',$config['per_page'],$offset,$this->input->get("email"));
		$data['listChamados'] = $this->ChamadosModel->listAll();
		$this->load->view('list',$data);
	}

	public function validEmail(){
		$email = $this->input->get("email");
		$cliente = $this->ClientesModel->validEmail($email);
		if(count($cliente) > 0){
			echo json_encode(["success"=>true]);
		}else{
			echo json_encode(["success"=>false]);
		}
	}

	public function validNumero(){
		$numero = $this->input->get("numero");
		$pedido = $this->PedidosModel->getByNumber($numero);
		if(count($pedido) > 0){
			echo json_encode(["success"=>true]);
		}else{
			echo json_encode(["success"=>false]);
		}
	}

}