<?php
// $Id: maintenance-page.tpl.php,v 1.1.2.23 2008/07/27 18:05:04 andregriffin Exp $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>">
  <head>
    <title><?php print $head_title ?></title>
    <?php print $head ?>
    <?php print $styles ?>
    <?php print $scripts ?>
    <!--[if lte IE 7]><?php print phptemplate_get_ie_styles(); ?><![endif]--><!--If Less Than or Equal (lte) to IE 7-->
  </head>
  <body<?php print phptemplate_body_class($left, $right); ?>>

<!-- Layout -->
    <div id="wrapper">
      <div id="header">
        <?php print $header; ?>

        <?php
          // Prepare header
          $site_fields = array();
          if ($site_name) {
            $site_fields[] = check_plain($site_name);
          }
          if ($site_slogan) {
            $site_fields[] = check_plain($site_slogan);
          }
          $site_title = implode(' ', $site_fields);
          if ($site_fields) {
            $site_fields[0] = '<span>'. $site_fields[0] .'</span>';
          }
          $site_fields[1] = '<span id="slogan">'. $site_slogan .'</span>';
          $site_html = implode(' ', $site_fields);

          if ($logo || $site_title) {
            print '<h1><a href="'. check_url($front_page) .'" title="'. $site_title .'">';
            if ($logo) {
              print '<img src="'. check_url($logo) .'" alt="'. $site_title .'" id="logo" />';
            }
            print $site_html .'</a></h1>';
          }
        ?>

        <div class="clear"></div>
      </div> <!-- /#header -->

      <div id="nav">
        <?php if (isset($primary_links)) : ?>
          <?php print theme('links', $primary_links, array('class' => 'links primary-links')) ?>
        <?php endif; ?>

        <?php if (isset($secondary_links)) : ?>
          <?php print theme('links', $secondary_links, array('class' => 'links secondary-links')) ?>
        <?php endif; ?>
      </div> <!-- /#nav -->

      <div id="container">

        <?php if ($left): ?>
          <div id="sidebar-left" class="sidebar">
            <?php print $left ?>
          </div> <!-- /#sidebar-left -->
        <?php endif; ?>

        <div id="center">
          <?php if ($title): print '<h2'. ($tabs ? ' class="with-tabs"' : '') .'>'. $title .'</h2>'; endif; ?>
          <?php print $help; ?>
          <?php print $messages; ?>
          <?php print $content ?>
        </div> <!-- /#center -->
  
        <?php if ($right): ?>
          <div id="sidebar-right" class="sidebar">
            <?php print $right ?>
          </div> <!-- /#sidebar-right -->
        <?php endif; ?>

        <div id="footer" class="clear">
          <?php print $footer_message . $footer ?>
          <?php print $feed_icons ?>
        </div> <!-- /#footer -->

      </div> <!-- /#container -->
      <span class="clear"></span>
    </div> <!-- /#wrapper -->
<!-- /layout -->

  <?php print $closure ?>

  </body>
</html>
