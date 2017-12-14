

<?php
// Our custom post type function
function create_posttype() {

    register_post_type( 'suplemento-domingo',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'T+ de Domingo' ),
                'singular_name' => __( 'T+' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'suplemento-domingo'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


/*
* Creating a function to create our CPT
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'T+ de Domingo', 'Post Type General Name', 'twentysixteen' ),
        'singular_name'       => _x( 'T+', 'Post Type Singular Name', 'twentysixteen' ),
        'menu_name'           => __( 'Suplemento Domingo', 'twentysixteen' ),
        'parent_item_colon'   => __( 'Suplemento Domingo', 'twentysixteen' ),
        'all_items'           => __( 'Todos los suplementos', 'twentysixteen' ),
        'view_item'           => __( 'Ver Suplementos', 'twentysixteen' ),
        'add_new_item'        => __( 'Agregar Nuevo Suplemento', 'twentysixteen' ),
        'add_new'             => __( 'Agregar Nuevo', 'twentysixteen' ),
        'edit_item'           => __( 'Editar Suplemento', 'twentysixteen' ),
        'update_item'         => __( 'Actualizar Suplemento', 'twentysixteen' ),
        'search_items'        => __( 'Buscar Suplemento', 'twentysixteen' ),
        'not_found'           => __( 'No se encontro', 'twentysixteen' ),
        'not_found_in_trash'  => __( 'No se encontro en papelera', 'twentysixteen' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'T+ de Domingo', 'twentysixteen' ),
        'description'         => __( 'Suplemento Domingo', 'twentysixteen' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt' ),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => array( 'suplemento-domingo' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
//		'register_meta_box_cb' => 'global_notice_meta_box',
    );

    // Registering your Custom Post Type
    register_post_type( 'suplemento-domingo', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type');

//
//add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
//
//function add_my_post_types_to_query( $query ) {
//    if ( is_home() && $query->is_main_query() )
//        $query->set( 'post_type', array( 'post', 'suplemento-domingo' ) );
//    return $query;
//}


// Genero mi caja de campos personalizados
/*
add_action( 'add_meta_boxes', 'agregar_meta_box' );
function agregar_meta_box()
{
  add_meta_box( 'suplemento-meta-box-id', 'Suplemento', 'campos_suplemento_box', 'post', 'side', 'high' );
}

function campos_suplemento_box($post)
{
// $post is already set, and contains an object: the WordPress post
global $post;
$values = get_post_custom( $post->ID );
$text = isset( $values['column_text'] ) ? esc_attr( $values['column_text'][0] ) : ”;
$selected = isset( $values['select-portada'] ) ? esc_attr( $values['select-portada'][0] ) : ”;
// $check = isset( $values['my_meta_box_check'] ) ? esc_attr( $values['my_meta_box_check'][0] ) : ”;

// We'll use this nonce field later on when saving.
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
  ?>
    <label for="column_text">Columna del suplemento</label>
    <input type="text" name="column_text" id="column_text" maxlength="255" value="<?php echo $text; ?>" />

    <label for="select-portada">PORTADA</label>
     <?php
        $args = array( 'selected' => $selected, 'name' => 'select-portada', 'id'=> 'select-portada' );
        wp_dropdown_categories( $args );
     ?>
<?php
}

add_action( 'save_post', 'suplemento_meta_box_save' );
function suplemento_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

        // Make sure your data is set before trying to save it
    if( isset( $_POST['column_text'] ) )
        update_post_meta( $post_id, 'column_text', esc_attr( $_POST['column_text'] ) );

    if( isset( $_POST['select-portada'] ) )
        update_post_meta( $post_id, 'select-portada', esc_attr( $_POST['select-portada'] ) );

}*/


/* copia de coso*/

add_action( 'add_meta_boxes', 'agregar_meta_box' );
function agregar_meta_box(){
      add_meta_box(
          'suplemento_domingo_box',
          __( 'Datos del suplemento', 'myplugin_textdomain' ),
          'suplemento_build_content',
          'suplemento',
          'advanced',
          'high'
      );
  }


function suplemento_build_content( $post ) {
  //wp_nonce_field( plugin_basename( __FILE__ ), 'contratacion_general_nonce' );

  $contrataciones = array(
    array('id'=>'modalidad','texto'=>'Modalidad'),
    array('id'=>'expediente_numero','texto'=>'Expediente Nº'),
    array('id'=>'recepcion_ofertas','texto'=>'Recepción de ofertas'),
    array('id'=>'fecha_tope','texto'=>'Fecha tope para recibir ofertas'),
    array('id'=>'fecha_apertura','texto'=>'Fecha y hora de apertura'),
    array('id'=>'consulta','texto'=>'Consultar a')
  );



       $contenido_campos_actualizados = get_post_meta( $post->ID,  $key = '', $single = false );
       //$pliego = get_post_meta($post->ID, 'pliego', true);
       //$circulares = get_post_meta($post->ID, 'circulares', true);

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
    echo "</table>";
}

//
//
//add_action( 'save_post', 'contratacion_box_save' );
//function contratacion_box_save( $post_id ) {
//
//  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
//  return;
//
//  if ( !wp_verify_nonce( $_POST['contratacion_general_nonce'], plugin_basename( __FILE__ ) ) )
//  return;
//
//  if ( 'page' == $_POST['post_type'] ) {
//    if ( !current_user_can( 'edit_page', $post_id ) )
//    return;
//  } else {
//    if ( !current_user_can( 'edit_post', $post_id ) )
//    return;
//  }
//
//  $contrataciones = array(
//    array('id'=>'modalidad','texto'=>"$_POST[modalidad]"),
//    array('id'=>'expediente_numero','texto'=>"$_POST[expediente_numero]"),
//    array('id'=>'recepcion_ofertas','texto'=>"$_POST[recepcion_ofertas]"),
//    array('id'=>'fecha_tope','texto'=>"$_POST[fecha_tope]"),
//    array('id'=>'fecha_apertura','texto'=>"$_POST[fecha_apertura]"),
//    array('id'=>'consulta','texto'=>"$_POST[consulta]")
//  );
//
//    foreach ( $contrataciones as $contratacion){
//      update_post_meta( $post_id, $contratacion["id"], $contratacion["texto"] );
//    }
//}
//




?>
