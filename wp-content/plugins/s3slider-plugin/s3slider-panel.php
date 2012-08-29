<?php
global $wpdb;

if ( function_exists('plugins_url') )
    $url = plugins_url(plugin_basename(dirname(__FILE__)));
else
    $url = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));

$s3s_plugindir = ABSPATH.'wp-content/plugins/s3slider-plugin/';
$s3s_pluginurl = $url;
$s3s_filesdir = ABSPATH.'wp-content/plugins/s3slider-plugin/files/';
$s3s_filesurl = $url.'/files/';
$s3s_x = "empty"; 
$s3s_y= "empty"; 
$s3s_x2= "empty"; 
$s3s_y2= "empty";
?>

<link rel="stylesheet" type="text/css" href="<?php echo $s3s_pluginurl; ?>/css/s3slider.css" />
<script type="text/javascript" src="<?php echo $s3s_pluginurl; ?>/js/functions.js"></script>
<div class="wrap">
  <?php

        if (isset($_GET['remove'])) {
            $s3s_file_type = $wpdb->get_var("SELECT s3slider_type FROM {$wpdb->prefix}s3slider WHERE s3slider_id = '$_GET[remove]'");
            $wpdb->query("DELETE FROM {$wpdb->prefix}s3slider WHERE s3slider_id = $_GET[remove]");
            if (is_file($s3s_filesdir.$_GET['remove'].'_o.'.$s3s_file_type)) { unlink($s3s_filesdir.$_GET['remove'].'_o.'.$s3s_file_type); }
            if (is_file($s3s_filesdir.$_GET['remove'].'_s.'.$s3s_file_type)) { unlink($s3s_filesdir.$_GET['remove'].'_s.'.$s3s_file_type); }
            unset($_GET);
        }

        if (isset($_POST['order_id'])) {
            $values = array( 's3slider_order' => $_POST['order_value'] );
            $conditions = array( 's3slider_id' => $_POST['order_id']);
            $values_types = array('%d');
            $conditions_types = array('%d');
            $wpdb->update($wpdb->prefix.'s3slider', $values, $conditions, $values_types, $conditions_types);
            unset($_GET);
        }
        
        if (isset($_POST['options'])) {
            update_option('s3slider_width', $_POST['s3slider_width']);
            update_option('s3slider_height', $_POST['s3slider_height']);
            update_option('s3slider_timeout', $_POST['s3slider_timeout']);
            update_option('s3slider_quality', $_POST['s3slider_quality']);
            
        }

        if (isset($_POST['x'])) {
            if($_POST['s3slider_file_type'] == 'jpeg')
            {
                $s3s_image_src = imagecreatefromjpeg($s3s_filesdir.$_POST['s3slider_file_id'].'_o.'.$_POST['s3slider_file_type']);
                $s3s_image_crop = imagecreatetruecolor(get_option('s3slider_width'), get_option('s3slider_height'));
                imagecopyresampled($s3s_image_crop, $s3s_image_src, 0, 0, $_POST['x'],$_POST['y'], get_option('s3slider_width'), get_option('s3slider_height'), $_POST['w'], $_POST['h']);
                imagejpeg($s3s_image_crop,$s3s_filesdir.$_POST['s3slider_file_id'].'_s.'.$_POST['s3slider_file_type'], get_option('s3slider_quality'));
            }
            else if($_POST['s3slider_file_type'] == 'png')
            {
                $s3s_image_src = imagecreatefrompng($s3s_filesdir.$_POST['s3slider_file_id'].'_o.'.$_POST['s3slider_file_type']);
                $s3s_image_crop = imagecreatetruecolor(get_option('s3slider_width'), get_option('s3slider_height'));
                imagecopyresampled($s3s_image_crop, $s3s_image_src, 0, 0, $_POST['x'],$_POST['y'], get_option('s3slider_width'), get_option('s3slider_height'), $_POST['w'], $_POST['h']);
                imagepng($s3s_image_crop,$s3s_filesdir.$_POST['s3slider_file_id'].'_s.'.$_POST['s3slider_file_type']);
            }
            else if($_POST['s3slider_file_type'] == 'gif')
            {
                $s3s_image_src = imagecreatefromgif($s3s_filesdir.$_POST['s3slider_file_id'].'_o.'.$_POST['s3slider_file_type']);
                $s3s_image_crop = imagecreatetruecolor(get_option('s3slider_width'), get_option('s3slider_height'));
                imagecopyresampled($s3s_image_crop, $s3s_image_src, 0, 0, $_POST['x'],$_POST['y'], get_option('s3slider_width'), get_option('s3slider_height'), $_POST['w'], $_POST['h']);
                imagegif($s3s_image_crop,$s3s_filesdir.$_POST['s3slider_file_id'].'_s.'.$_POST['s3slider_file_type']);
            }

            $values = array(
                's3slider_x' => $_POST['x'],
                's3slider_y' => $_POST['y'],
                's3slider_x2' => $_POST['x2'],
                's3slider_y2' => $_POST['y2'],
                's3slider_w' => $_POST['w'],
                's3slider_h' => $_POST['h'],
                's3slider_text' => $_POST['s3slider_file_text'],
                's3slider_text_headline' => $_POST['s3slider_file_text_headline'],
            
                's3slider_image_link' => $_POST['s3slider_image_link']
            );
            
            $conditions = array( 's3slider_id' => $_POST['s3slider_file_id']);
            
            $values_types = array('%d','%d','%d','%d','%d','%d','%s','%s','%s');
            $conditions_types = array('%d');
            $wpdb->update($wpdb->prefix.'s3slider', $values, $conditions, $values_types, $conditions_types);
            unset($_GET);
        }

        if ((isset($_FILES['file'])) || (isset($_GET['edit']))) {
            if (isset($_FILES['file'])) {
                $s3s_file_type = explode('/',$_FILES['file']['type']);
                if ($s3s_file_type[1] != 'jpeg' && $s3s_file_type[1] != 'png'  && $s3s_file_type[1] != 'gif') die(_e('Sorry. Only JPG GIF and PNG formats are supported','s3slider'));
                $values = array('s3slider_order' => 0, 's3slider_type' => $s3s_file_type[1]);
                $types = array('%d','%s');
                $wpdb->insert($wpdb->prefix.'s3slider',$values, $types);
                $s3s_file_id = $wpdb->get_var("SELECT s3slider_id FROM {$wpdb->prefix}s3slider ORDER BY s3slider_id DESC LIMIT 1");
                $s3s_original_image_dir = $s3s_filesdir.$s3s_file_id.'_o.'.$s3s_file_type[1];
                $s3s_original_image_url = $s3s_filesurl.$s3s_file_id.'_o.'.$s3s_file_type[1];
                move_uploaded_file($_FILES['file']['tmp_name'], $s3s_original_image_dir);
                list($s3s_file_width,$s3s_file_height) = getimagesize($s3s_original_image_dir);

                if ($s3s_file_width > 1000) {
                    $s3s_image_res_w = 1000;
                    $s3s_image_res_h = $s3s_file_height*1000/$s3s_file_width;
                    $s3s_image_res = imagecreatetruecolor($s3s_image_res_w, $s3s_image_res_h);
                    if($s3s_file_type[1] == 'jpeg')
                    {
                        $s3s_image_src = imagecreatefromjpeg($s3s_original_image_dir);
                        imagecopyresized($s3s_image_res, $s3s_image_src, 0, 0, 0, 0, $s3s_image_res_w, $s3s_image_res_h, $s3s_file_width, $s3s_file_height);
                        imagedestroy($s3s_image_src);
                        imagejpeg($s3s_image_res, $s3s_original_image_dir);
                    }
                    else if($s3s_file_type[1] == 'png')
                    {
                        $s3s_image_src = imagecreatefrompng($s3s_original_image_dir);
                        imagecopyresized($s3s_image_res, $s3s_image_src, 0, 0, 0, 0, $s3s_image_res_w, $s3s_image_res_h, $s3s_file_width, $s3s_file_height);
                        imagedestroy($s3s_image_src);
                        imagepng($s3s_image_res, $s3s_original_image_dir);
                    }
                    else if($s3s_file_type[1] == 'gif')
                    {
                        $s3s_image_src = imagecreatefromgif($s3s_original_image_dir);
                        imagecopyresized($s3s_image_res, $s3s_image_src, 0, 0, 0, 0, $s3s_image_res_w, $s3s_image_res_h, $s3s_file_width, $s3s_file_height);
                        imagedestroy($s3s_image_src);
                        imagegif($s3s_image_res, $s3s_original_image_dir);
                    }
                }
            } elseif (isset($_GET['edit'])) {
                $item = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}s3slider WHERE s3slider_id = '$_GET[edit]'");
                $s3s_file_type[1] = $item->s3slider_type;
                $s3s_file_text = $item->s3slider_text;
                $s3s_x = $item->s3slider_x;
                $s3s_y = $item->s3slider_y;
                $s3s_x2 = $item->s3slider_x2;
                $s3s_y2 = $item->s3slider_y2;
                $s3s_w = $item->s3slider_w;
                $s3s_h = $item->s3slider_h;
                
                $s3s_image_link = $item->s3slider_image_link;
                $s3s_file_text_headline = $item->s3slider_text_headline;
                $s3s_file_id = $_GET['edit'];
                $s3s_original_image_dir = $s3s_filesdir.$s3s_file_id.'_o.'.$s3s_file_type[1];
                $s3s_original_image_url = $s3s_filesurl.$s3s_file_id.'_o.'.$s3s_file_type[1];
            }

            list($s3s_file_width,$s3s_file_height) = getimagesize($s3s_original_image_dir);
	?>
    <script src="<?php echo $s3s_pluginurl; ?>/js/jquery.min.js"></script>
    <script src="<?php echo $s3s_pluginurl; ?>/js/jquery.Jcrop.js"></script>
    <link rel="stylesheet" href="<?php echo $s3s_pluginurl; ?>/css/jquery.Jcrop.css" type="text/css" />
    <script language="Javascript">
        var $j = jQuery.noConflict();

        $j(window).load(function() {
            $j('#image').Jcrop({
                onChange: showPreview,
                onSelect: showPreview,
                onChange: showCoords,
                setSelect:   [  <?php if ($s3s_x == "empty") {
                                        echo 100;
                                    } else {
                                        echo $s3s_x;
                                    }
                                  ?>,
                                  <?php if ($s3s_y == "empty") {
                                        echo 100;
                                    } else {
                                        echo $s3s_y;
                                    }
                                  ?>,
                                   <?php if ($s3s_x2 == "empty") {
                                        echo 50;
                                    } else {
                                        echo $s3s_x2;
                                    }
                                  ?>,    
                                <?php if ($s3s_y2 == "empty") {
                                        echo 50;
                                    } else {
                                        echo $s3s_y2;
                                    }
                                  ?> ],
                aspectRatio: <?php echo get_option('s3slider_width')/get_option('s3slider_height'); ?>
            });
        });

        function showPreview(coords) {
            if (parseInt(coords.w) > 0) {
                var rx = <?php echo get_option('s3slider_width'); ?> / coords.w;
                var ry = <?php echo get_option('s3slider_height'); ?> / coords.h;
                $j('#preview').css({
                    width: Math.round(rx * <?php echo $s3s_file_width; ?>) + 'px',
                    height: Math.round(ry * <?php echo $s3s_file_height; ?>) + 'px',
                    marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                    marginTop: '-' + Math.round(ry * coords.y) + 'px'
                });
            }
        }

        function showCoords(c) {
            $j('#x').val(c.x);
            $j('#y').val(c.y);
            $j('#x2').val(c.x2);
            $j('#y2').val(c.y2);
            $j('#w').val(c.w);
            $j('#h').val(c.h);
        };
        
        
            var $b = jQuery.noConflict();
                $b(document).ready(function() {
                // Initialise the table
                $b("#table-1").tableDnD();
            });
    
    </script>
    <h3><?php _e('Original image', 's3slider'); ?></h3>
    <small>
        <?php _e('Click and drag to select the crop area','s3slider'); ?><br/>
        <img src="<?php echo $s3s_original_image_url.'?'.rand(1,1000); ?>" id="image" />
        <h3><?php _e('Slide preview','s3slider'); ?></h3>
        <div style="width:<?php echo get_option('s3slider_width'); ?>px;height:<?php echo get_option('s3slider_height'); ?>px;overflow:hidden;"> <img src="<?php echo $s3s_original_image_url.'?'.rand(1,1000); ?>" id="preview" /> </div>
        <form name="s3slider_coords" method="post">
            
            <h3><?php _e('Image text','s3slider'); ?></h3>
            <input type="text" name="s3slider_file_text_headline" value="<?php echo stripslashes($s3s_file_text_headline); ?>" /><br />
            <textarea name="s3slider_file_text" style="width:<?php echo get_option('s3slider_width'); ?>px;"><?php echo stripslashes($s3s_file_text); ?></textarea>
            
            <h3><?php echo "Image Link(optional)" ?></h3>
            <input type="text" name="s3slider_image_link" value="<?php echo stripslashes($s3s_image_link); ?>" /><br />

            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="x2" name="x2" />
            <input type="hidden" id="y2" name="y2" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="s3slider_file_id" name="s3slider_file_id" value="<?php echo $s3s_file_id; ?>" />
            <input type="hidden" id="s3slider_file_type" name="s3slider_file_type" value="<?php echo $s3s_file_type[1]; ?>" /><br />
            <input type="submit" id="crop_button" value="<?php _e('Crop','s3slider'); ?>" />
        </form>
        <?php
    } else {
    ?>
    <div class="tablenav">
    <div class="alignleft actions">
      <input type="button" value="<?php _e('Add New','s3slider'); ?>" onClick="Show('s3slider_addnew'); return false;" class="button-secondary action" />
      <input type="button" value="<?php _e('Options','s3slider'); ?>" onClick="Show('s3slider_options'); return false;" class="button-secondary action" />
    </div>
    </div>
    <div id="s3slider_addnew" class="s3slider_box">
    <?php if (substr(decoct(fileperms($s3s_filesdir)),2) != '777') : ?>
    <p class="warning"><b>
      <?php _e('Warning','s3slider'); ?>
      :</b> <?php printf(__('The permissions to the directory <b>%s</b> are invalid. Set them to 777 to be able to upload files.','s3slider'),$s3s_filesdir); ?>
      <?php else : ?>
    <form name="s3slider_addnew" method="post" action="" enctype="multipart/form-data">
      <table>
        <tr>
          <td><?php _e('File','s3slider'); ?>
            :</td>
          <td><input type="file" name="file" />
            <input type="submit" value="<?php _e('Send File','s3slider'); ?>" /></td>
        </tr>
      </table>
    </form>
    <?php endif; ?>
    </div>
    <div id="s3slider_options" class="s3slider_box">
    <form name="s3slider_options" method="post" action="">
      <table>
        <tr>
          <td><?php _e('Width','s3slider'); ?>
            :</td>
          <td><input type="text" name="s3slider_width" value="<?php echo get_option('s3slider_width'); ?>" />
            px</td>
        </tr>
        <tr>
          <td><?php _e('Height','s3slider'); ?>
            :</td>
          <td><input type="text" name="s3slider_height" value="<?php echo get_option('s3slider_height'); ?>" />
            px</td>
        </tr>
        <tr>
          <td><?php _e('Timeout','s3slider'); ?>
            :</td>
          <td><input type="text" name="s3slider_timeout" value="<?php echo get_option('s3slider_timeout'); ?>" />
            ms</td>
        </tr>
        
       <tr>
          <td><?php echo "Quality"; ?>
            :</td>
          <td><input type="text" name="s3slider_quality" value="<?php echo get_option('s3slider_quality'); ?>" />
            Number Between 1 and 100 , with 100 being the highest quality</td>
        </tr>		
        <tr>
          <td colspan="2"><input type="submit" name="options" value="<?php _e('Save','s3slider'); ?>" class="button-secondary action" /></td>
        <tr>
      </table>
    </form>
    </div>
    <div id="s3slider_images">
    <table class="widefat post fixed" cellspacing="0">
      <thead>
        <tr>
          <th width="5%"  class="manage-column" style=""><?php _e('Order','s3slider'); ?></th>
          <th width="30%" class="manage-column" style=""><?php _e('Image','s3slider'); ?></th>
          <th width="50%" class="manage-column" style=""><?php _e('Text','s3slider'); ?></th>
          <th width="20%" class="manage-column" style=""></td>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th scope="col" class="manage-column"><?php _e('Order','s3slider'); ?></th>
          <th scope="col" class="manage-column"><?php _e('Image','s3slider'); ?></th>
          <th scope="col" class="manage-column"><?php _e('Text','s3slider'); ?></th>
          <th scope="col" class="manage-column"></td>
        </tr>
      </tfoot>
      <script type="text/javascript" src="<?php echo $s3s_pluginurl; ?>/js/jquery.tablednd_0_5.js"></script>
        <script type="text/javascript">
            var $b = jQuery.noConflict();
            $b(document).ready(function() {
            $b("#table-1").tableDnD();
                $b('#table-1').tableDnD({
                onDrop: function(table, row) {
                    update();
                    }
                });
            });
            function update(){
                $b(".orderNumber").each(function(index){
                    $b(this).html(index);
                    var orderId=$b(this).parent().find("input[name='order_id']").attr("value");
                    $b.ajax({
                       type: "POST",
                       url: '<?php bloginfo('url'); ?>/wp-admin/admin.php?page=s3slider-plugin/s3slider.php',
                       data: "order_value="+index+"&order_id="+orderId,
                       success: function(msg){
                       }
                     });
                })
            }
        </script>
        <style>
            .tDnD_whileDrag{background:#ececec;}
        </style>		 
      <tbody id="table-1">
      
        <?php $items = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}s3slider ORDER BY s3slider_order,s3slider_id ASC"); ?>
        <?php if ($items) : ?>
        <?php foreach ($items as $item) : ?>
        <tr>
          <td class="manage-column column-numero orderNumber"><?php echo $item->s3slider_order; ?></td>
          <td class="manage-column column-numero"><img width="80%" src="<?php echo $s3s_filesurl.$item->s3slider_id.'_s.'.$item->s3slider_type; ?>" /></td>
          <td class="manage-column column-numero"><strong><?php echo stripslashes($item->s3slider_text_headline); ?></strong><br />
            <?php echo stripslashes($item->s3slider_text); ?>
            <br />
            <?php if($item->s3slider_image_link != ''){ ?>
            Image Links to : <a href="<?php echo stripslashes($item->s3slider_image_link); ?>"><?php echo stripslashes($item->s3slider_image_link); ?></a>
            <?php } ?>
            </td>
          <td class="manage-column column-numero"><small> <a href="admin.php?page=s3slider-plugin/s3slider.php&edit=<?php echo $item->s3slider_id; ?>">
            <?php _e('Edit','s3slider'); ?>
            </a> | <a href="admin.php?page=s3slider-plugin/s3slider.php&remove=<?php echo $item->s3slider_id; ?>">
            <?php _e('Remove','s3slider'); ?>
            </a> | <a href="#" onClick="Show('order_<?php echo $item->s3slider_id; ?>'); return false;">
            <?php _e('Change Order','s3slider'); ?>
            </a><br/>
            <form id="order_<?php echo $item->s3slider_id; ?>" name="order_<?php echo $item->s3slider_id; ?>" class="order" method="post">
              <input type="text" class="order_value" name="order_value" value="<?php echo $item->s3slider_order; ?>" />
              <input type="hidden" name="order_id" value="<?php echo $item->s3slider_id; ?>" />
              <input type="submit" value="Save Order" />
            </form>
            </small></td>
        </tr>
        <?php endforeach; ?>
        
        <?php else : ?>
        <tr>
          <td colspan="3"><?php _e('No images uploaded yet.','s3slider'); ?></td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
    </div>
    <?php
        }
    ?>
    </div>
