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
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>"/>
<!-- END PAGE LEVEL SCRIPTS -->
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
						<?php echo ucfirst($this->uri->segment(3)) ?>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
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
							<form action="<?php echo base_url('painel/'.$this->pagina.'/'.$acaoControl) ?>" id="form_sample_3" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
							<?php if (isset($conteudos[0]->idPagina)) { ?><input name="idPagina" type="hidden" value="<?php echo $conteudos[0]->idPagina; ?>"><?php } ?>
							<?php if (isset($conteudos[0]->snConteudo)) { if ($conteudos[0]->snConteudo == 'N') { ?><input name="dsTitulo" type="hidden" value="<?php echo $conteudos[0]->dsTitulo; ?>"><?php }} ?>
								<div class="form-body">
									
								<?php if (isset($conteudos[0]->snConteudo)) { if ($conteudos[0]->snConteudo == 'S') { ?>
									
									<div class="alert alert-danger display-hide">
										<button class="close" data-close="alert"></button>
										Voc&ecirc; tem alguns erros de formul&aacute;rio. Verifique abaixo.
									</div>
									
									<div class="alert alert-success display-hide">
										<button class="close" data-close="alert"></button>
										Sua valida&ccedil;&atilde;o de formul&aacute;rio &eacute; bem sucedida!
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Titulo <span class="required">
										* </span>
										</label>
										<div class="col-md-6">
											<input value="<?php if (isset($conteudos[0]->dsTitulo)) echo $conteudos[0]->dsTitulo; ?>" type="text" name="dsTitulo" data-required="1" class="form-control"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Descri&ccedil;&atilde;o 
										</label>
										<div class="col-md-9">
											<textarea id="editordspagina" class="ckeditor form-control" name="dsPagina" rows="6" data-error-container="#editor2_error"><?php if (isset($conteudos[0]->dsPagina)) echo $conteudos[0]->dsPagina; ?></textarea>
											<div id="editor2_error">
											</div>
										</div>
									</div>
									
									<?php if (isset($conteudos[0]->snFoto)) { if ($conteudos[0]->snFoto == 'S') { ?>
									<div class="form-group<?php if (isset($conteudos[0]->snSeo)) if ($conteudos[0]->snSeo == 'N') echo ' last'; ?>">
										<label class="control-label col-md-3">Imagem <br><?php echo tamanhoImagem($this->uri->segment(2)) ?></label>
										<div class="col-md-6">
										<input type="file" name="userfile">
											<p class="help-block">
												 gif|jpg|png
											</p>
										</div>
									</div>
									
									<?php if (isset($conteudos[0]->dsImagem)) { if ($conteudos[0]->dsImagem != '') { ?>
									<div id="dsImagem">
										<input name="dsImagem" type="hidden" value="<?php echo $conteudos[0]->dsImagem; ?>">
										<div class="form-group">
											<label class="control-label col-md-3">Preview </label>
											<div class="col-md-9">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="fileupload-new thumbnail" style="width: 200px; height: 152px;">
														<?php echo img(base_url('/assets/files/'. $this->pasta .'/'. $conteudos[0]->dsImagem), '') ?>                                                    
													</div>
													<div>
	                                                    <a onclick="remover_imagem('idPagina', <?php echo $conteudos[0]->idPagina; ?>, '<?php echo base_url('painel/'. $this->pagina .'/remover_imagem') ?>')" href="javascript:;" class="btn red "><i class="fa fa-trash-o"></i> Remover Imagem</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php }} ?>
									<?php }} ?>
									
									<?php if (isset($conteudos[0]->snFile)) { if ($conteudos[0]->snFile == 'S') { ?>
									<div class="form-group<?php if (isset($conteudos[0]->snSeo)) if ($conteudos[0]->snSeo == 'N') echo ' last'; ?>">
										<label class="control-label col-md-3">Arquivo</label>
										<div class="col-md-6">
										<input type="file" name="dsArquivo">
											<p class="help-block">
												doc|docx|pdf
											</p>
										</div>
									</div>
									
									<?php if (isset($conteudos[0]->dsFile)) { if ($conteudos[0]->dsFile != '') { ?>
									<div id="dsFile">
										<input name="dsFile" type="hidden" value="<?php echo $conteudos[0]->dsFile; ?>">
										<div class="form-group">
											<label class="control-label col-md-3">Preview do Arquivo</label>
											<div class="col-md-9">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="fileupload-new thumbnail">
														<a href="<?php echo base_url('/assets/files/'. $this->pasta .'/'. $conteudos[0]->dsFile) ?>" target="_blank"><?php echo base_url('/assets/files/'. $this->pasta .'/'. $conteudos[0]->dsFile) ?></a>                                                   
													</div>
													<div>
	                                                    <a onclick="remover_arquivo('idPagina', <?php echo $conteudos[0]->idPagina; ?>, '<?php echo base_url('painel/'. $this->pagina .'/remover_arquivo') ?>')" href="javascript:;" class="btn red "><i class="fa fa-trash-o"></i> Remover Arquivo</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php }} ?>
									<?php }} ?>															
								
								<?php }} ?>
								
								
								<?php if (isset($conteudos[0]->snSeo)) { if ($conteudos[0]->snSeo == 'S') { ?>
									<h3 class="form-section" style="padding: 30px 0px 10px 10px;margin:0px">Otimiza&ccedil;&atilde;o</h3>
									<div class="form-body">										
										<div class="form-group">
											<label class="control-label col-md-3">Title 
											</label>
											<div class="col-md-6">
												<input value="<?php if (isset($conteudos[0]->dsTitle)) echo $conteudos[0]->dsTitle; ?>" type="text" name="dsTitle" class="form-control"/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Description 
											</label>
											<div class="col-md-9">
												<textarea class="form-control" name="dsDescription" rows="4"><?php if (isset($conteudos[0]->dsDescription)) echo $conteudos[0]->dsDescription; ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Keywords 
											</label>
											<div class="col-md-9">
												<textarea class="form-control" name="dsKeywords" rows="4"><?php if (isset($conteudos[0]->dsKeywords)) echo $conteudos[0]->dsKeywords; ?></textarea>
											</div>
										</div>
									</div>
								<?php }} ?>
									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green"><?php echo ucfirst($this->uri->segment(3)) ?></button>
											<button type="button" class="btn default" onClick="window.location='<?php echo base_url('painel/'. $this->pagina .'/listar/'. $this->session->flashdata('pagina')) ?>';">Cancelar</button>
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
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/jquery-validation/js/additional-methods.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-markdown/lib/markdown.js') ?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<script src="<?php echo base_url('assets/global/scripts/metronic.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/layout.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/quick-sidebar.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/demo.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/form-validation.js') ?>"></script>
<!-- END PAGE LEVEL STYLES -->
<script>
jQuery(document).ready(function() {   
   // initiate layout and plugins
   	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
   	FormValidation.init();

   	CKEDITOR.replace('editordspagina', {
  		"filebrowserImageUploadUrl": "/assets/global/plugins/ckeditor/plugins/imgupload.php"
	});
});


</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>