<ul class="nav nav-tabs">
	<?php foreach($navs as $nav): ?>
		<li<?php echo ($nav->context_slug == $subcontext)? ' class="active"': ''; ?>><a href="<?php echo site_url('chequest/'.$nav->context_slug); ?>"><?php echo (lang('chequest:context:'.$nav->context_slug))? lang('chequest:context:'.$nav->context_slug) : $nav->context_slug; ?></a></li>
	<?php endforeach; ?>
</ul>