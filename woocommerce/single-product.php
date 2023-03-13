<?php
// Single Product

get_header( 'shop' ); ?>

<?php global $product; ?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>

    <article class="single-product">

        <div class="row">

            <!--
            // Gallery
            -->
            <div class="gallery">

                <div class="product-slideshow">

                    <?php $attachment_ids = $product->get_gallery_image_ids(); ?>

                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php foreach( $attachment_ids as $attachment_id ) { ?>
                                <div class="swiper-slide">
                                    <?php
                                    $price = $product->get_price();
                                    if ($price < 1) { ?>
                                        <img class="free-sticker" src="/wp-content/themes/throne-systems/assets/free-sticker.png" alt="" />
                                    <?php } ?>

                                    <img src="<?php echo wp_get_attachment_url( $attachment_id ); ?>">

                                </div>
                            <?php } ?>
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>

            </div>

            <!--
            // Details
            -->
            <div class="details">

                <div class="wrapper">

                    <!--
                    // Upper
                    -->
                    <div class="upper">

                        <div class="title">
                            <h1><?php the_title(); ?></h1>
                            <p><?php get_the_tags(); ?></p>
                        </div>

                        <div class="excerpt">
                            <p><?php the_excerpt(); ?></p>
                        </div>

                        <div class="content">
                            <p><?php the_content(); ?></p>
                        </div>

                        <div class="floater--top-right-rotated">
                            <p>About</p>
                        </div>

                    </div>
                

                    <!--
                    // Lower
                    -->
                    <div class="lower">


                        <!--
                        // Accordion
                        -->
                        <div class="accordion-wrapper">
                            <details class="accorian">
                                <summary>Formats</summary>
                                <span><?php the_field('plugin_formats'); ?></span>
                            </details>

                            <details class="accorian">
                                <summary>Version</summary>
                                <span><?php the_field('plugin_version'); ?></span>
                            </details>

                            <details class="accordion">
                                <summary>Testing</summary>
                                <span><?php the_field('plugin_was_tested_on'); ?></span>
                            </details>
                        </div>

                        <!--
                        // Pricing
                        -->
                        <div class="pricing">
                            <!--  Price -->
                            <div class="price">
                                <?php
                                $price = $product->get_price();
                                if ($price < 1) { ?>
                                    <p>FREE</p>
                                <?php } else { ?>
                                    <p>$<?php echo $product->get_price(); ?></p>
                                <?php } ?>
                            </div>

                            <!-- Add To Cart -->
                            <div class="add-to-cart">
                                <?php 
                                echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="add-to-cart--button button %s product_type_%s">%s</a>',
                                    esc_url( $product->add_to_cart_url() ),
                                    esc_attr( $product->get_id() ),
                                    esc_attr( $product->get_sku() ),
                                    $product->is_purchasable() ? 'add_to_cart_button' : '',
                                    esc_attr( $product->get_type() ),
                                    esc_html( $product->add_to_cart_text() )
                                ), $product );
                                ?>
                            </div>

                        </div>


                        <div class="floater--top-left">
                            <p>Details</p>
                        </div>

                    </div>


                </div>

            </div>

        </div>

    </article>

<?php endwhile; ?>

<?php get_footer(); ?>

<script type="module">
    import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.esm.browser.min.js'

    const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
    });
</script>