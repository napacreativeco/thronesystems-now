<?php wp_head(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THRONE.SYSTEMS</title>
    <link href="<?php echo get_template_directory_uri() . '/assets/favicon.ico'; ?>" rel="icon" type="image/x-icon" />


    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
</head>

<body>

<header>
    <div class="header--row">
        <div class="site-title">
            <span class="throne-grotesk">THRONE</span>
        </div>

        <div class="site-links">
            <nav>
                <ul id="navbar">
                    <?php
                    $menu_items = wp_get_nav_menu_items('main-menu');
                    foreach ($menu_items as $item) { ?>
                        <li>
                            <a class="navbar-link" href="<?php  echo  '' . $item->url . '' ?>" title="<?php  echo  '' . $item->title . '' ?>">
                                <?php  echo  '' . $item->title . '' ?>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a class="cart-link" href="/cart" title="Cart">Cart (<?php echo WC()->cart->get_cart_contents_count(); ?>)</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>