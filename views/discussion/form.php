<div id="discussion-form">
	<!-- thread form -->
	<div id="thread-form" class="well well-small hide">
		<div class="page-header">
			<h4>Post a thread</h4>
		</div>
		<form action="#" method="post">
			<label for="title">Title</label>
			<input type="text" name="title" class="span4" />
			<label for="title">Post Content</label>
			<textarea name="content" id="thread-content" class="span9" rows="5"></textarea><br>
			<div>
			  <button type="submit" class="btn btn-small btn-primary">Post Thread</button>
			  <button type="button" class="btn btn-small">Cancel</button>
			</div>
		</form>
	</div>

	<!-- topic form -->
	<div id="topic-form" class="well well-small hide">
		<div class="page-header">
			<h4>Create new topic</h4>
		</div>
		<form action="#" method="post">
			<label for="topic-title">Topic Title</label>
			<input type="text" name="topic-title" class="span4" />
			<label for="group">Group</label>
			<select class="span4">
				<option>General</option>
  				<option>PHP</option>
			</select>
			<label for="parent">Parent Topic</label>
			<select class="span4">
				<option>General</option>
  				<option>PHP</option>
			</select>
			<label for="topic-description">Topic Description</label>
			<textarea name="content" id="topic-description" class="span9" rows="3"></textarea><br>
			<div>
			  <button type="submit" class="btn btn-small btn-primary">Create Topic</button>
			  <button type="button" class="btn btn-small">Cancel</button>
			</div>
		</form>
	</div>

	<!-- group form -->
	<div id="group-form" class="well well-small hide">
		<div class="page-header">
			<h4>Create new group</h4>
		</div>
		<form action="#" method="post">
			<label for="topic-title">Group Title</label>
			<input type="text" name="group-title" class="span4" />
			<label for="topic-description">Group Description</label>
			<textarea name="content" id="group-description" class="span9" rows="3"></textarea><br>
			<label for="group-mode">Mode</label>
			<select class="span4">
				<option>Open</option>
				<option>Close</option>
  				<option>Secret</option>
			</select>
			<div>
			  <button type="submit" class="btn btn-small btn-primary">Create Group</button>
			  <button type="button" class="btn btn-small">Cancel</button>
			</div>
		</form>
	</div>
</div>