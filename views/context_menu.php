<ul class="nav nav-tabs">
	<li<?php echo ('profile' == $context)? ' class="active"': ''; ?>>
		<a href="<?php echo site_url('chequest/profile'); ?>" title="<?php echo $this->current_user->username; ?>">
			<span class="main-avatar">
				<?php echo isset($this->current_user->avatar)? "<img src='".$this->current_user->avatar."' />" : ''; ?>
			</span>
		</a>
	</li>
	<?php foreach($navs as $nav): ?>
		<li<?php echo ($nav->context_slug == $context)? ' class="active"': ''; ?>><a href="<?php echo site_url('chequest/'.$nav->context_slug); ?>"><?php echo (lang('chequest:context:'.$nav->context_slug))? lang('chequest:context:'.$nav->context_slug) : $nav->context_slug; ?></a></li>
	<?php endforeach; ?>
</ul>