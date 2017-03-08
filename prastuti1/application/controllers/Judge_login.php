<?php
class Judge_login extends CI_Controller {

        public function index()
        {
              $this->load->model('judge_loginn');
              $this->judge_loginn->judge_event();
        }
        public function complete()
        {
        	$this->load->model('judge_loginn');
            $this->judge_loginn->judgement();
        }
        public function fill()
        {
            $this->load->model('judge_loginn');
            $this->judge_loginn->fill();
        }
        public function logout()
        {
		$this->session->unset_userdata('Hash1');
		$this->session->unset_userdata('Hash3');
		$this->session->unset_userdata('loggedin');
        }
}
