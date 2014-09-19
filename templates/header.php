   <?php
    $phone = "";
    if( wpmd_is_phone() ){
      $phone = " mobile ";
    }
    ?>

<header class="banner navbar navbar-default navbar-static-top <?php echo $phone; ?>" role="banner">
  <div class="">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>

  <?php if( wpmd_is_phone() ){ ?>
  </div>
    <nav class="collapse navbar-collapse" role="navigation">
    <ul id="menu-primary-navigation" class="nav navbar-nav">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'items_wrap' => '%3$s' ,'menu_class' => 'nav navbar-nav' ));
        endif;
      ?>
        <li class='contact'><a href="/contact">Contact</a></li>
        <li class="facebook"><a href="https://www.facebook.com/webnotwar">Facebook</a></li>
        <li class="twitter"><a href="https://twitter.com/WebNotWar">Twitter</a></li>
        <li class="youtube"><a href="https://www.youtube.com/user/webnotwar">YouTube</a></li>
        <li class='search'>

          <form action="/" method="get" id="searchform">
          <fieldset>
          <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
          <input type="submit" alt="Search" value="search" />
          </fieldset>
          </form>
        </li>
      </ul>
    </nav>

  </div>
  <?php }else{ ?>

      <ul id="utils">
                <li class='search'>

        <form action="/" method="get" id="searchform">
        <fieldset>
          <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
          <input type="submit" alt="Search" value="search" />
        </fieldset>
        </form>

          <a href="/search">Search</a>
        </li>
        <li class='contact'><a href="/contact">Contact</a></li>

        <li class='share'><a href="/share">Social</a></li>
      </ul>

    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav', 'walker' => new Nav_Walker_Nav_Menu() ));
        endif;
      ?>
    </nav>
  </div>

      <ul id="sociallinks">
        <li class="facebook"><a href="https://www.facebook.com/webnotwar">Facebook</a></li>
        <li class="twitter"><a href="https://twitter.com/WebNotWar">Twitter</a></li>
        <li class="youtube"><a href="https://www.youtube.com/user/webnotwar">YouTube</a></li>
      </ul>
  
<?php } ?>

</header>
