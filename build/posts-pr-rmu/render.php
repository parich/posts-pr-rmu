<!-- file: src/posts-pr-rmu/render.php -->
<?php
// ตรวจสอบ option ซ่อน input search
$hide_input = get_option('posts_pr_rmu_hide_input', false);
?>

<div class="our-search">
	<?php if (!$hide_input): ?>
		<input type="text" id="search" placeholder="ค้นหาโพสต์กลุ่มงานประชาสัมพันธ์" />
	<?php endif; ?>
	<div class="results"></div>
</div>