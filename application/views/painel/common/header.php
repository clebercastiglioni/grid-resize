<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="<?php echo base_url('painel/inicio') ?>">
			<img src="<?php echo base_url('assets/admin/layout/img/logo.png') ?>" alt="" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN INBOX DROPDOWN -->
				<?php echo mensagem('topo') ?>
				<!-- END INBOX DROPDOWN -->
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<?php if ($this->session->userdata('painel_dsImagem') != '') { ?><img alt="" class="img-circle" src="<?php echo base_url('Thumbs/files/usuarios/p/29/29/r/'. $this->session->userdata('painel_dsImagem')) ?>"/><?php } ?>
					<span class="username username-hide-on-mobile">
					<?php echo $this->session->userdata('painel_dsNome') ?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="<?php echo base_url('painel/usuarios/editar/'. $this->session->userdata('painel_idUsuario')) ?>">
							<i class="icon-user"></i> Minha conta </a>
						</li>
						<li>
							<a href="<?php echo base_url('painel/login/sair') ?>">
							<i class="icon-key"></i> Sair </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>