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
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/select2/select2.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') ?>"/>
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
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Confirma&ccedil;&atilde;o</h4>
						</div>
						<div class="modal-body">
							 Deseja excluir o conte&uacute;do?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue" data-dismiss="modal" onClick="excluir('idPagina', $('#id').text(), '<?php echo base_url('painel/'. $this->pagina .'/excluir') ?>')">Continuar</button>
							<button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<?php echo $titulo ?> <small></small>
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
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box grey-cascade" style="border: 0px;">
						<div class="portlet-body" style="padding: 0px;">							
							<table class="table table-striped table-bordered table-hover" id="sample_1">
								<thead>
									<tr>
										<th>
											 Titulo
										</th>
										<th style="width:200px;text-align:center">
											 Op&ccedil;&otilde;es
										</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($conteudos->result() as $conteudo): ?>
									<tr id="row<?php echo $conteudo->idPagina ?>" class="odd gradeX">
										<td>
									 		<?php echo anchor(base_url('painel/' .$this->pagina .'/editar/'. $conteudo->idPagina), $conteudo->dsTitulo) ?>
										</td>
										<td style="text-align:center">
										
										<?php if ($conteudo->snGaleria == 'S') { ?>
											<a href="<?php echo base_url('painel/'. $this->pagina .'/img/'. $conteudo->idPagina) ?>" class="btn default btn-xs blue" title="Fotos">
											<i class="fa fa-image"></i> Fotos</a>
										<?php } ?>
										
										<?php if ($conteudo->snVideo == 'S') { ?>
											<a href="<?php echo base_url('painel/'. $this->pagina .'/video/'. $conteudo->idPagina) ?>" class="btn default btn-xs green" title="Videos">
											<i class="fa fa-youtube-play"></i> V&iacute;deos</a>
										<?php } ?>
										
											<a href="<?php echo base_url('painel/'. $this->pagina .'/editar/'. $conteudo->idPagina) ?>" class="btn default btn-xs purple" title="Editar">
											<i class="fa fa-edit"></i> </a>
											
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') ?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('assets/global/scripts/metronic.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/layout.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/quick-sidebar.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/demo.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/table-managed.js') ?>"></script>
<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   TableManaged.init();
});
</script>
</body>
<!-- END BODY -->
</html>