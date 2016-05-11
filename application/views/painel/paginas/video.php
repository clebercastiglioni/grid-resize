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
<link href="<?php echo base_url('assets/global/plugins/fancybox/source/jquery.fancybox.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/pages/css/portfolio.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/dropzone/css/dropzone.css') ?>" rel="stylesheet"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url('assets/global/css/components.css') ?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/css/plugins.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/layout.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/themes/darkblue.css') ?>" id="style_color" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
<style>
.portlet-title {
	margin-bottom: 6px;
}
</style>
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
							 Deseja excluir o v&iacute;deo?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue" data-dismiss="modal" onClick="excluir('idImg', $('#id').text(), '<?php echo base_url('painel/'. $this->pagina .'/img_excluir') ?>')">Continuar</button>
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
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<?php echo anchor(base_url('painel/'. $this->pagina .'/editar/'. $id_galeria), $galeria) ?>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<?php echo anchor(base_url('painel/'. $this->pagina .'/video/'. $id_galeria), 'V&iacute;deos') ?>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="tabbable-line boxless">
					
						<div class="portlet-title">
							<div id="btnAdd" class="caption">
								&nbsp;<i class="fa fa-youtube"></i>&nbsp; <a href="javascript:;" onClick="foto('add')">Adicionar v&iacute;deo</a>
							</div>
							<div id="btnBack" style="display: none" class="caption">
								&nbsp;<i class="fa fa-chevron-left"></i>&nbsp; <a href="<?php echo base_url('painel/'. $this->pagina .'/video/'. $id_galeria) ?>">Voltar</a>
							</div>
						</div>
					
						<div class="tab-content">
						
							<div class="tab-pane active" id="tab_1">
								<!-- BEGIN FILTER -->
								
								<div id="add" style="display:none">
									<div class="row">
										<div class="col-md-12">
											<!-- BEGIN VALIDATION STATES-->
											<div class="portlet box green">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-gift"></i><?php echo ucfirst($this->uri->segment(3)) ?>
													</div>
												</div>
												<div class="portlet-body form">
													<!-- BEGIN FORM-->
													<form action="<?php echo base_url('painel/'. $this->pagina .'/video_salvar/'. $id_galeria) ?>" id="form_sample_3" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
														<div class="form-body">
															
															<div class="alert alert-danger display-hide">
																<button class="close" data-close="alert"></button>
																Voc&ecirc; tem alguns erros de formul&aacute;rio. Verifique abaixo.
															</div>
															
															<div class="alert alert-success display-hide">
																<button class="close" data-close="alert"></button>
																Sua valida&ccedil;&atilde;o de formul&aacute;rio &eacute; bem sucedida!
															</div>
															
															<div class="form-group">
																<label class="control-label col-md-3">V&iacute;deo <span class="required">
																* </span>
																</label>
																<div class="col-md-6">
																	<input type="text" name="dsImagem" data-required="1" class="form-control"/>
																	<span class="help-block">ex://www.youtube.com/v/<b>zKOubVELVsNw</b></span>
																</div>
															</div>

														</div>
														<div class="form-actions">
															<div class="row">
																<div class="col-md-offset-3 col-md-9">
																	<button type="submit" class="btn green">Salvar</button>
																	<button type="button" class="btn default" onClick="window.location='<?php echo base_url('painel/'. $this->pagina .'/video/'. $id_galeria) ?>';">Cancelar</button>
																</div>
															</div>
														</div>
													</form>
													<!-- END FORM-->
												</div>
												<!-- END VALIDATION STATES-->
											</div>
										</div>
									</div>
								</div>
								
								<div id="list" class="margin-top-10">
									<div class="row mix-grid">
									<?php foreach ($conteudos->result() as $conteudo): ?>
										<div id="row<?php echo $conteudo->idImg ?>" class="col-md-3 col-sm-4 category_1">
											<div class="mix-inner">
												<iframe id="hashtag<?php echo $conteudo->idImg ?>" style="border: 5px solid #<?php if ($conteudo->snAtivo == 'S') echo '1caf9a'; else echo 'D90000'; ?>" width="250" height="180" src="//www.youtube.com/embed/<?php echo substr($conteudo->dsImagem, 0, -4) ?>" frameborder="0" allowfullscreen></iframe>
											</div>
											<div align="right">
												<a id="hashtag<?php echo $conteudo->idImg ?>title" class="btn default btn-xs black" title="<?php if ($conteudo->snAtivo == 'S') echo 'Ativo'; else echo 'Inativo'; ?>" href="javascript:;" onclick="ativo('idImg', <?php echo $conteudo->idImg ?>, '<?php echo base_url('painel/'. $this->pagina .'/img_alterar') ?>')">
												<i id="hashtag<?php echo $conteudo->idImg ?>status" class="fa fa-<?php if ($conteudo->snAtivo == 'S') echo 'check'; else echo 'ban'; ?>"></i> </a>
												
												<a class="btn default btn-xs black" title="Deletar" href="#excluir" data-toggle="modal" onClick="$('#id').text('<?php echo $conteudo->idImg; ?>')">
												<i class="fa fa-trash-o"></i> </a>
											</div>										
										</div>
									<?php endforeach; ?>
									</div>
								</div>
								<!-- END FILTER -->
							</div>
							
						</div>
					</div>
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
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/jquery-mixitup/jquery.mixitup.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/fancybox/source/jquery.fancybox.pack.js') ?>"></script>
<script src="<?php echo base_url('assets/global/plugins/dropzone/dropzone.js') ?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('assets/global/scripts/metronic.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/layout.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/quick-sidebar.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/demo.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/portfolio.js') ?>"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/form-dropzone.js') ?>"></script>
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   Portfolio.init();
   FormDropzone.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>