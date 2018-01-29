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
				$("#thing-to-hide").hide():
			}
			$("#button").css("opacity", op ); 
		});

	    //Part of scroll hiding script. -Gabooie
		$(window).scroll(function() {
		    if ($(this).scrollTop()) {
		        $('#toTop').fadeIn();
		    } else {
		        $('#toTop').fadeOut();
		    }
		});
	</script>
</head>
<body>
	<script>
		function setVolume(){
			document.getElementById("sauce").volume = document.getElementById("volume").value;
		}
	</script>
	<input id="volume" type="range" min="0.0" max="1.0" step="0.01" onchange="setVolume();" />

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

		$final = print_r($_SERVER['QUERY_STRING'], TRUE);
	?>

	<!--HOS LOGO ANIMATION // Makes the logo shrink and keeps it from overlapping with Disqus comments -Gabooie -->
	<div id="logo-anim">
			<div id="header" class="grow">
			<img  src="logotry.gif" width="801" height="135" alt="logo">
			</div>
		<script>
			(function() {
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
				  (d.head || d.body).appendChild(s);d
				})();
			</script>
			<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
		</div>
	</div>


<!--URL GRABBER // gets the video source by grabbing the URL and adds ".webm" to the end. // This also is what makes the entire page clickable to reload the site and choose another random webm. -Gabooie -->
<a href="http://hallofsauce.com">
	<video autoplay loop id="sauce">
		<source src="<?php echo "storage/" . $final . ".webm"; ?>" type='video/webm'>
	</video>
</a>

<!--Hides buttons before scrolling down. MUST BE IN BODY OF HTML! -->
<script>
    $(window).scroll(function() {
        if ($(this).scrollTop()) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
</script>	
	
<div id='toTop'><button onclick="hideComment()" id="hidecommentbtn" title="Close Comments" class="commentbutton">Close Comments</button></div>
	<script>
		document.getElementById("sauce").volume = 0.5;
		function hideComment() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script>

<a href="http://hallofsauce.com/login">
<div id='Login'><button id="loginbtn" title="Login/Register" class="loginbutton">Login/Register</button></div>
</a>

</body>
</html>