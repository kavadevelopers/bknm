<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Head_edit extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('dashboard_model');
        $this->load->model('setting_model');
        $this->load->model('user_model');
        $this->load->model('general_model');
        $this->load->model('setting_model');

    }


    public function edit_squad(){
    	$data['_title']		= "Edit Squad";
		$data['squad']		= $this->setting_model->head_df_id('2')[0];
		$this->load->template('edit_head/edit_squad',$data);
    }

    public function update_squad()
	{
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

		
		$this->form_validation->set_rules('file_limit', 'File Limit', 'trim|required|max_length[4]|numeric');
		$this->form_validation->set_rules('min_km', 'Minimum KM', 'trim|required|max_length[10]|numeric');
		$this->form_validation->set_rules('min_km_rate', 'Minimum KM Rate', 'trim|required|max_length[10]|numeric');
		$this->form_validation->set_rules('petrol_per_km', 'Petrol Per KM', 'trim|required|max_length[10]|numeric');
		$this->form_validation->set_rules('diesel_per_km', 'Diesel Per KM', 'trim|required|max_length[10]|numeric');
		$this->form_validation->set_rules('per_session', 'Per Session', 'trim|required|max_length[10]|numeric');
		$this->form_validation->set_rules('petrol_cng_per_km', 'Petro/CNG per Km', 'trim|required|max_length[10]|numeric');
		$this->form_validation->set_rules('petrol_lpg_per_km', 'Petro/LPG per Km', 'trim|required|max_length[10]|numeric');
		$this->form_validation->set_rules('gas_per_km', 'GAS per Km', 'trim|required|max_length[10]|numeric');
		
		$this->form_validation->set_rules('id', 'id', 'trim');

		if($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Edit Squad";
			$data['squad']		= $this->setting_model->head_df_id('2')[0];
			$this->load->template('edit_head/edit_squad',$data);
		}
		else
		{

			$year = array(
		        
		        'file_limit'          => 	$this->input->post('file_limit'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
		        
			);

			$this->db->where('id',$this->input->post('id'));
			if($this->db->update('head', $year)){

				$this->db->where('index','min_km');
				$this->db->where('head','squad');
				$this->db->update('head_values', ['value' => $this->input->post('min_km')]);

				$this->db->where('index','min_km_rate');
				$this->db->where('head','squad');
				$this->db->update('head_values', ['value' => $this->input->post('min_km_rate')]);

				$this->db->where('index','petrol_per_km');
				$this->db->where('head','squad');
				$this->db->update('head_values', ['value' => $this->input->post('petrol_per_km')]);

				$this->db->where('index','diesel_per_km');
				$this->db->where('head','squad');
				$this->db->update('head_values', ['value' => $this->input->post('diesel_per_km')]);

				$this->db->where('index','per_session');
				$this->db->where('head','squad');
				$this->db->update('head_values', ['value' => $this->input->post('per_session')]);

				$this->db->where('index','petrol_cng_per_km');
				$this->db->where('head','squad');
				$this->db->update('head_values', ['value' => $this->input->post('petrol_cng_per_km')]);

				$this->db->where('index','petrol_lpg_per_km');
				$this->db->where('head','squad');
				$this->db->update('head_values', ['value' => $this->input->post('petrol_lpg_per_km')]);

				$this->db->where('index','gas_per_km');
				$this->db->where('head','squad');
				$this->db->update('head_values', ['value' => $this->input->post('gas_per_km')]);

				$this->session->set_flashdata('msg', 'Squad Head Successfully Saved');
	        	redirect(base_url().'setting/head');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Save Head Please Try Again');
	        	redirect(base_url().'head_edit/edit_squad');

			}

		}
	}

}
?>