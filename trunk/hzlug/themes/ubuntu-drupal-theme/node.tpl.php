<?php
// $Id: node.tpl.php,v 1.1.2.22 2008/07/27 18:05:04 andregriffin Exp $
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">

<?php print $picture ?>

<?php if ($page == 0): ?>
  <div id="node-title"><div class="inner"><span class="corners-top"><span></span></span>
    <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
  <?php if ($submitted): ?>
    <span class="submitted"><?php print $submitted; ?></span>
  <?php endif; ?>
  <span class="corners-bottom"><span></span></span></div></div>
<?php endif; ?>

  <?php if ($page != 0 && $submitted): ?>
    <span class="submitted"><?php print $submitted; ?></span>
  <?php endif; ?>

  <div class="content">
    <?php print $content ?>
  </div>

  <div class="meta">

    <?php if ($links): ?>
      <div class="links">
        <?php print $links; ?>
      </div>
    <?php endif; ?>

    <?php if ($taxonomy): ?>
      <div class="terms">
        <?php print $terms ?>
      </div>
    <?php endif;?>

    <span class="clear"></span>

  </div>

</div>
