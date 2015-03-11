<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel="shortcut icon" href="<?php echo base_url('themes/front/ico/favicon.ico');?>">

    <title><?php echo $layout_title; ?></title>
    <meta name="description" content="<?php echo $meta_desc; ?>"/>
    <meta name="author" content="Raksa Abadi Informatika">   
    
    <?php if(isset($layout_includes['css']) AND count($layout_includes['css']) > 0): ?>
	  <?php foreach($layout_includes['css'] as $css): ?>
    <!-- additional css -->
		<link rel="stylesheet" href="<?php echo $css['file']; ?>"<?php echo ($css['options'] === NULL ? '' : ' media="' . $css['options'] . '"'); ?>>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if(isset($layout_includes['js']) AND count($layout_includes['js']) > 0): ?>
		<?php foreach($layout_includes['js'] as $js): ?>
    <?php if($js['options'] !== NULL AND $js['options'] == 'header'): ?>
    <!-- additional javascript -->
    <script src="<?php echo $js['file']; ?>"></script>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>

    <style type="text/css">

    ::selection{ background-color: #E13300; color: white; }
    ::moz-selection{ background-color: #E13300; color: white; }
    ::webkit-selection{ background-color: #E13300; color: white; }

    body {
        background-color: #fff;
        margin: 40px;
        font: 13px/20px normal Helvetica, Arial, sans-serif;
        color: #4F5155;
    }

    a {
        color: #003399;
        background-color: transparent;
        font-weight: normal;
    }

    h1 {
        color: #444;
        background-color: transparent;
        border-bottom: 1px solid #D0D0D0;
        font-size: 19px;
        font-weight: normal;
        margin: 0 0 14px 0;
        padding: 14px 15px 10px 15px;
    }

    code {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 12px;
        background-color: #f9f9f9;
        border: 1px solid #D0D0D0;
        color: #002166;
        display: block;
        margin: 14px 0 14px 0;
        padding: 12px 10px 12px 10px;
    }

    #body{
        margin: 0 15px 0 15px;
    }
    
    p.footer{
        text-align: right;
        font-size: 11px;
        border-top: 1px solid #D0D0D0;
        line-height: 32px;
        padding: 0 10px 0 10px;
        margin: 20px 0 0 0;
    }
    
    #container{
        margin: 10px;
        border: 1px solid #D0D0D0;
        -webkit-box-shadow: 0 0 8px #D0D0D0;
    }
    </style>
  </head>
  <body>