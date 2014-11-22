<?php
/*

  Template Name: Team

*/
?>
<div class="team">
  <div class="page-header">
    <h1><?php the_title() ?></h1>
  </div>
  <?php
    $team_members_ids = array(9,6,29,28,12,7,19,14,5,25);
    $args = array(
    	'include'      => $team_members_ids,
    	'exclude'      => array(),
    	'orderby'      => 'login',
    	'order'        => 'ASC',
    	'offset'       => '',
    	'search'       => '',
    	'number'       => '',
    	'count_total'  => false,
    	'fields'       => 'all',
    	'who'          => ''
   );
   $team_members = get_users( $args );

   foreach( $team_members as $member ):
  ?>
  <div class="media">
    <a class="media-left pull-left" href="#">
      <?php echo get_avatar( $member->ID, 150 ); ?>
    </a>
    <div class="media-body">
      <h4 class="media-heading"><?php echo $member->display_name ?></h4>
      <p><?php the_author_meta('user_description', $member->ID) ?></p>
    </div>
  </div>
  <?php endforeach; ?>
</div>
