<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php $this->load->view('site/common/_head'); ?>
    </head>
    <body>
        <?php //$this->load->view('site/common/_header'); ?>
        
		<?php //$this->load->view('site/common/_footer'); ?>

		<style>
			.row > div{
				height: 100px;
				background-color: white;
				border: 2px solid black;
				font-size: 50px;
				line-height: 100px;
			}
		</style>

		<section class="row">
			<div class="s-12 m-24 l-12">l-12</div>
			<div class="s-12 m-24 l-12">l-12</div>

			<div class="s-12 m-24 l-6">l-6</div>
			<div class="s-12 m-24 l-6">l-6</div>
			<div class="s-24 m-24 l-6">l-6</div>
			<div class="s-24 m-24 l-6">l-6</div>
		</section>
	</body>
</html>