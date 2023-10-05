<?php
//$xml=("http://news.google.com/news?ned=us&topic=h&output=rss");
//$xml = "http://www.theregister.co.uk/headlines.rss";
//$xml = "https://news.google.com/news?cf=all&hl=en&pz=1&ned=us&topic=tc&output=rss";

$xml = "https://news.google.com/news/rss/headlines/section/topic/TECHNOLOGY?ned=us&hl=en&gl=US";
$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//try {
    //get elements from "<channel>"
    $channel=$xmlDoc->getElementsByTagName('channel')->item(0);
    $channel_title = $channel->getElementsByTagName('title')
        ->item(0)->childNodes->item(0)->nodeValue;
    $channel_link = $channel->getElementsByTagName('link')
        ->item(0)->childNodes->item(0)->nodeValue;
    $channel_desc = $channel->getElementsByTagName('description')
        ->item(0)->childNodes->item(0)->nodeValue;
//} catch( Exception $e ) {
//	echo $e->getMessage();
//}
    
//output elements from "<channel>"
echo('<p class="rssHeader"><a href=' . $channel_link . ' target="_blank ">' . $channel_title . "</a></p>");

//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('item');

for( $i=0; $i<=7; ++$i ) {
    $item_title=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
    $item_link=$x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
    $item_desc=$x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;

    if( $i % 2 == 0 ) {  
        // if true == odd
        echo "<div class='odd'>";
    } else {
        // even
        echo "<div class='even'>";
    }
    echo('<div class="rssTitle"><a href=' . $item_link . ' target="_blank">' . $item_title . "</a></div>");
    echo "<div class='rssDesc'>" . $item_desc . "</div>";
    echo "</div>";
}
