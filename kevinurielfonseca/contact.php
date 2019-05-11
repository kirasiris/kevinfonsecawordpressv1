<?php
/*
Template Name: Contact Page
Template Post Type: page
*/
?>
<?php
  //variable autilizar para mostrar mensaje
  $response = "";
  //funcion para generar mensaje
  function contact_form($type, $message){
    global $response;
    if($type == "success") $response = "<div class='col-md-12'><div class='alert alert-success'>{$message}</div></div>";
    else $response = "<div class='col-md-12'><div class='alert alert-danger'>{$message}</div></div>";
  }
  //mensajes
  $not_human       = "Matematicas simple amigo, intentalo de nuevo, tu puedes!.";
  $missing_content = "Por favor provee toda la informacion.";
  $email_invalid   = "Direccion de Email Invalida.";
  $message_unsent  = "Hubo un error al enviar el mensaje. Intentalo de nuevo";
  $message_sent    = "Bravo!. Tu mensaje se ha enviado.";
  //variables posteadas por el usuario
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $human = $_POST['verefication'];
  //variables de php mailer
  $to = get_option('admin_email');
  $subject = "Has recibido unn nuevo mensaje proveniente de ".get_bloginfo('name');
  $headers = 'De: '. $email . "\r\n" .
    'Responder-A: ' . $email . "\r\n";
  if(!$human == 0){
    if($human != 2) contact_form("error", $not_human); //not human!
    else {
      //validar email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        contact_form("error", $email_invalid);
      else //email es valido
      {
        //validar presencia de nombre y mensaje
        if(empty($name) || empty($message)){
          contact_form("error", $missing_content);
        }
        else //listo!
        {
          $sent = wp_mail($to, $subject, strip_tags($message), $headers);
          if($sent) contact_form("success", $message_sent); //mensaje enviado!
          else contact_form("error", $message_unsent); //el mensaje no fue enviado
        }
      }
    }
  }
  else if ($_POST['submitted']) contact_form("error", $missing_content);
?>
<?php get_header(); ?>
<!-- Page Content -->
<?php include("includes/page-header.php"); ?>
<div class="container">
<div class="row">
<div class="col-md-8">
<article id="article-contact">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                    <!------ Child pages and parent page --->
					<?php if(page_is_parent() || $post->post_parent > 0) : ?>
						<div class="pagination pull-right">
							<li>
								<span class="parent-link"><a href="<?php echo get_the_permalink(get_top_parent()); ?>"><?php echo get_the_title(get_top_parent()); ?></a></span>
								<?php
									$args = array(
										'child_of' => get_top_parent(),
										'title_li' => ''
									);
								?>
								<?php wp_list_pages($args); ?>
							</li>
						</div>
						<div class="clearfix"></div>
					<?php endif; ?>
<?php the_content(); ?>
<?php endwhile; else: ?><div class="alert alert-danger">Ningun tipo de informacion encontrado</div><?php endif; ?>
<!-- Contact Form -->
<?php echo $response; ?>
<form method="post" action="<?php the_permalink(); ?>">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nombre" class="col-form-label">Nombre:</label>
      <input type="text" class="form-control" name="name" id="nombre" autocomplete="name" value="<?php echo esc_attr($_POST['name']); ?>" placeholder="John Doe">
    </div>
    <div class="form-group col-md-6">
      <label for="email" class="col-form-label">Email:</label>
      <input type="email" class="form-control" name="email" id="email" autocomplete="email" value="<?php echo esc_attr($_POST['email']); ?>" placeholder="johndoe@demo.com">
    </div>
   <div class="form-group col-md-12">
    <label for="message_text" class="col-form-label">Mensaje:</label>
    <textarea name="message" id="message_text" class="form-control" placeholder="Escribe aqui tu mensaje"><?php echo esc_textarea($_POST['message']); ?></textarea>
   </div>
   <div class="form-group col-md-12">
   	<label for="message_human" class="col-form-label">Verificacion:</label>
    <input id="message_human" type="text" class="form-control" name="verefication"> + 3 = 5
   </div>
  </div>
  <input type="hidden" name="submitted" value="1">
  <button name="submit" type="submit" class="btn btn-primary btn-sm btn-block">Enviar</button>
</form>
<!-- /Contact Form -->
</article>
</div>
<!-- Blog Sidebar Widgets Column -->
<?php include("includes/sidebar.php"); ?>
</div>
<!-- /.row -->
<?php get_footer(); ?>