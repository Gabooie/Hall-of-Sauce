<!DOCTYPE html>
<html>
<head>
	<title>Hall of Sauce</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">

	<!--Simple script to hide button while menu is not up. -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
		$(window).scroll(function(){
		var threshold = 0; // number of pixels before bottom of page that you want to start fading
		var op = (($(document).height() - $(window).height()) - $(window).scrollTop()) / threshold;
			if( op <= 0 ){
				$("#thing-to-hide").show();
			} else {
				$("#thing-to-hide").hide();
			}
			$("#button").css("opacity", op ); 
		});

	</script>


	<!--URL CHANGER // Gets filename from a .webm inside of the storage folder and adds it to the URL. // This system is random and it works well. It was a bitch to get working and could prob be cleaner but it works for now -Gabooie -->
	<?php 
		$path = "storage";
		$filed = glob($path . '/*.*');
		$filev = array_rand($filed);
		$newval = basename($filed[$filev], ".webm");
		  if( !count($_GET) ) {
		  header('Location: ?' . $newval);
		  exit;
		}	
		$_GET['S'] = $newval;
	?>

	<?php $final = print_r($_SERVER['QUERY_STRING'], TRUE); ?>


	<!--HOS LOGO ANIMATION // Makes the logo shrink and keeps it from overlapping with Disqus comments -Gabooie -->
	<div id="logo-anim">
			<div id="header" class="grow">
			<img  src="logotry.gif" width="801" height="135" alt="logo">
			</div>
		<script>
			(function() {
			  'use strict';
			  var he = document.getElementById('header');
			  var startShrink = 50;
			  window.addEventListener('scroll',
			function() {
				if( window.pageYOffset > startShrink ) {
	             he.classList.remove( 'grow' );  
	             he.classList.add( 'shrink' );           
				}
				else {
	             he.classList.remove( 'shrink' );  
	             he.classList.add( 'grow' ); 
				}
			},false);
		}());
		</script>
	</div>

	<!-- DISQUS COMMENTS -Gabooie -->
	<div id="ex-bord">
		<div id="comments">
			<div id="disqus_thread"></div>
			<script>

				var disqus_config = function () {
				this.page.url = 'http://hallofsauce.com/?<?php echo $final ?>';
				};

				(function() { // DON'T EDIT BELOW THIS LINE
				  var d = document, s = d.createElement('script');
				  s.src = 'https://hofs.disqus.com/embed.js';
				  s.setAttribute('data-timestamp', +new Date());
				  (d.head || d.body).appendChild(s);
				})();
			</script>
			<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
		</div>
	</div>
</head>


<!--URL GRABBER // gets the video source by grabbing the URL and adds ".webm" to the end. // This also is what makes the entire page clickable to reload the site and choose another random webm. -Gabooie -->
<a href="http://hallofsauce.com">
	<video autoplay loop id="sauce">
		<source src="<?php echo "storage/" . $final . ".webm"; ?>" type='video/webm'>
	</video>
</a>

<script>
	function setVidVolume() { 
		var vid = document.getElementById("sauce");
</script>


<button onclick="muteVolume()" type="button">Mute Audio</button>
<button onclick="setFullVolume()" type="button">Set volume to 1.0</button><br> 


<script>
	var vid = document.getElementById("sauce");
	  
	function muteVolume() { 
	    vid.volume = 0.0;
	} 
	  
	function setFullVolume() { 
	   vid.volume = "volume";
	} 
</script> 


<!--Part of scroll hiding script. -Gabooie -->
<script>
	$(window).scroll(function() {
	    if ($(this).scrollTop()) {
	        $('#toTop').fadeIn();
	    } else {
	        $('#toTop').fadeOut();
	    }
	});
</script>

<!--UNFINISHED-->
<div id='toTop'><button class="aboutbutton">WORK IP</button></div>


</body>
</html>


<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <link rel="stylesheet" href="">
    </head>
    <body>
        <?php
            if(!$_SESSION['volume']) {
                $_SESSION['volume'] =0.5;
            } 

        ?>
        <input type="range" onchange="setVolume()" id='volume1' min=0 max=1 step=0.01 value=<?php echo $_SESSION['volume']?>>
        
        <p>Value: <span id="volume"></span></p>

		<script>
			var slider = document.getElementById("volume1");
			var output = document.getElementById("volume");
			output.innerHTML = slider.value;

			slider.oninput = function() {
			  output.innerHTML = this.value;
			}
		</script>


        <script
          src="https://code.jquery.com/jquery-2.2.4.min.js"
          integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
          crossorigin="anonymous">
          </script>

        <script>
            function setVolume() {   
                mediaClip = document.getElementById("volume1").value;
                var update= 'volume=' + mediaClip;
                $.ajax({
                    type: "POST",
                    url: "update.php",
                    data: update,
                    dataType: 'json',
                    cache: false,
                    success: function(response) {
                        alert(response.message);
                    }
                });
            }
        </script>
    </body>
</html>