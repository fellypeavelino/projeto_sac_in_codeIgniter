<?

class ClientesModel extends CI_Model {

	public function percist($data){
		$this->db->insert("clientes",$data);
		return $this->db->insert_id();
	}

	public function validEmail($email){
		return $this->db->select("id")
						->where("email",$email)
						->get("clientes")->result();		
	}

}