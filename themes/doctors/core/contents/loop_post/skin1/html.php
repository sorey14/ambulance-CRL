<!--<div id="post---><?php //the_ID(); ?><!--" --><?php //post_class('tally_loop_post'); ?><!-->-->
<!--	<div class="tlp_inner">-->
<!--    	<div class="tlp_header ">-->
    	<div class="featured-post">

            <figure class="featured-image">
                <a href="<?php the_permalink(); ?>">
                    <div class="featured-overlay">
                        <span class="overlay-plus font-icon-plus"></span>
                    </div>
                    <img src="<?php the_post_thumbnail()?>">
                </a>
            </figure>

            <h4 class="">
                <a href="<?php the_permalink(); ?>">
                    <span><?php the_title(); ?></span>
                </a>
            </h4>

            <div class="featured-content">
                <p><?php the_excerpt()?></p>
                <a href="<?php the_permalink(); ?>" class="tlp_more"><?php _e('Read More', 'doctors'); ?></a>
             </div>

<!--        	<h4><a href="--><?php //the_permalink(); ?><!--">--><?php //the_title(); ?><!--</a></h4>-->
<!--            <p>--><?php //_e('By', 'doctors') ?><!-- --><?php //the_author_posts_link(); ?><!-- &bull; --><?php //the_date(); ?><!-- &bull; -->
<!--                --><?php //comments_popup_link(__('No Comments', 'doctors'), __('1 Comment', 'doctors'), '% '.__('Comments', 'doctors')); ?><!--</p>-->
<!--            -->
<!---->
<!---->
<!--            --><?php
//				if( (get_post_format() == 'video') && ( tally_get_first_embed_media(get_the_ID()) != false)){
//					echo '<div style="margin-bottom:30px;">';
//						echo tally_get_first_embed_media(get_the_ID());
//					echo '</div>';
//				}elseif( (get_post_format() == 'audio') && ( tally_get_first_embed_media(get_the_ID(), 'audio') != false)){
//					echo '<div style="margin-bottom:30px;">';
//						echo tally_get_first_embed_media(get_the_ID(), 'audio');
//					echo '</div>';
//				}else{
//					the_post_thumbnail('tally_blog');
//				}
//			?>
        </div>


<!--        <div class="tlp_content">-->
<!--        	--><?php //the_excerpt(); ?>
<!--        </div>-->
<!--        <div class="tlp_footer">-->
<!--        	<a href="--><?php //the_permalink(); ?><!--" class="tlp_more">--><?php //_e('Read More', 'doctors'); ?><!--</a>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


