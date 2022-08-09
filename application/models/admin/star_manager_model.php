<?php
	class star_manager_model extends CI_Model{
		
		public function __construct(){
			parent::__construct();
			$CI = &get_instance();
			$this->live_db = $CI->load->database('live_db' , true);
		}
		
		public function insertStarDetails($data){
			return $this->live_db->insert('star_master', $data);
		}
		
		public function insertAttributes($data){
			return $this->live_db->insert('star_master_attributes', $data);
		}
		
		public function updateStarDetails($data , $id){
			$this->live_db->where('star_id' , $id);
			return $this->live_db->update('star_master', $data);
		}
		
		public function updateAttributes($data , $qid){
			$this->live_db->where('qid' , $qid);
			return $this->live_db->update('star_master_attributes', $data);
		}
		
		public function getLanguages(){
			return $this->live_db->select('slid , name')->from('star_language_master')->where('status',1)->get()->result_array();
		}
		
		public function getTotalRows($search){
			return $this->live_db->query("SELECT s.star_id FROM star_master AS s INNER JOIN star_language_master AS l ON s.language = l.slid WHERE s.star_id!='' ".$search."")->num_rows();
		}
		
		public function getData($search ,$row ,  $per_page){
			return $this->live_db->query("SELECT s.star_id ,s.name ,s.img_path ,s.status , DATE_FORMAT(s.modified_on , '%D %M %Y %h:%i:%s %p') AS modified_on  ,s.modified_by ,l.name AS lang_name FROM star_master AS s INNER JOIN star_language_master AS l ON s.language = l.slid WHERE s.star_id!='' ".$search." ORDER BY s.star_id DESC LIMIT ".$row." , ".$per_page."")->result();
		}
		
		public function getStarDetails($id){
			return $this->live_db->select('*')->from('star_master')->where('star_id' ,$id)->get()->row_array();
		}
		
		public function getStarAttributes($id){
			return $this->live_db->select('*')->from('star_master_attributes')->where('star_id' ,$id)->get()->result_array();
		}
		
		public function getAttribute($id){
			return $this->live_db->select('*')->from('star_master_attributes')->where('qid' ,$id)->get()->row_array();
		}
		
		public function getLanguage(){
			return $this->live_db->select('*')->from('star_language_master')->get()->result_array();
		}
		
		public function insertLanguage($data){
			return $this->live_db->insert('star_language_master', $data);
		}
		
		public function updateLanguageData($data , $id){
			$this->live_db->where('slid', $id);
			return $this->live_db->update('star_language_master', $data);
		}
		
	}
?>