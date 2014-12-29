<?php
/*

  Template Name: Team

*/
?>
<div class="team text-center">
  <div class="entry-header">
    <h1><?php the_title() ?></h1>
  </div>
  <?php
    $team_members = get_field("members");
    shuffle($team_members);
   foreach( $team_members as $member ):
  ?>
  <a href="<?php echo bp_core_get_user_domain($member->ID) ?>">
    <?php echo get_avatar( $member['ID'], 250 ); ?>
  </a>
  <?php endforeach; ?>
</div>
