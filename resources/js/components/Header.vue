<template>
    <header class="header-section">
        <div class="header-top">
            <div class="container flex flex-row justify-around">
                <div class="flex flex-row">
                    <div class="py-4 pr-5 line-space-right">
                        <font-awesome-icon :icon="['fas', 'envelope']" />
                        ndviet.dev@gmail.com
                    </div>
                    <div class="py-4 pl-5">
                        <font-awesome-icon :icon="['fas', 'phone']" />
                        +84 3456.940.88
                    </div>
                </div>
                <div class="items-end flex py-4">
                    <div class="top-social line-space-right pr-5 gap-2 flex">
                        <a href="#"><font-awesome-icon :icon="['fab', 'facebook']" /></a>
                        <a href="https://github.com/ndviet0303"><font-awesome-icon :icon="['fab', 'github']" /></a>
                        <a href="https://t.me/+84345694088"><font-awesome-icon :icon="['fab', 'telegram']" /></a>
                    </div>
                    <a href="#" class="login-panel pl-5 flex gap-2 items-center line-space-right pr-5"><font-awesome-icon :icon="['fas', 'user']" />Đăng Nhập</a>
                    <a href="#" class="login-panel pl-5 flex gap-2 items-center"><font-awesome-icon :icon="['fas', 'user-plus']" />Đăng Ký</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="./index.html">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Categories</button>
                            <div class="input-group">
                                <input type="text" placeholder="What do you need?">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="heart-icon">
                                <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a>
                            </li>
                            <li class="cart-icon">
                                <a href="#">
                                    <i class="icon_bag_alt"></i>
                                    <span>3</span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="si-pic"><img src="img/select-product-1.jpg" alt=""></td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p>$60.00 x 1</p>
                                                            <h6>Kabino Bedside Table</h6>
                                                        </div>
                                                    </td>
                                                    <td class="si-close">
                                                        <i class="ti-close"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="si-pic"><img src="img/select-product-2.jpg" alt=""></td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p>$60.00 x 1</p>
                                                            <h6>Kabino Bedside Table</h6>
                                                        </div>
                                                    </td>
                                                    <td class="si-close">
                                                        <i class="ti-close"></i>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>$120.00</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="#" class="primary-btn view-card">VIEW CARD</a>
                                        <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price">$150.00</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover">
                            <li class="active"><a href="#">Women’s Clothing</a></li>
                            <li><a href="#">Men’s Clothing</a></li>
                            <li><a href="#">Underwear</a></li>
                            <li><a href="#">Kid's Clothing</a></li>
                            <li><a href="#">Brand Fashion</a></li>
                            <li><a href="#">Accessories/Shoes</a></li>
                            <li><a href="#">Luxury Brands</a></li>
                            <li><a href="#">Brand Outdoor Apparel</a></li>
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="./index.html">Home</a></li>
                        <li><a href="./shop.html">Shop</a></li>
                        <li><a href="#">Collection</a>
                            <ul class="dropdown">
                                <li><a href="#">Men's</a></li>
                                <li><a href="#">Women's</a></li>
                                <li><a href="#">Kid's</a></li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./blog-details.html">Blog Details</a></li>
                                <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                <li><a href="./check-out.html">Checkout</a></li>
                                <li><a href="./faq.html">Faq</a></li>
                                <li><a href="./register.html">Register</a></li>
                                <li><a href="./login.html">Login</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap">
                    <div class="slicknav_menu"><a href="#" aria-haspopup="true" role="button" tabindex="0"
                            class="slicknav_btn slicknav_collapsed"><span class="slicknav_menutxt">MENU</span><span
                                class="slicknav_icon"><span class="slicknav_icon-bar"></span><span
                                    class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span></span></a>
                    <nav class="slicknav_nav slicknav_hidden" style="display: none;" aria-hidden="true" role="menu">
                        <ul>
                            <li class="active"><a href="./index.html" role="menuitem">Home</a></li>
                            <li><a href="./shop.html" role="menuitem">Shop</a></li>
                            <li class="slicknav_collapsed slicknav_parent"><a href="#" role="menuitem"
                                    aria-haspopup="true" tabindex="-1" class="slicknav_item slicknav_row"><a
                                        href="#">Collection</a>
                                    <span class="slicknav_arrow">►</span></a>
                                <ul class="dropdown slicknav_hidden" role="menu" style="display: none;"
                                    aria-hidden="true">
                                    <li><a href="#" role="menuitem" tabindex="-1">Men's</a></li>
                                    <li><a href="#" role="menuitem" tabindex="-1">Women's</a></li>
                                    <li><a href="#" role="menuitem" tabindex="-1">Kid's</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html" role="menuitem">Blog</a></li>
                            <li><a href="./contact.html" role="menuitem">Contact</a></li>
                            <li class="slicknav_collapsed slicknav_parent"><a href="#" role="menuitem"
                                    aria-haspopup="true" tabindex="-1" class="slicknav_item slicknav_row"><a
                                        href="#">Pages</a>
                                    <span class="slicknav_arrow">►</span></a>
                                <ul class="dropdown slicknav_hidden" role="menu" style="display: none;"
                                    aria-hidden="true">
                                    <li><a href="./blog-details.html" role="menuitem" tabindex="-1">Blog Details</a>
                                    </li>
                                    <li><a href="./shopping-cart.html" role="menuitem" tabindex="-1">Shopping Cart</a>
                                    </li>
                                    <li><a href="./check-out.html" role="menuitem" tabindex="-1">Checkout</a></li>
                                    <li><a href="./faq.html" role="menuitem" tabindex="-1">Faq</a></li>
                                    <li><a href="./register.html" role="menuitem" tabindex="-1">Register</a></li>
                                    <li><a href="./login.html" role="menuitem" tabindex="-1">Login</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header></template>