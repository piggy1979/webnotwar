<footer class="content-info" role="contentinfo">
  <div class="container">
  	<h2>What people are saying about <a href="https://twitter.com/hashtag/webnotwar">#webnotwar</a></h2>

	<div id="twitterfeed">
<?php

echo pull_tweets();

?>
	</div>

	<div id="footerabout">
		<div class="col-sm-3">
			<img src="/images/heart.png">
		</div>

		<div class="col-sm-9">
		<?php
			echo wpautop(get_post_field('post_content', 13188));	
		?>
		</div>
	</div>


	<div id="footermeta">

<div id='MicrosoftTranslatorWidget' class='Dark' style='color:white;background-color:#555555'></div><script type='text/javascript'>setTimeout(function(){{var s=document.createElement('script');s.type='text/javascript';s.charset='UTF-8';s.src=((location && location.href && location.href.indexOf('https') == 0)?'https://ssl.microsofttranslator.com':'http://www.microsofttranslator.com')+'/ajax/v3/WidgetV3.ashx?siteData=ueOIGRSKkd965FeEGM5JtQ**&ctf=True&ui=true&settings=Auto&from=en';var p=document.getElementsByTagName('head')[0]||document.documentElement;p.insertBefore(s,p.firstChild); }},0);</script>


	<ul>
		<?php pll_the_languages();?>

		<li><a href="/contact">Contact Us</a></li>
		<li><a href="http://www.microsoft.com/info/can-en/cpyright.mspx">Terms and Conditions</a></li>
		<li><a href="http://www.microsoft.com/privacystatement/en-us/core/default.aspx">Privacy Statement</a></li>

	</ul>
	<copy>&copy;<?php echo date('Y'); ?> Microsoft Corporations. All rights reserved. <img src="/wp-content/themes/webnotwar/assets/img/microsoft.png"></copy>
	</div>
  </div>
</footer>

<?php wp_footer(); ?>
