<ul class="nav nav-tabs">
	<?php foreach($navs as $nav): ?>
		<li<?php echo ($nav['context_slug'] == $subcontext)? ' class="active"': ''; ?>>
			<a <?php echo (isset($nav['context_uri']))? 'href="'.site_url($nav['context_uri']).'"' : ''; ?>><?php echo (lang('chequest:subcontext:'.$nav['context_slug']))? lang('chequest:subcontext:'.$nav['context_slug']) : $nav['context_slug']; ?></a>
		</li>
	<?php endforeach; ?>
</ul>