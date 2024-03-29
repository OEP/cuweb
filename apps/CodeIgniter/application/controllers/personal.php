<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->library('parser');
    $this->load->model("Project_model");
  }

	public function index()
	{
    $this->_render_page("Home", transform_markdown_file("index.md"));
	}

  public function projects($slug = NULL)
  {
    $this->_render_projects("projects", $slug);
  }

  public function _render_projects($category, $slug)
  {
    if($slug == NULL)
    {
      $this->_render_project_list($category);
    }
    else if(!is_string($slug))
    {
      show_404();
    }
    else
    {
      $this->_render_page_detail($category, $slug);
    }
  }

  private function _render_project_list($category)
  {
    $project_list = $this->Project_model->get_projects($category);
    $content = $this->parser->parse('item_list',
      array(
        "items" => $project_list), true);
    $this->_render_page(ucwords($category), $content);
  }

  private function _render_page_detail($category, $slug)
  {
    global $pages_directory_name;
    global $markdown_directory;
    $relative_path = "$pages_directory_name/$category/$slug";
    $full_path = "$markdown_directory/$relative_path";

    if(!is_dir($full_path))
    {
      show_404();
    }

    $this->_render_page(
      read_plain_file("$relative_path/title.md"),
      transform_markdown_file("$relative_path/content.md"));
  }

  private function _render_page($page_name, $content)
  {
		$this->parser->parse('eco-header',
      array(
        "menu-content" => transform_markdown_file("menu.md"),
        "page-name" => $page_name,
        "site-name" => "Paul M. Kilgo",));
		$this->parser->parse('eco-main',
      array("primary-content" => $content,
            "sidebar-content" => transform_markdown_file("sidebar.md")));
		$this->parser->parse('eco-footer',
      array("content" => transform_markdown_file("footer.md")));
  }
}

