<h2>Forum</h2>
<div class="btn-group pull-right">
	<a href="#" class="btn btn-small btn-primary">Write Thread</a> 
	<a href="#" class="btn btn-small btn-primary">Create Topic</a> 
	<a href="#" class="btn btn-small btn-primary">Create Group</a> 
</div>

<div class="tabbable">
	<?php echo $template['partials']['subcontext']; ?>
	<div class="tab-content">
		<div class="page-header">
			<h4>Newest Threads <small class="pull-right"><a>See more</a></small></h4>
		</div>
		<div id="threads">
		<?php if(count($threads)>0): ?>
			<?php foreach($threads as $thread): ?>
			<div class="well">
				<a href="#" class="thumbnail group-icon">
					<img data-src="holder.js/100x100" alt="">
				</a>
			</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p>There's no any thread yet. Create <a>some</a>.</p>
		<?php endif; ?>
		</div>

		<!-- topics -->
		<div class="page-header">
			<h4>Recently Updated Topics <small class="pull-right"><a>See more</a></small></h4>
		</div>
		<div id="topics">
		<?php if(count($topics)>0): ?>
			<?php foreach($topics as $topic): ?>
			<div class="well">
				<strong><a href="<?php echo site_url('topic/'.$topic->topic_slug); ?>"><?php echo $topic->topic_title; ?></a></strong>
				<small>in <?php echo $topic->group_title; ?> group</small>
				<small class="pull-right"><?php echo ($topic->count_topic_threads > 0)? $topic->count_topic_threads.' thread(s) inside': "0 thread"; ?> </small>
			</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p>There's no any topic yet. Create <a>some</a>.</p>
		<?php endif; ?>
		</div>

		<!-- groups -->
		<div class="page-header">
			<h4>Recently Active Groups <small class="pull-right"><a>See all</a></small></h4>
		</div>
		<div id="groups">
		<?php if(count($topics)>0): ?>
			<?php foreach($groups as $group): ?>
			<div class="pull-left thumbnail group-icon">
				<a href="<?php echo site_url('group/'.$group->group_slug); ?>">
					<img data-src="holder.js/160x100" alt=""><br>
					<?php echo $group->group_title; ?>
				</a>
			</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p>There's no any group yet. Create <a>some</a>.</p>
		<?php endif; ?>
		</div>
		<div class="clearfix"></div>

	</div>
</div>
