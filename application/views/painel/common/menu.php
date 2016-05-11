<?php $menu = $this->uri->segment(2); ?>
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					&ensp;
				</li>
				
				<li class="start<?php if ($menu == 'inicio') echo ' active open'; ?>">
					<a href="<?php echo base_url('painel/inicio') ?>">					
					<i class="icon-home"></i>
					<span class="title">In&iacute;cio</span>
					<?php if ($menu == 'inicio') echo '<span class="selected"></span>'; ?>
					<!-- <span class="arrow<?php if ($menu == 'inicio') echo ' open'; ?>"></span> -->
					</a>
				</li>
				
				<li<?php if ($menu == 'banners' or $menu == 'contatos' or $menu == 'newsletter' or $menu == 'paginas') echo ' class="active open"'; ?>>
					<a href="javascript:;">
					<i class="icon-docs"></i>
					<span class="title">Conte&uacute;dos</span>
					<span class="arrow<?php if ($menu == 'banners' or $menu == 'contatos' or $menu == 'newsletter' or $menu == 'paginas') echo ' open'; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li<?php if ($menu == 'banners') echo ' class="active"'; ?>>
							<a href="<?php echo base_url('painel/banners') ?>">
							<i class="icon-link"></i>
							Banners</a>
						</li>
						<li<?php if ($menu == 'contatos') echo ' class="active"'; ?>>
							<a href="<?php echo base_url('painel/contatos') ?>">
							<i class="icon-envelope"></i>
							<?php echo mensagem('menu') ?>Mensagens</a>
						</li>
						<li<?php if ($menu == 'newsletter') echo ' class="active"'; ?>>
							<a href="<?php echo base_url('painel/newsletter') ?>">
							<i class="icon-users"></i>
							Newsletter</a>
						</li>
						<li<?php if ($menu == 'paginas') echo ' class="active"'; ?>>
							<a href="<?php echo base_url('painel/paginas') ?>">
							<i class="icon-doc"></i>
							P&aacute;ginas</a>
						</li>
					</ul>
				</li>
				
				<li<?php if ($menu == 'configuracoes' or  $menu == 'usuarios') echo ' class="active open"'; ?>>
					<a href="javascript:;">
					<i class="icon-settings"></i>
					<span class="title">Administra&ccedil;&atilde;o</span>
					<span class="arrow<?php if ($menu == 'configuracoes' or $menu == 'usuarios') echo ' open'; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li<?php if ($menu == 'configuracoes') echo ' class="active"'; ?>>
							<a href="<?php echo base_url('painel/configuracoes') ?>">
							<i class="icon-settings"></i>
							Configura&ccedil;&otilde;es</a>
						</li>
						<li<?php if ($menu == 'usuarios') echo ' class="active"'; ?>>
							<a href="<?php echo base_url('painel/usuarios') ?>">
							<i class="icon-user"></i>
							Usu&aacute;rios</a>
						</li>
					</ul>
				</li>

			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>