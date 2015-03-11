    <?php if(isset($layout_includes['js']) AND count($layout_includes['js']) > 0): ?>
    <?php foreach($layout_includes['js'] as $js): ?>
    <?php if($js['options'] === NULL OR $js['options'] == 'footer'): ?>
    <!-- additional javascript -->
    <script src="<?php echo $js['file']; ?>"></script>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
  </body>
</html>