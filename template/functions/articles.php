<?php
class Article{
  // Properties
  public $title;
  public $author;
  public $medium;
  public $link;
}

$server = 'mysql31.mydevil.net';
$user   = 'm1105_monarchia';
$pass   = '7vAjk9JOeb9g';

$db_conn = new mysqli($server, $user, $pass, "m1105_wordpress");

if ($db_conn->connect_error) {
  die("Not connected to DB :(");
}
else{
  $sql = "SELECT `post_date`,`post_title`,`post_name`,`post_content` FROM `wp_2_posts` WHERE `post_status`='publish' AND `post_type`='post' ORDER BY `wp_2_posts`.`post_date` DESC LIMIT 6";
  $result = $db_conn->query($sql);

  while ($row = $result->fetch_assoc()) {
    $title = $row['post_title'];
    $site = "https://kiosk.austro-wegry.org/";
    $url = $site.$row['post_name'];
    $content = $row['post_content'];
    $content = strip_tags($content);
    $content = substr($content, 0, 350)."...";
    echo
      "<a href='$url'>
      <h3>$title</h3>".
      "<small>$url</small>".
      "<div>$content</div>",
      "</a>"
    ;
  }
