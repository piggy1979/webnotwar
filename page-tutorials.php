<script type="text/javascript" src="<?php echo JSDIR . "selectConvert.js"  ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#cattut").selectConvert({
    speed : 1
    <?php if($_GET['cattut']){
      $cat = get_term_by('slug', $_GET['cattut'], 'tutorial_cats' );
    //  print_r($cat);
        if($cat->name){
          echo ", defaultname : '" . $cat->name . "'";
        }
    } ?>
  });

  $("#tagbox select").selectConvert({
    defaultname : 'All Items'
  });

});
</script>
<style>
article{
  overflow: visible;
}
/* Default custom select styles */
div.sc-select-holder {
  display: inline-block;
  vertical-align: middle;
  position: relative;
  text-align: left;
  background: #fff;
  z-index: 1;
  width: 100%;
  max-:width 300px;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

div.sc-select-holder:focus {
  outline: none; /* For better accessibility add a style for this in your skin */
}

.sc-select-holder select {
  display: none;
}

.sc-select-holder span {
  display: block;
  position: relative;
  cursor: pointer;
  padding: 1em;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  font-family: "refrigerator-deluxe",sans-serif;
}

/* Placeholder and selected option */
.sc-select-holder > span {
  padding-right: 3em;
}

.sc-select-holder > span::after,
.sc-select-holder .sc-select-holdered span::after {
  speak: none;
  position: absolute;
  top: 50%;
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.sc-select-holder > span::after {
  content: '\25BE';
  right: 1em;
}

.sc-select-holder .sc-select-holdered span::after {
  content: '\2713';
  margin-left: 1em;
}

.sc-select-holder.sc-active > span::after {
  -webkit-transform: translateY(-50%) rotate(180deg);
  transform: translateY(-50%) rotate(180deg);
}

/* Options */
.sc-select-holder .scoptions {
  position: absolute;
  overflow: hidden;
  width: 100%;
  background: #fff;
  visibility: hidden;
}

.sc-select-holder.sc-active .scoptions {
  visibility: visible;
}

.sc-select-holder ul {
  list-style: none;
  margin: 0;
  padding: 0;
  width: 100%;
}

.sc-select-holder ul span {
  padding: 1em;
}

.sc-select-holder ul li.cs-focus span {
  background-color: #ddd;
}

/* Optgroup and optgroup label */
.sc-select-holder li.cs-optgroup ul {
  padding-left: 1em;
}

.sc-select-holder li.cs-optgroup > span {
  cursor: default;
}


div.sc-select-holder {
  color: #fff;
  font-size: 1.8em;
  width: 300px;
}

@media screen and (max-width: 30em) {
  div.sc-select-holder { font-size: 1em; width: 250px; }
}

div.sc-select-holder::before {
  content: '';
  background: #282b30;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-transition: -webkit-transform 0.3s;
  transition: transform 0.3s;
}

.sc-select-holder.sc-active::before {
  -webkit-transform: scale3d(1.1,3.5,1);
  transform: scale3d(1.1,3.5,1);
}

.sc-select-holder > span {
  height: 80px;
  line-height: 32px;
  -webkit-transition: text-indent 0.3s, opacity 0.3s;
  transition: text-indent 0.3s, opacity 0.3s;
}

@media screen and (max-width: 30em) {
  .sc-select-holder > span { height: 60px; line-height: 28px; }
}

.sc-select-holder.sc-active > span {
  text-indent: -290px;
  opacity: 0;
}

.sc-select-holder > span::after,
.sc-select-holder.sc-active > span::after {
  content: '>';
  color: #F1702F;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

.sc-select-holder.sc-active > span::after {
  -webkit-transform: translate3d(0,-50%,0);
  transform: translate3d(0,-50%,0);
}

.sc-select-holder .scoptions {
  background: transparent;
  width: 100%;
  padding: 1.9em 0;
  top: 50%;
  left: 50%;
  -webkit-transform: translate3d(-50%,-50%,0);
  transform: translate3d(-50%,-50%,0);
}

@media screen and (max-width: 30em) {
  .sc-select-holder .scoptions { padding-top: 3em; }
}

.sc-select-holder .scoptions li {
  opacity: 0;
  -webkit-transform: translate3d(30%,0,0);
  transform: translate3d(30%,0,0);
  -webkit-transition: -webkit-transform 0.3s, opacity 0.3s;
  transition: transform 0.3s, opacity 0.3s;
}

.sc-select-holder.sc-active .scoptions li {
  -webkit-transform: translate3d(0,0,0);
  transform: translate3d(0,0,0);
  opacity: 1;
}

.sc-select-holder.sc-active .scoptions li:first-child {
  -webkit-transition-delay: 0.05s;
  transition-delay: 0.05s;
}

.sc-select-holder.sc-active .scoptions li:nth-child(2) {
  -webkit-transition-delay: 0.1s;
  transition-delay: 0.1s;
}

.sc-select-holder.sc-active .scoptions li:nth-child(3) {
  -webkit-transition-delay: 0.15s;
  transition-delay: 0.15s;
}

.sc-select-holder.sc-active .scoptions li:nth-child(4) {
  -webkit-transition-delay: 0.2s;
  transition-delay: 0.2s;
}

.sc-select-holder.sc-active .scoptions li:nth-child(5) {
  -webkit-transition-delay: 0.25s;
  transition-delay: 0.25s;
} /* more options need more delay declaration */

.sc-select-holder .scoptions li span {
  text-transform: uppercase;
  font-weight: 500;
  letter-spacing: 2px;
  font-size: 65%;
  padding: 0.8em 1em;
}

.sc-select-holder .scoptions li span:hover,
.sc-select-holder .scoptions li.cs-focus span,
.sc-select-holder .scoptions li.cs-selected span {
  color: #F1702F;
  background: transparent;
}

.sc-select-holder .cs-selected span::after {
  content: '';
}




</style>
  <article>

  <section id="tutorials" class="col-sm-12 tutorialprimary">
    <div class="row padtop">
    <div id="filtertools" class="container">
      <form action="/tutorials/" method="get">
      <?php

        echo showCats("tutorial_cats");

      ?>
      <div id="tagbox"><select name='tagged'></select></div>

    <input type='submit' value='Show Tutorials'> 
    </form>
    </div>
<?php


  // load tutorials here.
  echo getTutorials(8, null, 'preview', 3, null, true);
?>
    </div>
  </section>


  </article>