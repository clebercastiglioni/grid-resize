<!DOCTYPE html>
<!-- 
Version: 3.9.0
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $titulo ?> | Painel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/uniform/css/uniform.default.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') ?>" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/fancybox/source/jquery.fancybox.css') ?>" rel="stylesheet"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url('assets/admin/pages/css/inbox.css') ?>" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url('assets/global/css/components.css') ?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/css/plugins.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/layout.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/themes/darkblue.css') ?>" id="style_color" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo base_url('assets/admin/layout/img/favicon.ico') ?>"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content ">
<!-- BEGIN HEADER -->
<?php $this->load->view('painel/common/header'); ?>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
<?php $this->load->view('painel/common/menu'); ?>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<?php echo $titulo ?> <small>contatos do site</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<?php echo anchor(base_url('painel/inicio'), 'In&iacute;cio') ?>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<?php echo anchor(base_url('painel/'. $this->pagina), $titulo) ?>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<div class="row inbox">
				<div class="col-md-2">
					<ul class="inbox-nav margin-bottom-10">
						<li class="inbox active">
							<a href="<?php echo base_url('painel/contatos') ?>" class="btn" data-title="Inbox">
							Entrada <?php echo mensagem('entrada') ?> </a>
							<b></b>
						</li>
					</ul>
				</div>
				<div class="col-md-10">
					<div class="inbox-header">
						<h1 class="pull-left">Caixa de Entrada</h1>
						<!-- <form class="form-inline pull-right" action="index.html">
							<div class="input-group input-medium">
								<input type="text" class="form-control" placeholder="Busca">
								<span class="input-group-btn">
								<button type="submit" class="btn green"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</form> -->
					</div>
					<div class="inbox-loading">
						 Carregando...
					</div>
					
					<div class="portlet-body">
						<div class="table-responsive">
							<table class="table table-bordered">
							<thead>
							<tr>
								<th>
									 De
								</th>
								<th>
									 Assunto
								</th>
								<th>
									 E-mail
								</th>
								<th>
									 Data
								</th>
							</tr>
							</thead>
							<tbody>
							
							<?php foreach ($conteudos->result() as $conteudo): ?>
							
							<div class="modal fade" id="basic<?php echo $conteudo->idContato ?>" tabindex="-1" role="basic<?php echo $conteudo->idContato ?>" aria-hidden="true">
								<div class="modal-dialog<?php if (substr($conteudo->dsAssunto, 0, 16) == 'Trabalhe Conosco') echo ' modal-lg'; ?>">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title"><?php echo $conteudo->dsAssunto ?></h4>
										</div>
										<div class="modal-body">
											 <?php echo $conteudo->dsMensagem ?>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn default" data-dismiss="modal">Fechar</button>
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							
							
							<tr id="ativo<?php echo $conteudo->idContato ?>status" style="border-top:1px solid #ddd;"<?php if ($conteudo->snLido == 'N') echo ' class="bold"'; ?>>
								<td>
									<?php echo $conteudo->dsNome ?>
								</td>
								<td>
									<a id="click<?php echo $conteudo->idContato ?>" onclick="ativo('idContato', <?php echo $conteudo->idContato ?>, '<?php echo base_url('painel/'. $this->pagina .'/ativo') ?>')" data-toggle="modal" href="#basic<?php echo $conteudo->idContato ?>"><?php echo $conteudo->dsAssunto ?></a>
								</td>
								<td>
									<?php echo $conteudo->dsEmail ?>
								</td>
								<td>
									<?php echo dthr($conteudo->dtContato) ?>
								</td>
							</tr>
							<?php endforeach; ?>
							
							</tbody>
							</table>
						</div>
					</div>
					
					<ul class="pagination pull-right">
					<?php echo $paginacao ?>
					</ul>
					
					<div class="inbox-content">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php $this->load->view('painel/common/footer'); ?>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('assets/global/plugins/respond.min.js') ?>"></script>
<script src="<?php echo base_url('assets/global/plugins/excanvas.min.js') ?>"></script> 
<![endif]-->
<script src="<?php echo base_url('assets/global/plugins/jquery.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js') ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('assets/global/plugins/jquery-ui/jquery-ui.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.cokie.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/uniform/jquery.uniform.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN: Page level plugins -->
<script src="<?php echo base_url('assets/global/plugins/fancybox/source/jquery.fancybox.pack.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') ?>" type="text/javascript"></script>
<!-- END: Page level plugins -->
<script src="<?php echo base_url('assets/global/scripts/metronic.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/layout.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/quick-sidebar.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/demo.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/inbox.js') ?>" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
//QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   //Inbox.init();
<?php if ($this->uri->segment(3) != '') echo '$("#click'.$this->uri->segment(3).'").trigger( "click" );'; ?>
   
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>