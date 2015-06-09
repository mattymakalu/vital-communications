<div class="item <?php if(get_field("enlarged_listing_item")): echo 'w2'; endif; ?>">
    <div class="item-card">
        <a href="<?php the_permalink(); ?>">
            <div class="item-card--img">
				                <?php if ( has_post_thumbnail() ) { 		the_post_thumbnail();
   }?>
            </div>

            <div class="item-card--body">
                <h2><?php echo get_the_title(); ?></h2>
                <?php the_excerpt(); ?>
            </div>

            <div class="item-card--footer">
                <p class="item-card--date"><?php the_date(); ?></p>
            </div>
        </a>
    </div>
</div>