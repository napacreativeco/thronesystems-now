<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<section class="product-archive">

    <ul class="products">

        <?php
        if ( wc_get_loop_prop( 'total' ) ) {
            while ( have_posts() ) {
                the_post(); ?>        

                <li>
                    <article class="product">
                        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></h2>
                    </article>  
                </li>

            <?php
            }
        }?>

    </ul>

</section>

<?php get_footer(); ?>
   