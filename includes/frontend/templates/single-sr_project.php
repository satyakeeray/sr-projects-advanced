<?php get_header(); ?>

<div class="container project-single">
    
    <!-- Project Title -->
    <h1 class="project-title"><?php the_title(); ?></h1>

    <!-- Project Meta -->
    <div class="project-meta">
        <?php 
            $client_name = get_post_meta( get_the_ID(), 'srpa_client_name', true );
            $status      = get_post_meta( get_the_ID(), 'srpa_project_status', true );
            $budget      = get_post_meta( get_the_ID(), 'srpa_budget', true );
        ?>
        <?php if ( $client_name ) : ?>
            <span class="meta-item"><strong>Client:</strong> <?php echo esc_html( $client_name ); ?></span>
        <?php endif; ?>
        <?php if ( $status ) : ?>
            <span class="meta-item"><strong>Status:</strong> <?php echo esc_html( $status ); ?></span>
        <?php endif; ?>
        <?php if ( $budget ) : ?>
            <span class="meta-item"><strong>Budget:</strong> <?php echo esc_html( $budget ); ?></span>
        <?php endif; ?>
    </div>

    <!-- Project Content -->
    <div class="project-content">
        <?php the_content(); ?>
    </div>

</div>

<?php get_footer(); ?>
