<?php
/*

  Template Name: Team

*/
?>
<div class="team">
  <div class="entry-header">
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
  <a href="<?php echo bp_core_get_user_domain($member->ID) ?>">
    <?php echo get_avatar( $member->ID, 250 ); ?>
  </a>
  <?php endforeach; ?>
</div>
