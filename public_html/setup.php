<?PHP
  

  function append_include_path($path)
  {
    set_include_path(get_include_path() . ":" . $path);
  }

  function pmk_error_handler($errno, $errstr, $errfile=NULL, $errline=NULL, $errcontext=NULL)
  {
    printf("Error (%d) %s (%s:%d)\n", $errno, $errstr, $errfile, $errline);
  }

  require_once('config.php');
  require_once('Markdown/markdown.php');

  function transform_markdown_file($filename)
  {
    global $markdown_directory;
    return markdown(file_get_contents($markdown_directory . "/" . $filename));
  }

  function read_plain_file($filename)
  {
    global $markdown_directory;
    return file_get_contents("$markdown_directory/$filename");
  }
?>
