<?php
// $Id: block.tpl.php,v 1.1.2.22 2008/07/27 18:05:04 andregriffin Exp $
?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module ?>">

  <?php if (!empty($block->subject)): ?>
    <h2><?php print $block->subject ?></h2>
  <?php endif;?>

  <div class="content">
    <?php print $block->content ?>
  </div>

</div>
