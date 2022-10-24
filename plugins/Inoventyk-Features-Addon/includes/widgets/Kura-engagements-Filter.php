<?php

/**
 * File containing the class Kura_Elementor_addon.
 *
 * @package wp-job-manager
 * @since   1.33.0
 */

namespace INO_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('Kura_Engagements_Filter')) {
	class Kura_Engagements_Filter  extends \Elementor\Widget_Base
	{

		private $ksettings = null;


		public function get_name()
		{
			return 'Kura Engagements Filter';
		}

		public function get_title()
		{
			return esc_html__('kuraEngagementsFilter', 'kura');
		}

		public function get_icon()
		{
			return 'eicon-code';
		}

		public function get_categories()
		{
			return ['basic'];
		}


		/**
		 * Render widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @since 1.0.1
		 * @access protected
		 */
		protected function render()
		{
			$tabId = array('all');
			$tabIndex = null;

			$args = array(
				'posts_per_page'	=>  -1,
			);

			$JsonData = new \INO_FEATURES\kura_Json('engagement');

			if ($this->ksettings)
				$args = array_merge($args, $this->ksettings);

			$taxonomies = json_decode($JsonData->kuraTermsJson('engagement'), true); ?>
			<div class="kura-engagement-section">
				<div class="container">
					<div class="row">
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
							</li>
							<?php
							foreach ($taxonomies as $key => $cat) {

								$cat_post  = json_decode($JsonData->kuraPostsJson($args, $cat['cat_id'], 'engagement'));
								if (!$cat_post) continue;
								array_push($tabId, array($cat['cat_id'], $key)); ?>
								<li class="nav-item">
									<a class="nav-link" id="<?php echo $key ?>-tab" data-bs-toggle="pill" data-bs-target="#<?php echo $key ?>" role="tab" aria-controls="<?php echo $key ?>" aria-selected="false"><?php echo $cat['cat_name']; ?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="tab-content  mt-2 mb-3" id="pills-tabContent">
					<?php foreach ($tabId as $pcat) {
						if (is_array($pcat)) {
							$catId = $pcat;
							$posts = json_decode($JsonData->kuraPostsJson($args, $catId[0], 'engagement'), true);
							$tabIndex = $pcat[1];
						} else {
							$posts = json_decode($JsonData->kuraPostsJson($args), true);
							$tabIndex = $pcat;
						}

						// print_r($args); 
					?>

						<div class="tab-pane show " id="<?php echo $tabIndex; ?>" role="tabpanel" aria-labelledby="<?php echo $tabIndex; ?>-tab">

							<div class="kura-masonry">
								<?php
								// The Loop
								if ($posts) {
									foreach ($posts as $post) { ?>

										<div class="kura-masonry-item">
											<div class="card light-gray-bg">
												<img src="<?php echo $post['thumbnail']; ?>" alt="<?php echo $post['title']; ?>" class="img-fluid">
												<div class="content-wrapper p-4">
													<p class="date font-text">
														<?php echo '<span class="span-red font-weight-bold">Starting: </span>' . $post['starting-date'] . ' | <span class="span-red font-weight-bold">Duration: </span> ' . $post['duration']; ?>
													</p>
													<h3 class="font-secondary"><?php echo $post['company']; ?></h3>
													<p class="location font-small"><?php echo $post['location']; ?></p>
													<p class="description font-text">
														<?php echo $post['descr']; ?>
													</p>
													<a href="<?php echo $post['engagement-link']; ?>" class="stretched-link btn btn-primary">Apply</a>
												</div>
											</div>
										</div>


								<?php
									}
								}

								?>
							</div>
						</div>
					<?php } ?>
					<script>
						var activebtn = document.getElementById('all');
						activebtn.classList.add("active");
					</script>
				</div>
			</div>
<?php }
	}
} // End if class_exists check.
