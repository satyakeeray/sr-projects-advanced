<article <?php post_class( 'srpa-item srpa-list-item' ); ?>>
    
    <div class="srpa-card">

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="srpa-thumb">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'medium_large' ); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="srpa-content">
            <h3 class="srpa-title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>

            <div class="srpa-excerpt">
                <?php the_excerpt(); ?>
            </div>

            <div class="srpa-actions">
                <a class="srpa-view-btn" href="<?php the_permalink(); ?>">
                    View More →
                </a>
            </div>
        </div>

    </div>

</article>

