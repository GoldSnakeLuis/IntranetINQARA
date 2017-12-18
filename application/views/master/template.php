<?php
        $this->load->view('master/head_view');
	$this->load->view('master/header_view');
        $this->load->view('master/menu_view');
	$this->load->view($main_content);	        
        $this->load->view('master/footer_view');
?>