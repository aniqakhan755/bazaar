<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- Fonts-->
        <link href="https://fonts.googleapis.com/css?family=<?php echo e(urlencode(theme_option('primary_font', 'Work Sans'))); ?>:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet" type="text/css">
        <!-- CSS Library-->

        <style>
            :root {
                --color-1st: <?php echo e(theme_option('primary_color', '#fcb800')); ?>;
                --color-2nd: <?php echo e(theme_option('secondary_color', '#222222')); ?>;
                --primary-font: '<?php echo e(theme_option('primary_font', 'Work Sans')); ?>', sans-serif;
                --button-text-color: <?php echo e(theme_option('button_text_color', '#000')); ?>;
                --header-text-color: <?php echo e(theme_option('header_text_color', '#000')); ?>;
                --header-text-hover-color: <?php echo e(theme_option('header_text_hover_color', '#fff')); ?>;
                --header-text-accent-color: <?php echo e(theme_option('header_text_accent_color', '#222222')); ?>;
                --header-diliver-border-color: <?php echo e(hex_to_rgba(theme_option('header_text_color', '#000'), 0.15)); ?>;
            }
        </style>

        <?php echo Theme::header(); ?>

    </head>
    <body <?php if(Theme::get('pageId')): ?> id="<?php echo e(Theme::get('pageId')); ?>" <?php endif; ?> <?php if(BaseHelper::siteLanguageDirection() == 'rtl'): ?> dir="rtl" <?php endif; ?>>
        <div id="alert-container"></div>
        <?php
            $categories = !is_plugin_active('ecommerce') ? [] : get_product_categories(['status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED], ['slugable', 'children', 'children.slugable', 'children.children', 'children.children.slugable', 'icon'], [], true);
        ?>

        <?php echo Theme::get('topHeader'); ?>


        <header class="header header--1" data-sticky="<?php echo e(Theme::get('stickyHeader', 'true')); ?>">
            <div class="header__top">
                <div class="ps-container">
                    <div class="header__left">
                        <div class="menu--product-categories">
                            <div class="menu__toggle"><i class="icon-menu"></i><span> <?php echo e(__('Shop by Department')); ?></span></div>
                            <div class="menu__content" style="display: none">
                                <ul class="menu--dropdown">
                                    <?php echo Theme::partial('product-categories-dropdown', compact('categories')); ?>

                                </ul>
                            </div>
                        </div><a class="ps-logo" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(RvMedia::getImageUrl(theme_option('logo'))); ?>" alt="<?php echo e(theme_option('site_title')); ?>" height="40"></a>
                    </div>
                    <?php if(is_plugin_active('ecommerce')): ?>
                        <div class="header__center">
                            <form class="ps-form--quick-search" action="<?php echo e(route('public.products')); ?>" data-ajax-url="<?php echo e(route('public.ajax.search-products')); ?>" method="get">
                                <div class="form-group--icon">
                                    <div class="product-cat-label"><?php echo e(__('All')); ?></div>
                                    <select class="form-control product-category-select" name="categories[]">
                                        <option value="0"><?php echo e(__('All')); ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option class="level-0" value="<?php echo e($category->id); ?>" <?php if(in_array($category->id, request()->input('categories', []))): ?> selected <?php endif; ?>><?php echo e($category->name); ?></option>
                                            <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option class="level-1" value="<?php echo e($childCategory->id); ?>" <?php if(in_array($childCategory->id, request()->input('categories', []))): ?> selected <?php endif; ?>>&nbsp;&nbsp;&nbsp;<?php echo e($childCategory->name); ?></option>
                                                <?php $__currentLoopData = $childCategory->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option class="level-2" value="<?php echo e($item->id); ?>" <?php if(in_array($item->id, request()->input('categories', []))): ?> selected <?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($item->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <input class="form-control" name="q" type="text" placeholder="<?php echo e(__("I'm shopping for...")); ?>" id="input-search">
                                <div class="spinner-icon">
                                    <i class="fa fa-spin fa-spinner"></i>
                                </div>
                                <button type="submit"><?php echo e(__('Search')); ?></button>
                                <div class="ps-panel--search-result"></div>
                            </form>
                        </div>
                        <div class="header__right">
                            <div class="header__actions">
                                <a class="header__extra btn-compare" href="<?php echo e(route('public.compare')); ?>"><i class="icon-chart-bars"></i><span><i><?php echo e(Cart::instance('compare')->count()); ?></i></span></a>
                                <a class="header__extra btn-wishlist" href="<?php echo e(route('public.wishlist')); ?>"><i class="icon-heart"></i><span><i><?php echo e(!auth('customer')->check() ? Cart::instance('wishlist')->count() : auth('customer')->user()->wishlist()->count()); ?></i></span></a>
                                <?php if(EcommerceHelper::isCartEnabled()): ?>
                                    <div class="ps-cart--mini">
                                        <a class="header__extra btn-shopping-cart" href="<?php echo e(route('public.cart')); ?>"><i class="icon-bag2"></i><span><i><?php echo e(Cart::instance('cart')->count()); ?></i></span></a>
                                        <div class="ps-cart--mobile">
                                            <?php echo Theme::partial('cart'); ?>

                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="ps-block--user-header">
                                    <div class="ps-block__left"><i class="icon-user"></i></div>
                                    <div class="ps-block__right">
                                        <?php if(auth('customer')->check()): ?>
                                            <a href="<?php echo e(route('customer.overview')); ?>"><?php echo e(auth('customer')->user()->name); ?></a>
                                            <a href="<?php echo e(route('customer.logout')); ?>"><?php echo e(__('Logout')); ?></a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('customer.login')); ?>"><?php echo e(__('Login')); ?></a><a href="<?php echo e(route('customer.register')); ?>"><?php echo e(__('Register')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="ps-block--user-header">
                                    <div class="ps-block__left"><i class="icon-store"></i></div>
                                    <div class="ps-block__right">
                                        <a class="seller-register-action"  href="<?php echo e(route('vendor.register')); ?>">Become A Seller</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <nav class="navigation">
                <div class="ps-container">
                    <div class="navigation__left">
                        <div class="menu--product-categories">
                            <div class="menu__toggle"><i class="icon-menu"></i><span> <?php echo e(__('Shop by Department')); ?></span></div>
                            <div class="menu__content" style="display: none">
                                <ul class="menu--dropdown">
                                    <?php echo Theme::partial('product-categories-dropdown', compact('categories')); ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="navigation__right">
                        <?php echo Menu::renderMenuLocation('main-menu', [
                            'view'    => 'menu',
                            'options' => ['class' => 'menu'],
                        ]); ?>

                        <?php if(is_plugin_active('ecommerce')): ?>
                            <ul class="navigation__extra">
                                <li><a href="<?php echo e(route('public.orders.tracking')); ?>"><?php echo e(__('Track your order')); ?></a></li>
                                <?php $currencies = get_all_currencies(); ?>
                                <?php if(count($currencies) > 1): ?>
                                    <li>
                                        <div class="ps-dropdown">
                                            <a href="<?php echo e(route('public.change-currency', get_application_currency()->title)); ?>"><span><?php echo e(get_application_currency()->title); ?></span></a>
                                            <ul class="ps-dropdown-menu">
                                                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($currency->id !== get_application_currency_id()): ?>
                                                        <li><a href="<?php echo e(route('public.change-currency', $currency->title)); ?>"><span><?php echo e($currency->title); ?></span></a></li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </header>
        <?php if(Theme::get('headerMobile')): ?>
            <?php echo Theme::get('headerMobile'); ?>

        <?php else: ?>
            <?php echo Theme::partial('header-mobile'); ?>

        <?php endif; ?>
        <?php if(is_plugin_active('ecommerce')): ?>
            <div class="ps-panel--sidebar" id="cart-mobile" style="display: none">
                <div class="ps-panel__header">
                    <h3><?php echo e(__('Shopping Cart')); ?></h3>
                </div>
                <div class="navigation__content">
                    <div class="ps-cart--mobile">
                        <?php echo Theme::partial('cart'); ?>

                    </div>
                </div>
            </div>
            <div class="ps-panel--sidebar" id="navigation-mobile" style="display: none">
                <div class="ps-panel__header">
                    <h3><?php echo e(__('Categories')); ?></h3>
                </div>
                <div class="ps-panel__content">
                    <ul class="menu--mobile">
                        <?php echo Theme::partial('product-categories-dropdown', compact('categories')); ?>

                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <div class="navigation--list">
            <div class="navigation__content">
                <a class="navigation__item ps-toggle--sidebar" href="#menu-mobile"><i class="icon-menu"></i><span> <?php echo e(__('Menu')); ?></span></a>
                <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile"><i class="icon-list4"></i><span> <?php echo e(__('Categories')); ?></span></a>
                <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar"><i class="icon-magnifier"></i><span> <?php echo e(__('Search')); ?></span></a>
                <a class="navigation__item ps-toggle--sidebar" href="#cart-mobile"><i class="icon-bag2"></i><span> <?php echo e(__('Cart')); ?></span></a></div>
        </div>
        <?php if(is_plugin_active('ecommerce')): ?>
            <div class="ps-panel--sidebar" id="search-sidebar" style="display: none">
                <div class="ps-panel__header">
                    <form class="ps-form--search-mobile" action="<?php echo e(route('public.products')); ?>" method="get">
                        <div class="form-group--nest">
                            <input class="form-control" name="q" value="<?php echo e(request()->query('q')); ?>" type="text" placeholder="<?php echo e(__('Search something...')); ?>">
                            <button type="submit"><i class="icon-magnifier"></i></button>
                        </div>
                    </form>
                </div>
                <div class="navigation__content"></div>
            </div>
        <?php endif; ?>
        <div class="ps-panel--sidebar" id="menu-mobile" style="display: none">
            <div class="ps-panel__header">
                <h3><?php echo e(__('Menu')); ?></h3>
            </div>
            <div class="ps-panel__content">
                <?php echo Menu::renderMenuLocation('main-menu', [
                    'view'    => 'menu',
                    'options' => ['class' => 'menu--mobile'],
                ]); ?>

            </div>
        </div>
<?php /**PATH C:\Apache24\htdocs\bazaar\platform/themes/martfury/partials/header.blade.php ENDPATH**/ ?>