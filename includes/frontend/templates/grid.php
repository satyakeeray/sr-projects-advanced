<article <?php post_class( 'srpa-item srpa-grid-item' ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="srpa-grid-thumb">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( '' ); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="srpa-grid-content">
        <h3 class="srpa-grid-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>

        <a href="<?php the_permalink(); ?>" class="srpa-grid-btn">
            View Project →
        </a>
    </div>

</article>
