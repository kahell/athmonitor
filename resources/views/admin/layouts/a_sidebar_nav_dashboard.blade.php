<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="<?php echo base_url();?>assets/images/profile_small.jpg" />
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                     </span> <span class="text-muted text-xs block">Art Director </span> </span> </a>
                </div>
            </li>
            <li  class="<?=($parent_nav=="home")?"active":""?>">
                <a id="home" href="<?= base_url();?>admin/home"><i class="fa fa-home"></i><span class="nav-label">Home</span></a>
            </li>
            <li class="<?=($parent_nav=="user")?"active":""?>">
                <a id="user" href="#"><i class="fa fa-user"></i> <span class="nav-label">User </span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($child_nav=="user")?"active":""?>"><a href="<?= base_url();?>admin/user">User</a></li>
                </ul>
            </li>
            <li class="<?=($parent_nav=="partner")?"active":""?>">
                <a id="partner" href="#"><i class="fa fa-users"></i> <span class="nav-label">Partner</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?=($child_nav=="company")?"active":""?>"><a href="<?= base_url();?>admin/company">Company</a></li>
                    <li class="<?=($child_nav=="client")?"active":""?>"><a href="<?= base_url();?>admin/client">Client</a></li>
                    <li class="<?=($child_nav=="product")?"active":""?>"><a href="<?= base_url();?>admin/product">Product</a></li>
                    <li class="<?=($child_nav=="variant")?"active":""?>"><a href="<?= base_url();?>admin/variant">Variant</a></li>
                    <li class="<?=($child_nav=="ads")?"active":""?>"><a href="<?= base_url();?>admin/ads">Ads</a></li>
                    <li class="<?=($child_nav=="package")?"active":""?>"><a href="<?= base_url();?>admin/package">Box Package</a></li>
                    <li class="<?=($child_nav=="merchant")?"active":""?>"><a href="<?= base_url();?>admin/merchant">Merchant</a></li>
                </ul>
            </li>
            <li class="<?=($parent_nav=="campaign")?"active":""?>">
                <a id="partner" href="#"><i class="fa fa-rocket"></i> <span class="nav-label">Campaign</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?=($child_nav=='GPS Hunt')?"active":""?>"><a href="<?= base_url();?>admin/promo">GPS Hunt</a></li>
                    <li class="<?=($child_nav=="bill")?"active":""?>"><a href="<?= base_url();?>admin/bill">GPS Bill</a></li>
                </ul>
            </li>
            <li class="<?=($parent_nav=="shop")?"active":""?>">
                <a id="shop" href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Store</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  <li class="<?=($child_nav=="item store")?"active":""?>"><a href="<?= base_url();?>admin/item_store">Item Store</a></li>
                  <li class="<?=($child_nav=="point store")?"active":""?>"><a href="<?= base_url();?>admin/point_store">Point Store</a></li>
                  <li class="<?=($child_nav=="credit store")?"active":""?>"><a href="<?= base_url();?>admin/credit_store">Credit Store</a></li>
                  <li class="<?=($child_nav=="bitcoin store")?"active":""?>"><a href="<?= base_url();?>admin/bitcoin_store">Bitcoin Store</a></li>
                  <li class="<?=($child_nav=="voucher store")?"active":""?>"><a href="<?= base_url();?>admin/voucher_store">Voucher Store</a></li>
                  <li class="<?=($child_nav=="discount")?"active":""?>"><a href="<?= base_url();?>admin/discount">Discount</a></li>
                </ul>
            </li>
            <li class="<?=($parent_nav=="currency")?"active":""?>">
                <a id="partner" href="#"><i class="fa fa-btc"></i> <span class="nav-label">Currency</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?=($child_nav=="money")?"active":""?>"><a href="<?= base_url();?>admin/currency">Money</a></li>
                    <li class="<?=($child_nav=="tax")?"active":""?>"><a href="<?= base_url();?>admin/tax">Tax</a></li>
                </ul>
            </li>
            <li class="<?=($parent_nav=="game")?"active":""?>">
                <a id="game" href="#"><i class="fa fa-gamepad"></i> <span class="nav-label">Game</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?=($child_nav=="obstacle")?"active":""?>"><a href="<?= base_url();?>admin/obstacle">Obstacle</a></li>
                    <li class="<?=($child_nav=="box")?"active":""?>"><a href="<?= base_url();?>admin/box">Box</a></li>
                    <li class="<?=($child_nav=="pin")?"active":""?>"><a href="<?= base_url();?>admin/pin">Pin</a></li>
                    <li class="<?=($child_nav=="level")?"active":""?>"><a href="<?= base_url();?>admin/level">Level</a></li>
                    <li class="<?=($child_nav=="pets")?"active":""?>"><a href="<?= base_url();?>admin/pets">Pets</a></li>
                    <li class="<?=($child_nav=="weapon")?"active":""?>"><a href="<?= base_url();?>admin/weapon">Weapon</a></li>
                </ul>
            </li>
            <li class="<?=($parent_nav=="admin")?"active":""?>">
                <a id="partner" href="#"><i class="fa fa-slideshare"></i> <span class="nav-label">Admin</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?=($child_nav=="admin")?"active":""?>"><a href="<?= base_url();?>admin/admin">Admin</a></li>
                    <li class="<?=($child_nav=="authorization")?"active":""?>"><a href="<?= base_url();?>admin/authorization">Authorization</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
