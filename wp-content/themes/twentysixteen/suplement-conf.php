<?php

// function add_registro_acceso_contratacion($post){
//   if (is_user_logged_in()) :
//     // stuff here for user roles that can edit pages: editors and administrators
//     if( current_user_can('edit_others_pages') ) return false;
//       $current_user = wp_get_current_user();
//       $usuario = $current_user->user_login;
//       $email = $current_user->user_email;
//       $titulo_post = get_the_title($post);
//
//       mysql_query("INSERT INTO `administrativa`.`control_acceso_contrataciones` (`usuario`, `email`, `titulo_post`) VALUES ('$usuario', '$email', '$titulo_post');");
//
//   endif;
// }

/* Creación de custom type post contratación */
function especiales() {

  $labels = array(
   'name'               => _x( 'Suplementos', 'post type general name' ),
   'singular_name'      => _x( 'Suplemento', 'post type singular name' ),
   'add_new'            => _x( 'Crear nuevo', 'suplemento' ),
   'add_new_item'       => __( 'Agregar suplemento' ),
   'edit_item'          => __( 'Editar suplemento' ),
   'new_item'           => __( 'Nuevo suplemento' ),
   'all_items'          => __( 'Todas los Suplementos' ),
   'view_item'          => __( 'Ver suplementos' ),
   'search_items'       => __( 'Buscar suplementos' ),
   'not_found'          => __( 'No se encontraron suplementos' ),
   'not_found_in_trash' => __( 'No se encontraron suplementos en la papelera' ),
   'parent_item_colon'  => '',
   'menu_name'          => 'Especiales'
 );
 $args = array(
   'labels'        => $labels,
   'description'   => 'Holds our Contratacions and Contratacion specific data',
   'public'        => true,
   'menu_position' => 5,
   'supports'      => array( 'title', 'editor', 'excerpt' ),
   'has_archive'   => true,
   'menu_icon'     => 'dashicons-align-right',
 );
  register_post_type( 'suplemento', $args );
}
add_action( 'init', 'especiales' );

/* Mostrar el rubro en mostrar todos */
function my_cpt_support_author() {
    add_post_type_support( 'suplemento', 'suplemento_domingo' );
}
add_action('init', 'my_cpt_support_author');


function my_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['suplemento'] = array(
    0 => '',
    1 => sprintf( __('Suplemento actualizada. <a href="%s">Ver Suplemento</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Campo actualizado.'),
    3 => __('Campo eliminado.'),
    4 => __('Suplemento actualizada.'),
    5 => isset($_GET['revision']) ? sprintf( __('Suplemento recuperado - revisión %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Suplemento publicado. <a href="%s">Ver Suplemento</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Suplemento guardada.'),
    8 => sprintf( __('Suplemento enviada. <a target="_blank" href="%s">Vista previa</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Suplemento programado para: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Vista previa</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Borrador actualizado. <a target="_blank" href="%s">Vista previa</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages' );

/*
    Categorias --> MENU EN POST ESPECIAL
*/


function my_taxonomies_suplemento_domingo() {
  $labels = array(
    'name'              => _x( 'T+ de domingo', 'taxonomy general name' ),
    'singular_name'     => _x( 'suplemento domingo', 'taxonomy singular name' ),
    'search_items'      => __( 'Buscar suplementos domingo' ),
    'all_items'         => __( 'Todos los suplementos domingo' ),
    'parent_item'       => __( 'Parent Suplemento Category' ),
    'parent_item_colon' => __( 'Parent Suplemento Category:' ),
    'edit_item'         => __( 'Editar Suplemento' ),
    'update_item'       => __( 'Actualizar Suplemento de Domingo' ),
    'add_new_item'      => __( 'Agregar nuevo Suplemento de Domingo' ),
    'new_item_name'     => __( 'Nuevo Suplemento de Domingo' ),
    'menu_name'         => __( 'T+ de Domingo' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'suplemento_domingo', 'suplemento', $args );
}

add_action( 'init', 'my_taxonomies_suplemento_domingo', 0 );

/*contrataciones se divide en dos, vigentes y historicas. Que sean categorias de wp */

function my_taxonomies_especiales_mixtos() {
  $labels = array(
    'name'              => _x( 'Mixtos', 'taxonomy general name' ),
    'singular_name'     => _x( 'Mixto', 'taxonomy singular name' ),
    'search_items'      => __( 'Buscar especiales mixtos' ),
    'all_items'         => __( 'Todos los especiales mixtos' ),
    'parent_item'       => __( 'Parent especiales mixtos Category' ),
    'parent_item_colon' => __( 'Parent especiales mixtos Category:' ),
    'edit_item'         => __( 'Editar especial mixtos' ),
    'update_item'       => __( 'Actualizar especial mixtos' ),
    'add_new_item'      => __( 'Agregar nuevo especial mixtos' ),
    'new_item_name'     => __( 'Nuevo especial mixtos' ),
    'menu_name'         => __( 'Mixtos' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'suplemento_mixto', 'suplemento', $args );
}

add_action( 'init', 'my_taxonomies_especiales_mixtos', 0 );


/*
    DATOS OBLIGATORIOS - BOXES
*/



add_action( 'add_meta_boxes', 'suplemento_general' );
function suplemento_general(){
      add_meta_box(
          'suplemento_general',
          __( 'Datos obligatorios', 'myplugin_textdomain' ),
          'suplemento_build_content',
          'suplemento',
          'advanced',
          'high'
      );
  }

  function get_list_categories(){
  	return get_list_subcategories(0);
  }

  function get_list_subcategories($parent){
  	$result = "";

  	$args = array(
  		'taxonomy'	=>"category",
  		'parent'	=> $parent,
  		'hide_empty' => 0
  	);

  	$categories = get_categories($args);

  	foreach($categories as $category)
  		$result .= '<option value="'.$category->cat_ID.'">' . $category->cat_name . '</option>';

  	return $result;
  }



function suplemento_build_content( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'contratacion_general_nonce' );

  $contrataciones = array(
    array('id'=>'modalidad','texto'=>'Modalidad'),
    array('id'=>'expediente_numero','texto'=>'Expediente Nº'),
    array('id'=>'recepcion_ofertas','texto'=>'Recepción de ofertas'),
    array('id'=>'fecha_tope','texto'=>'Fecha tope para recibir ofertas'),
    array('id'=>'fecha_apertura','texto'=>'Fecha y hora de apertura'),
    array('id'=>'consulta','texto'=>'Consultar a')
  );



       $contenido_campos_actualizados = get_post_meta( $post->ID,  $key = '', $single = false );
       $pliego = get_post_meta($post->ID, 'pliego', true);
       $circulares = get_post_meta($post->ID, 'circulares', true);

      // var_dump($contenido_campos_actualizados);
      // var_dump($pliego);

      echo "<table>";
      foreach ( $contrataciones as $contratacion){
        $contenido="";
          foreach ($contenido_campos_actualizados as $key => $value){
            if( $contratacion['id'] == $key) $contenido = $value[0];
        }
      echo "<tr>";
      echo '<td><label for="'.$contratacion['id'].'">'.$contratacion['texto'].'</label></td>';
      echo '<td><input type="text" id="'.$contratacion['id'].'" name="'.$contratacion['id'].'" placeholder="Ingrese '.$contratacion['texto'].'" size="75" value="'.$contenido.'"/></td>';
      echo "</tr>";
    }
    echo "<tr>";
    echo "<td><label for='categorias'>Lista de categorias</label></td>";
    echo "<td><br>";
    echo "<select onChange=\'javascript:ajaxSelect('http://localhost/wordpress/wp-content/themes/twentysixteen/noticiasxcategoria.php',this,'noticias');\' name='categorias' id='categorias'>";
    echo get_list_categories();
    echo "</select></td>";
    echo "</tr>";
    echo "<tr id='noticias'>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><label for='pliego'>Documentos adjuntos</label></td>";
    echo "<td><br>";
    wp_editor($pliego, 'pliego', array(
            'wpautop'               =>      true,
            'media_buttons' =>      true,
            'textarea_name' =>      'pliego',
            'textarea_rows' =>      10,
            'teeny'                 =>      true
            ));
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><label for='circulares'>Circulares</label></td>";
    echo "<td><br><br>";
    wp_editor($circulares, 'circulares', array(
            'wpautop'               =>      true,
            'media_buttons' =>      true,
            'textarea_name' =>      'circulares',
            'textarea_rows' =>      10,
            'teeny'                 =>      true
            ));
    echo "<br></td>";
    echo "</tr>";
    echo "</table>";
}

add_action( 'save_post', 'add_pliego_field', 10, 1 );

function add_pliego_field( $post_id ) {
    global $post;
    if ($post->post_type != 'contratacion'){
        return;
    }
    $pliego = str_replace( "\r\n\r\n", '<br />', $_POST['pliego'] );
    $pliego = str_replace( "\r\n", '<br />', $_POST['pliego'] );
    update_post_meta($post_id, 'pliego', $pliego );
}

add_action( 'save_post', 'add_circulares_field', 10, 1 );

function add_circulares_field( $post_id ) {
  global $post;
  if ($post->post_type != 'contratacion'){
      return;
  }
  $circulares = str_replace( "\r\n\r\n", '<br />', $_POST['circulares'] );
  $circulares = str_replace( "\r\n", '<br />', $_POST['circulares'] );
        update_post_meta($post_id, 'circulares', $circulares );
}

add_action( 'save_post', 'contratacion_box_save' );
function contratacion_box_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;

  if ( !wp_verify_nonce( $_POST['contratacion_general_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  $contrataciones = array(
    array('id'=>'modalidad','texto'=>"$_POST[modalidad]"),
    array('id'=>'expediente_numero','texto'=>"$_POST[expediente_numero]"),
    array('id'=>'recepcion_ofertas','texto'=>"$_POST[recepcion_ofertas]"),
    array('id'=>'fecha_tope','texto'=>"$_POST[fecha_tope]"),
    array('id'=>'fecha_apertura','texto'=>"$_POST[fecha_apertura]"),
    array('id'=>'consulta','texto'=>"$_POST[consulta]")
  );

    foreach ( $contrataciones as $contratacion){
      update_post_meta( $post_id, $contratacion["id"], $contratacion["texto"] );
    }
}



/* AGREGAR COLUMNA A EL EDITOR DE TODOS LOS POST */
function get_suplemento_domingo_content ($post_ID){
  $terms = wp_get_post_terms( $post_ID, 'suplemento_domingo', array("fields" => "all") );
  $suplemento = $terms[0];
  return $suplemento->name;
}

function get_suplemento_mixto_content ($post_ID){
  $terms = wp_get_post_terms( $post_ID, 'suplemento_mixto', array("fields" => "all") );
  $suplemento = $terms[0];
  return $suplemento->name;
}

// Agregar columnas
function custom_columns_head($defaults) {
    $defaults['suplemento_domingo'] = 'Domingo';
    $defaults['suplemento_mixto'] = 'Mixto';
    return $defaults;
}

// Asignarle la vista del contenido
function custom_columns_content($column_name, $post_ID) {
    if ($column_name == 'suplemento_domingo') {
        $suplemento_content = get_estado_content($post_ID);
        if ($suplemento_content) {
            echo '<strong>' . $suplemento_content . '</strong>';
        }
    }
    if ($column_name == 'suplemento_mixto') {
        $suplemento_content = get_rubro_content($post_ID);
        if ($suplemento_content) {
            echo '<strong class="column-date">' . $suplemento_content . '</strong>';
        }
    }
}

add_filter('manage_posts_columns', 'custom_columns_head');
add_action('manage_posts_custom_column', 'custom_columns_content', 10, 2);

/* CAMBIAR NOMBRE AL EXTRACTO DEL POST*/
//
// add_filter( 'gettext', 'wpse22764_gettext', 10, 2 );
// function wpse22764_gettext( $translation, $original )
// {
//   global $post;
//   if(!empty($post)){
//     if ($post->post_type == "contratacion") {
//       if ( 'Excerpt' == $original ) {
//         return 'Objeto de la Contratación';
//       }else{
//           $pos = strpos($original, 'Excerpts are optional hand-crafted summaries of your');
//           if ($pos !== false) {
//               return  'Ingresar objeto de la Contratación aquí';
//           }
//       }
//     }
//     }
//
//     return $translation;
// }

?>
