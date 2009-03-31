<?php
// $Id$
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
  <head>
    <title><?php print $head_title ?></title>
    <?php print $head; ?>
    <?php print $styles; ?>
    <?php print $csheet; ?>
    <?php print $scripts; ?>
    <!--[if gte IE 7]><?php print ie_styles(); ?><![endif]-->
    <!--[if lte IE 6]><?php print ie6_styles(); ?><![endif]-->
  </head>
  <body>
    <!-- IE Warning -->
    <!--[if gte IE 5]><?php print $iebanner; ?><![endif]-->
    <!-- Layout -->
    <div id="page-top-border"></div>
    <div id="wrapper" style="width: <?php print pagewidth(); ?>px;">
      <div id="page-border-left" style="width:<?php print pagewidth(14); ?>px;">
        <div id="page-border-right">
          <div id="page-content">
            <div id="opera-second-page-content">
              <div id="bg-top"></div>
              <div id="topNav">
                <div id="nav-content">
                  <div id="nav" class="menu">
                    <?php print $topmenu; ?>
                    <div style="clear: both;"></div>
                  </div>
                  <?php print $search_box; ?>
                  <?php print $logo; ?>
                  <div class="clear">
                    <?php print $spacergif; ?>
                  </div>
                </div>
                <!-- /#nav-content -->
              </div>
              <!-- /#topNav -->
              <div id="header" style="width:<?php print pagewidth(24); ?>px">
                <?php print $site_name; ?>
                <?php print $site_slogan; ?>
                <?php print $secondary_links; ?>
                <?php print $mission; ?>
                <?php print $header; ?>
              </div>
              <!-- /#header -->
              <div id="container">
                <?php echo $breadcrumb; ?>
                <div id="container3">
                  <div id="container2">
                    <div id="container1">
                      <?php print $columnarea; ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /#container -->
              <div id="footer" class="clear">
                <?php print $footer; ?>
                <div class="wrapper">
                  <?php print $rulebar; ?>
                  <p>
                    <?php print $leftfooter; ?>
                    <span style="text-align: right; margin-top: -17px; display: block;">
                      <?php print $rightfooter; ?>
                    </span>
                    <?php print $footer_message; ?>
                  </p>
                </div>
              </div>
              <!-- /#footer -->
            </div>
            <!-- /#opera-second-page-content -->
          </div>
          <!-- /#page-content -->
          <div id="bg-bottom"></div>
          <div id="bg-right">&#160;</div>
          <div id="bottom-right">&#160;</div>
        </div>
        <!-- /#page-border-right -->
        <div id="bg-left">&#160;</div>
        <div id="bottom-left">&#160;</div>
      </div>
      <!-- /#page-border-left -->
    </div>
    <!-- /#wrapper -->
    <!-- /layout -->
    <?php print $closure; ?>
  </body>
</html>
