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
<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/select2/select2.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css') ?>"/>
<!-- END PLUGINS USED BY X-EDITABLE -->
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
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
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
			<!-- 
			<div class="row">
				<div class="col-md-12">
					<label><input type="checkbox" id="autoopen">&nbsp;Auto-open next field</label>
					<label><input type="checkbox" id="inline">&nbsp;Inline editing</label>
					<button id="enable" class="btn blue">Enable / Disable</button>
					<hr>
				</div>
			</div> -->
			<div class="row">
				<div class="col-md-12">
					<table id="user" class="table table-bordered table-striped">
					<tbody>
					<?php foreach ($conteudos->result() as $conteudo): ?>
					<tr>
						<td style="width:15%">
							<?php echo $conteudo->dsTitulo ?>
						</td>
						<td style="width:50%"><?php
						
						if ($conteudo->tpConfig == 'TEXT')
							echo '<a href="javascript:;" id="dsConteudo'. $conteudo->idConfig .'" data-type="textarea" data-pk="1" data-placeholder="" data-original-title="'. $conteudo->dsTitulo .'">';
						elseif ($conteudo->tpConfig == 'ENUM')
							echo '<a href="javascript:;" id="dsConteudo'. $conteudo->idConfig .'" data-type="select" data-pk="1" data-value="5" data-source="/groups" data-original-title="">';
						else
							echo '<a href="javascript:;" id="dsConteudo'. $conteudo->idConfig .'" data-type="text" data-pk="1" data-original-title="'. $conteudo->dsTitulo .'">';

						if ($conteudo->tpConfig == 'ENUM') {
							/*echo $conteudo->dsConteudo;*/
							if ($conteudo->dsConteudo == 'S') {
								echo 'Sim';
							} else {
								echo 'N&atilde;o';
							}										
						} elseif ($conteudo->tpConfig == 'TEXT') {
							if ($conteudo->dsConteudo != '') {

								if ($conteudo->dsConfig == 'ANALYTICS')
									$pre = '';
								else
									$pre = 'white-space: nowrap;';
								
								if ($conteudo->snCodigo == 'S')
									echo '<pre style="width: 520px;font-size: 11px;'.$pre.'">'. str_replace("<script>", "&lt;script&gt;", str_replace("</script>", "&lt;/script&gt;", str_replace("<iframe", "&lt;iframe", str_replace("</iframe>", "&lt;/iframe&gt;", $conteudo->dsConteudo)))).'</pre>';
								else
									echo $conteudo->dsConteudo;									

							} else echo '';
						} elseif ($conteudo->tpConfig == 'VARCHAR') {
							echo $conteudo->dsConteudo;
						}
						
						echo '</a>';
						?></td>
						<td style="width:35%"> 
							<span class="text-muted"><?php echo $conteudo->dsObservacao ?></span>
						</td>
					</tr>
					<?php endforeach; ?>					
					</tbody>
					</table>
				</div>
			</div>
			<!-- 
			<div class="row">
				<div class="col-md-12">
					<h3>Console <small>(all ajax requests here are emulated)</small></h3>
					<div>
						<textarea id="console" rows="8" style="width: 70%" class="form-control"></textarea>
					</div>
				</div>
			</div>
			-->
			<!-- END PAGE CONTENT -->
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
<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/moment.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/jquery.mockjax.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-editable/inputs-ext/address/address.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js') ?>"></script>
<!-- END X-EDITABLE PLUGIN -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('assets/global/scripts/metronic.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/layout.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/quick-sidebar.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/demo.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/form-editable.js') ?>"></script>
<script>
jQuery(document).ready(function() {
// initiate layout and plugins
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
FormEditable.init();
<?php foreach ($conteudos->result() as $conteudo): ?>
$('#dsConteudo<?php echo $conteudo->idConfig ?>').editable({
    url: '<?php echo base_url('painel/'. $this->pagina .'/alterar/'. $conteudo->idConfig) ?>',
    type: 'text',
    //pk: 1,
    //name: 'dsConteudo<?php echo $conteudo->idConfig ?>',
    //value: '<?php //echo $conteudo->dsConteudo ?>',
    title: '<?php echo $conteudo->dsTitulo ?>'
});
<?php endforeach; ?>
});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
<!-- END BODY -->
</html>