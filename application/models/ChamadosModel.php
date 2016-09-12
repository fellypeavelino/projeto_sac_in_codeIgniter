<?

class ChamadosModel extends CI_Model{

	public function percist($data){
		$this->db->insert("chamados",$data);
	}

	public function GetAll($sort = 'ch.id', $order = 'asc', $limit = null, $offset = null, $email = null) {
	    $this->db->order_by($sort, $order);

	    if($limit)
	      $this->db->limit(5,$offset);
	  	if($email == null or $email == ""){
		    $query = $this->db->from("chamados ch")
		    				  ->join("clientes c","c.id = ch.clientes_id")
		    				  ->join("pedidos p","p.id = ch.pedidos_id")
		    				  ->get()
		    ;	  		
	  	}else{
		    $query = $this->db->from("chamados ch")
		    				  ->join("clientes c","c.id = ch.clientes_id")
		    				  ->join("pedidos p","p.id = ch.pedidos_id")
		    				  ->where("c.email like '%".$email."%'")
		    				  ->get()
		    ;		  		
	  	}

	    if ($query->num_rows() > 0) {
	      return $query->result();
	    } else {
	      return null;
	    }

	}

  	public function CountAll(){
    	return $this->db->count_all("chamados");
  	}


  	public function listAll(){
  		return 	$this->db->from("chamados ch")
	    				 ->join("clientes c","c.id = ch.clientes_id")
	    				 ->join("pedidos p","p.id = ch.pedidos_id")
	    				 ->get()->result();
  	}
}