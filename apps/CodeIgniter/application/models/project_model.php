<?PHP

class Project_model extends CI_Model {

  function __construct()
  {
    parent::__construct();
  }

  function get_projects($directory)
  {
    global $pages_directory;
    global $pages_directory_name;

    $projects = array();

    $category_directory = "$pages_directory/$directory";

    foreach(scandir($category_directory) as $item)
    {
      $relative_path = "$pages_directory_name/$directory/$item";
      if($item == ".." || $item == ".")
      {
        continue;
      }

      $path = "$category_directory/$item";
      if(!is_dir($path))
      {
        continue;
      }

      array_push($projects,
        array(
          "slug" => $item,
          "short" => transform_markdown_file("$relative_path/short.md"),
          "title" => transform_markdown_file("$relative_path/title.md")));
    }

    return $projects;
  }
}
