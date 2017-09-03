<?php
/* Smarty version 3.1.30, created on 2017-09-03 12:10:21
  from "/home/tomohiro/tomo/program/study_php/phpFreamwork/gakusai/backend/views/templates/sponsor/hello.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59abd50d98c093_95321248',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8a1ada731395caaaa647bf1681d3bd2806cef456' => 
    array (
      0 => '/home/tomohiro/tomo/program/study_php/phpFreamwork/gakusai/backend/views/templates/sponsor/hello.tpl',
      1 => 1504433418,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59abd50d98c093_95321248 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>App</title>
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
  <!--[if lte IE 8]>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">
  <![endif]-->
  <!--[if gt IE 8]><!-->
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
  <!--<![endif]-->
  <link rel="stylesheet" href="/phpFreamwork/gakusai/webroot/css/reset.css">
</head>

<body>
  <sponsor-list id="sponsor" data-list='<?php echo $_smarty_tpl->tpl_vars['sponsor']->value;?>
'></sponsor-list>
  <?php echo '<script'; ?>
 src="/phpFreamwork/gakusai/webroot/scripts/bundle.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
