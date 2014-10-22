<?php
/*
Template Name: Open Home Page
*/
?>

  <article>

  <section id="stories" class="col-sm-8 storypage">

		<div class="">
		<?php wpautop(the_content()); ?>
		</div>

  </section>

  <section id="news" class='col-sm-4 floaty'>
    <div id="sticky">
<a class="twitter-timeline" href="https://twitter.com/hashtag/opendata" data-widget-id="512597537421676544">#opendata Tweets</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    </div>
  </section>  


  </article>