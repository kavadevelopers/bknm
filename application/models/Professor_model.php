<?php
class Professor_model extends CI_Model
{
	
	public $table = "professor";  
	public $select_column = array("id","acc_code", "acno", "name","ifsc","contact","created_by","created_at");  
	public $order_column = array("acc_code", "acno", "name","ifsc","contact","created_by","created_at");

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function professor_all()
	{
		return $this->db->order_by('id', 'DESC')->get_where("professor",['delete_flag' => '0'])->result_array();
	}

	public function professor_df_id($id)
	{
		return $this->db->get_where("professor",['id' => $id])->result_array();
	}


	public function make_query()  
	{  
		$this->db->select($this->select_column);  
		$this->db->from($this->table);  
		if(isset($_POST["search"]["value"]))  
		{  
		    $this->db->like("acc_code", $_POST["search"]["value"]);  
		    $this->db->or_like("acno", $_POST["search"]["value"]);  
		    $this->db->or_like("name", $_POST["search"]["value"]);  
		    $this->db->or_like("ifsc", $_POST["search"]["value"]);  
		    $this->db->or_like("contact", $_POST["search"]["value"]); 
		}  
		if(isset($_POST["order"]))  
		{  
		    $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
		}  
		else  
		{  
		    $this->db->order_by('id', 'DESC');  
		}  
	} 

	public function make_datatables(){  
		$this->make_query();  
		if($_POST["length"] != -1)  
		{  
		    $this->db->limit($_POST['length'], $_POST['start']);  
		}  
		$query = $this->db->get();  
		return $query->result();  
    }  


    public function get_filtered_data(){  
        $this->make_query();  
        $query = $this->db->get();  
        return $query->num_rows();  
    }    

    public function get_all_data()  
    {  
        $this->db->select("*");  
        $this->db->from($this->table);  
        return $this->db->count_all_results();  
    }


}
?>