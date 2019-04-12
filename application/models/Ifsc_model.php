<?php
class Ifsc_model extends CI_Model
{
	
	public $table = "ifsc_detail";  
	public $select_column = array("id","ifsc", "branch", "bank","city","state","created_by","created_at");  
	public $order_column = array("ifsc", "branch", "bank","city","state","created_by","created_at");

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function ifsc_all()
	{
		return $this->db->order_by('id', 'DESC')->get("ifsc_detail")->result_array();
	}


	public function ifsc_id($id)
	{
		return $this->db->get_where("ifsc_detail",['id' => $id])->result_array();
	}

	
	public function make_query()  
	{  
		$this->db->select($this->select_column);  
		$this->db->from($this->table);  
		if(isset($_POST["search"]["value"]))  
		{  
		    $this->db->like("ifsc", $_POST["search"]["value"]);  
		    $this->db->or_like("branch", $_POST["search"]["value"]);  
		    $this->db->or_like("city", $_POST["search"]["value"]);  
		    $this->db->or_like("bank", $_POST["search"]["value"]);  
		    $this->db->or_like("state", $_POST["search"]["value"]);  
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



    public function ifsc_autocom($val)
    {
    	$this->db->like('ifsc', $val);
    	$this->db->or_like('branch', $val);
        $this->db->order_by('id', 'ASC');
        $this->db->limit(10);
   	    return $this->db->get('ifsc_detail')->result();
    }







}
?>