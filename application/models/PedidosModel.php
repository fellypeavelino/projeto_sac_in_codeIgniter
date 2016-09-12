<?

class PedidosModel extends CI_Model{


	public function getByNumber($numero){
		return $this->db->select("id")
						->where("numero",$numero)
						->get("pedidos")->result();
	}

}