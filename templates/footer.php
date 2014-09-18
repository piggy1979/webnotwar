<footer class="content-info" role="contentinfo">
  <div class="container">
  	<h2>What people are saying about <a href="https://twitter.com/hashtag/webnotwar">#webnotwar</a></h2>

	<div id="twitterfeed">
<?php
/* bring in twitter information */
require_once('TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "109646656-wjE7E0TJ8znUJvOHZaCIQcPvqRjyubguTgYFpH3d",
    'oauth_access_token_secret' => "DRHzCj8XUkFY8ITuFOwT6qoIfchya6fE6LZGQTqpWCg7u",
    'consumer_key' => "0JvX8VeGowiWivNIqCARJMoQR",
    'consumer_secret' => "li3SRxbTavMNB1FFpDPvz1IDM4C6OS8ssT7uQ42H9Dw2KXJRa8"
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = "?q=#webnotwar&count=4&result_type=recent";
$requestMethod = "GET";

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

$tweets = json_decode($response);


$tweetcount = 0;
// loop through tweets
foreach($tweets->statuses as $tweet){
	//$tweetcount++;
	//if($tweetcount == 4) return;
	echo "<div class='col-sm-3'>";
	echo "<span class='user'>" . $tweet->user->name . "</span>\n";
	echo "<p class='tweet'>" .twitter_it($tweet->text) . "</p>";

//	print_r($tweet);

	echo "</div>\n";

}
function twitter_it($text)
{
	$text= preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t&lt;]*)/is", "$1$2<a href=\"$3\" >$3</a>", $text);
    $text= preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" >$3</a>", $text);
    $text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);
    $text= preg_replace("/@(\w+)/", '<a href="http://www.twitter.com/$1" target="_blank">@$1</a>', $text); 
    $text= preg_replace("/\#(\w+)/", '<a href="http://search.twitter.com/search?q=$1" target="_blank">#$1</a>',$text); 
    return $text;
}
?>
	</div>

	<div id="footermeta">
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
