<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->library('parser');
  }

	public function index()
	{
    $this->_render_page("Home", "Hello.");
	}

  private function _render_page($page_name, $content)
  {
		$this->parser->parse('eco-header',
      array(
        "page_name" => $page_name,
        "site_name" => "Paul M. Kilgo",));
		$this->parser->parse('eco-content',
      array("content" => $content));
		$this->load->view('eco-sidebar');
		$this->load->view('eco-footer');
  }
}

