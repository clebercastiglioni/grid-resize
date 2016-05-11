<ol id="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
	<?php for ($i=0; $i < sizeof($breadcrumbs); $i++): ?>
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		<a itemprop="item" href="<?php echo $breadcrumbs[$i]['url'] ?>">
			<span itemprop="name"><?php echo $breadcrumbs[$i]['name'] ?></span>
		</a>
		<meta itemprop="position" content="<?php echo ($i + 1) ?>" />
	</li>
	<?php endfor; ?>
</ol>