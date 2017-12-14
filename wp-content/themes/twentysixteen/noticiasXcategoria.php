<?php

function get_list_posts($id){
  return get_list_subposts($id);
}

function get_list_subcategories($id){
  $result = "";

  $args = array('category'	=> $id);

  $posts = get_posts($args);

  foreach($posts as $post)
  $result .= '<option value="'.$post->ID.'">' . $post->post_title . '</option>';

  return $result;
}


$id = $_POST["id_category"];

$opciones = get_list_posts($id);

$content = "<td><label for='noticias'>Lista de noticias</label></td>";
$content .="<td><br>";
$content .= "<select name='noticias' id='noticias'>";
$content .= $opciones;
$content .= "</select></td>";

return $content;


 ?>
