<?php 
use Nticaric\Twitter\TwitterStream;

require_once 'data-structures/AVLTree.php';
require_once 'data-structures/HashTable.php';

include __DIR__ . '/vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blue bird engine</title>
</head>
<body>

<?php 
  
  if ( isset($_POST["hashtag"]) ) :

    if (isset($_POST["numberOfTweets"])) {
      $numberOfTweets = $_POST["numberOfTweets"];
      if ($numberOfTweets < 1 || $numberOfTweets > 1000) {
        $numberOfTweets = 10;
      }
    } else {
      $numberOfTweets = 10;
    }

    $hashtag = $_POST["hashtag"];

    $tweetCount = 0;

    $tree = new AVLTree();
    $table = new HashTable($numberOfTweets);


    $stream = new TwitterStream(array(
      'consumer_key'    => 'r15DaNkELAr9555Gsqr2wqe9o',
      'consumer_secret' => 'WOhLtxpeIqupqTtfFi4T0SrfhI9U8OXkyNRjEv1NnPF5RojBaJ',
      'token'           => '105363828-IPptl0YcJ10L5xbET5nTEgXA8DTBN3Pvhug7CIQQ',
      'token_secret'    => '89kRlEtYjGGPwUcT0osXA7RvSXuUAwCeFRhXWeBogHikb'
    ));

    $res = $stream->getStatuses(['track' => $hashtag], function($tweet) 
      use (&$tree, &$table, &$tweetCount, &$numberOfTweets) {

      if ($tweetCount < $numberOfTweets) {

        $text = $tweet["text"];
        $user = $tweet["user"];
        $screen_name = $user["screen_name"];
        //echo "<br> @$screen_name: $text <br>";
        
        $tree->insert($screen_name);
        $table->insert($screen_name, $text);

        $tweetCount++;

      } else {

        $usernames = $tree->inorder();
        foreach ($usernames as $username) {
          echo "<br><span style='color: #2184EE;'>@$username</span>: " . $table->find($username) . "<br>";
        }

        die;
      }


    });

  endif;


 ?>

  <div class="container" style="width:100%;text-align:center;line-height:30px;">
    <h1>Analizador de Tweets</h1>
    <form action="" method="post">
      Hashtag: <input type="text" name="hashtag"><br>
      Number of tweets: <input type="text" name="numberOfTweets"><br>
      <input type="submit">
    </form>
  </div>
  <div class="table">
    
  </div>


</body>
</html>