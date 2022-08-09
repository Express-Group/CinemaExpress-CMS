<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Star_manager extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('upload');
		$this->load->model('admin/star_manager_model');
	}
	
	public function index(){
		$data['Menu_id'] = get_menu_details_by_menu_name("Stars");
		if(defined("USERACCESS_VIEW".$data['Menu_id']) && constant("USERACCESS_VIEW".$data['Menu_id']) == 1){
			$search = "";
			$suffix ="";
			if($this->input->get('star_status')!=''){
				$search .=" AND s.status='".$this->input->get('star_status')."'";
				$suffix .="&star_status=".$this->input->get('star_status');
			}
			if($this->input->get('lang')!=''){
				$search .=" AND l.slid='".$this->input->get('lang')."'";
				$suffix .="&lang=".$this->input->get('lang');
			}
			if(trim($this->input->get('search_text'))!=''){
				$search .=" AND s.name LIKE '%".trim($this->input->get('search_text'))."%'";
				$suffix .="&search_text=".trim($this->input->get('search_text'));
			}
			$row = ($this->input->get('per_page')!='') ? $this->input->get('per_page') : 0;
			$totalRows = $this->star_manager_model->getTotalRows($search);
			$config['base_url'] = base_url(folder_name).'/star_manager';
			$config['total_rows'] = $totalRows;
			$config['per_page'] = 20;
			$config['num_links'] = 5;
			$config['page_query_string'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['suffix'] = $suffix;
			$this->pagination->initialize($config);
			$data['title'] = "Star Manager";
			$data['template'] = 'star_manager';
			$data['languages'] = $this->star_manager_model->getLanguages();
			$data['links'] = $this->pagination->create_links();
			$data['records'] = $this->star_manager_model->getData($search , $row , $config['per_page']);
			$data['controller'] = $this;
			$this->load->view('admin_template',$data);
		}else{
			redirect(folder_name.'/common/access_permission/star_manager');
		}	
	}
	
	public function add(){
		$this->form_validation->set_rules('star_name', 'Star Name', 'required');
		$this->form_validation->set_rules('star_bio', 'Star Biography', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('star_image', 'Star Image', 'required | callback_image_size_check');
		$this->form_validation->set_message('image_size_check', 'Only jpg, jpeg and png types are allowed');
		$this->form_validation->set_rules('language', 'Language', 'required');
		if($this->form_validation->run() == FALSE){
			$data['Menu_id'] = get_menu_details_by_menu_name("Stars");
			if(defined("USERACCESS_ADD".$data['Menu_id']) && constant("USERACCESS_ADD".$data['Menu_id']) == 1){
				$data['title'] = "Add Star Manager";
				$data['template'] = 'addstar_manager';
				$data['type'] = 0;
				$data['languages'] = $this->star_manager_model->getLanguages();
				$this->load->view('admin_template',$data);
			}else{
				redirect(folder_name.'/common/access_permission/star_manager');
			}
		}else{
			$data['name'] = trim($this->input->post('star_name'));
			$data['bio'] = trim($this->input->post('star_bio'));
			$data['language'] = trim($this->input->post('language'));
			$data['meta_title'] = trim($this->input->post('metatitle'));
			$data['meta_description'] = trim($this->input->post('metadesc'));
			$data['meta_keyword'] = trim($this->input->post('metakeyword'));
			$data['noindex'] = ($this->input->post('noindex') == 'on') ? 1 : 0;
			$data['nofollow'] = ($this->input->post('nofollow') == 'on') ? 1 : 0;
			$data['status'] = trim($this->input->post('status'));
			$data['created_by'] = USERID;
			$data['modified_by'] = USERID;
			$data['modified_on'] = date('Y-m-d H:i:s');
			$config['upload_path'] = source_base_path.'images/stars';
			$config['allowed_types'] = '*';
			$this->upload->initialize($config);
			if($this->upload->do_upload('star_image')){
				$filename = $this->upload->data();
				$data['img_path'] = $filename['file_name'];
			}
			$result = $this->star_manager_model->insertStarDetails($data);
			($result==1) ? $this->session->set_flashdata('result', 1) : $this->session->set_flashdata('result', 0);
			redirect(folder_name.'/star_manager');
		}
		
	}
	
	public function edit($id){
		if($id=='' || !is_numeric($id)){
			redirect(folder_name.'/star_manager');
			exit;
		}
		$this->form_validation->set_rules('star_name', 'Star Name', 'required');
		$this->form_validation->set_rules('star_bio', 'Star Biography', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		if($_FILES["star_image"]["name"]!=''){
			$this->form_validation->set_rules('star_image', 'Star Image', 'required | callback_image_size_check');
			$this->form_validation->set_message('image_size_check', 'Only jpg, jpeg and png types are allowed');
		}
		$this->form_validation->set_rules('language', 'Language', 'required');
		if($this->form_validation->run() == FALSE){
			$data['Menu_id'] = get_menu_details_by_menu_name("Stars");
			if(defined("USERACCESS_EDIT".$data['Menu_id']) && constant("USERACCESS_EDIT".$data['Menu_id']) == 1){
				$data['title'] = "Edit Star Manager";
				$data['template'] = 'addstar_manager';
				$data['type'] = 1;
				$data['languages'] = $this->star_manager_model->getLanguages();
				$data['detail'] = $this->star_manager_model->getStarDetails($id);
				$this->load->view('admin_template',$data);
			}else{
				redirect(folder_name.'/common/access_permission/star_manager');
			}
		}else{
			$data['name'] = trim($this->input->post('star_name'));
			$data['bio'] = trim($this->input->post('star_bio'));
			$data['language'] = trim($this->input->post('language'));
			$data['meta_title'] = trim($this->input->post('metatitle'));
			$data['meta_description'] = trim($this->input->post('metadesc'));
			$data['meta_keyword'] = trim($this->input->post('metakeyword'));
			$data['noindex'] = ($this->input->post('noindex') == 'on') ? 1 : 0;
			$data['nofollow'] = ($this->input->post('nofollow') == 'on') ? 1 : 0;
			$data['status'] = trim($this->input->post('status'));
			$data['modified_by'] = USERID;
			$data['modified_on'] = date('Y-m-d H:i:s');
			if($_FILES["star_image"]["name"]!=''){
				$config['upload_path'] = source_base_path.'images/stars';
				$config['allowed_types'] = '*';
				$this->upload->initialize($config);
				if($this->upload->do_upload('star_image')){
					$filename = $this->upload->data();
					$data['img_path'] = $filename['file_name'];
				}
			}else{
				$oldImage = trim($this->input->post('star_image_value'));
				if($oldImage==''){
					$data['img_path'] = '';
					unlink(source_base_path.'images/stars/'.$oldImage);
				}
			}
			$result = $this->star_manager_model->updateStarDetails($data , $id);
			($result==1) ? $this->session->set_flashdata('result', 2) : $this->session->set_flashdata('result', 0);
			redirect(folder_name.'/star_manager');
			
		}
		
	}
	
	public function star_list($id){
		if($id=='' || !is_numeric($id)){
			redirect(folder_name.'/star_manager');
			exit;
		}
		$data['Menu_id'] = get_menu_details_by_menu_name("Stars");
		if(defined("USERACCESS_EDIT".$data['Menu_id']) && constant("USERACCESS_EDIT".$data['Menu_id']) == 1){
		$starDetails = $this->star_manager_model->getStarDetails($id);
		$data['title'] = $starDetails['name'];
		$data['template'] = 'addstar_qanda';
		$data['controller'] = $this;
		$data['records'] = $this->star_manager_model->getStarAttributes($id);
		$this->load->view('admin_template', $data);
		}else{
			redirect(folder_name.'/common/access_permission/star_manager');
		}
	}
	
	public function image_size_check($img){
		$allowed_ext = array('jpg', 'jpeg', 'png');
		$img_ext = pathinfo($_FILES["star_image"]["name"], PATHINFO_EXTENSION);
		if(!in_array($img_ext, $allowed_ext)){
			return false;
		}
	}
	
	public function getUsername($id){
		$result = $this->db->select('Username')->from('usermaster')->where('User_id' , $id)->get()->row_array();
		return $result['Username'];
	}
	
	public function addAttributes(){
		$data['star_id'] = $this->input->post('star_id');
		$data['question'] = $this->input->post('question');
		$data['answer'] = $this->input->post('answer');
		$data['status'] = trim($this->input->post('status'));
		$data['created_by'] = USERID;
		$data['modified_by'] = USERID;
		$data['modified_on'] = date('Y-m-d H:i:s');
		$result = $this->star_manager_model->insertAttributes($data);
		($result==1) ? $this->session->set_flashdata('result', 1) : $this->session->set_flashdata('result', 0);
		echo $result;
	}
	
	public function updateAttributes(){
		$qid = $this->input->post('qid');
		$data['question'] = $this->input->post('question');
		$data['answer'] = $this->input->post('answer');
		$data['status'] = trim($this->input->post('status'));
		$data['modified_by'] = USERID;
		$data['modified_on'] = date('Y-m-d H:i:s');
		$result = $this->star_manager_model->updateAttributes($data , $qid);
		($result==1) ? $this->session->set_flashdata('result', 2) : $this->session->set_flashdata('result', 0);
		echo $result;
	}
	
	public function getAttributes(){
		$id = $this->input->post('id');
		if($id=='' || !is_numeric($id)){
			redirect(folder_name.'/star_manager');
			exit;
		}
		$data = $this->star_manager_model->getAttribute($id);
		echo json_encode($data);
	}
	
	public function languages(){
		$data['Menu_id'] = get_menu_details_by_menu_name("Stars");
		if(defined("USERACCESS_VIEW".$data['Menu_id']) && constant("USERACCESS_VIEW".$data['Menu_id']) == 1){
			$data['title'] = 'Star Language';
			$data['template'] = 'starlanguage';
			$data['controller'] = $this;
			$data['records'] = $this->star_manager_model->getLanguage();
			$this->load->view('admin_template', $data);
		}
		else{
			redirect(folder_name.'/common/access_permission/star_manager');
		}
	}
	public function addLanguage(){
		$data['name'] = $this->input->post('language');
		$data['status'] = $this->input->post('status');
		$data['created_by'] = $data['modified_by'] = USERID;
		$data['modified_on'] = date('Y-m-d H:i:s');
		$result = $this->star_manager_model->insertLanguage($data);
		($result==1) ? $this->session->set_flashdata('result', 1) : $this->session->set_flashdata('result', 0);
		echo $result;
	}
	
	public function updateLanguage(){
		$data['name'] = $this->input->post('language');
		$data['status'] = $this->input->post('status');
		$data['modified_by'] = USERID;
		$data['modified_on'] = date('Y-m-d H:i:s');
		$result = $this->star_manager_model->updateLanguageData($data , $this->input->post('id'));
		($result==1) ? $this->session->set_flashdata('result', 2) : $this->session->set_flashdata('result', 0);
		echo $result;
	}
}