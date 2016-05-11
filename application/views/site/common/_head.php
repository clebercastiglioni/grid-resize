<meta charset="utf-8">
<title><?php if(isset($dsTitle)){echo $dsTitle;} ?></title>
<meta name="description" content="<?php if(isset($dsDescription)){echo $dsDescription;} ?>" />
<meta name="keywords" content="<?php if(isset($dsKeywords)){echo $dsKeywords;} ?>"/>
<meta name="author" content="WPlay Marketing Interativo" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta property="og:locale" content="pt_BR" />
<meta property="og:url" content="<?php echo base_url($_SERVER['REQUEST_URI']) ?>" />
<meta property="og:title" content="<?php if(isset($dsTitle)){echo $dsTitle;} ?>" />
<meta property="og:site_name" content="<?php echo config('TITULO') ?>" />
<meta property="og:description" content="<?php if(isset($dsDescription)){echo $dsDescription;} ?>" />
<?php if(isset($dsImage)): ?>
<meta property="og:image" content="<?php echo $dsImage ?>"> 
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="800"> 
<meta property="og:image:height" content="600">
<?php endif; ?>
<meta property="og:type" content="website" />
<meta name="google-site-verification" content="<?php echo config('GOOGLE_SITE') ?>" />
<meta name="format-detection" content="telephone=no"/>
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/main.css') ?>">
<link rel="canonical" href="<?php echo base_url($_SERVER['REQUEST_URI']) ?>" />
<?php if(config('ADDTHIS') != ''): ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?php echo config('ADDTHIS'); ?>" async="async"></script>
<?php endif; ?>
<?php /*
<meta name="theme-color" content="#000000">
*/ ?>
<!-- DEFAULT --><link rel="shortcut icon" href="<?php echo base_url('assets/frontend/img/favicons/icon.png') ?>" >
<!-- 16x16	 --><link rel="icon" type="image/png" href="<?php echo base_url('assets/frontend/img/favicons/icon16x16.png') ?>" sizes="16x16">
<!-- 32x32	 --><link rel="icon" type="image/png" href="<?php echo base_url('assets/frontend/img/favicons/icon32x32.png') ?>" sizes="32x32">
<!-- 57x57	 --><link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('assets/frontend/img/favicons/icon57x57.png') ?>">
<!-- 60x60	 --><link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('assets/frontend/img/favicons/icon60x60.png') ?>">
<!-- 72x72	 --><link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/frontend/img/favicons/icon72x72.png') ?>">
<!-- 76x76	 --><link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/frontend/img/favicons/icon76x76.png') ?>">
<!-- 96x96	 --><link rel="icon" type="image/png" href="<?php echo base_url('assets/frontend/img/favicons/icon96x96.png') ?>" sizes="96x96">
<!-- 114x114 --><link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/frontend/img/favicons/icon114x114.png') ?>">
<!-- 120x120 --><link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('assets/frontend/img/favicons/icon120x120.png') ?>">
<!-- 144x144 --><link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('assets/frontend/img/favicons/icon144x144.png') ?>">
<!-- 144x144 --><meta name="msapplication-TileImage" content="<?php echo base_url('assets/frontend/img/favicons/icon144x144.png') ?>">
<!-- 152x152 --><link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('assets/frontend/img/favicons/icon152x152.png') ?>">
<!-- 160x160 --><link rel="icon" type="image/png" href="<?php echo base_url('assets/frontend/img/favicons/icon160x160.png') ?>" sizes="160x160">
<!-- 196x196 --><link rel="icon" type="image/png" href="<?php echo base_url('assets/frontend/img/favicons/icon196x196.png') ?>" sizes="196x196">