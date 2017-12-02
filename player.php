<?php 
require("global.config.php");

if(isset($_GET["id"])){
	$id=$_GET["id"];
	$__= new Player($id,LW_APP_URL."data/xml/");
}
else {
	header("Location:index.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo("From ".$__->getParams("name")." - ".LW_APP_NAME); ?></title>
<link href="<?php echo(LW_APP_URL); ?>css/player.css" rel="stylesheet" type="text/css" />
<script src="<?php echo(LW_APP_URL); ?>js/jquery-1.9.1.js"></script>
</head>

<body style="background-image:url(<?php echo(LW_APP_URL."data/themes/".$__->getParams("theme")); ?>);">
	<a href="<?php echo(LW_APP_URL); ?>"><div class="copyright" title="Make your own New Year Wish!!!."></div></a>
	<div class="firew" style="display:none;"></div>
	<div class="display">

       <div class="poem-lines">
            <?php 
            $poem=$__->getParams("message");
            $poem=explode("\n",$poem);
            $i=0;
            foreach($poem as $poemline):
				if(!empty($poemline)) {
                $i++;
					?>
					<div style="display:none;" class="line" id="line_<?php echo($i) ?>"><?php echo($poemline); ?></div>
					<?php
				}
            endforeach;
            ?>
        </div>
        <div class="final" style="display:none">
        	<div class="title"><?php echo(LW_APP_WISH); ?></div>
            <div class="from">Best Wishes From <?php echo($__->getParams("name")) ?></div>
        </div>
    </div>    
    
    <script>
	$(window).load(function(){
		<?php 
		$T=0; 
		$line_delay=3000; 
		
		?>
	
			
		<?php for($line_anim=1;$line_anim<=$i;$line_anim++): ?>
			/*fade in ------ line <?php echo($line_anim); ?>*/
			var hw=$(window).height();
			var eh=$('#line_<?php echo($line_anim); ?>').height();
			
			var mt=Math.floor((Math.random()*10000) % (hw-eh-48));
			
			
			$('#line_<?php echo($line_anim); ?>').css('margin-top',mt+'px');
				
			setTimeout(
				function() {
			$('#line_<?php echo($line_anim); ?>').fadeIn(500);
				},<?php echo($T); ?>
			);	
			
			/*fadeout------ line <?php echo($line_anim); ?>*/
			setTimeout(
				function() {
			$('#line_<?php echo($line_anim); ?>').fadeOut(500);
				},<?php echo($T+$line_delay); ?>
			);				
			<?php $T+=$line_delay+1500; ?>

		<?php endfor; ?>
		
			setTimeout(
				function() {
			$('.final').fadeIn(1000);
			$('body').css('background-image','');
			$('body').addClass('body-f');
				},<?php echo($T); ?>
			);	
			
			setTimeout(function(){
			
			setInterval(function(){
			
			for(var k=0;k<500;k=k+86) {
				setTimeout(function(){
					$('body').addClass('body-l');
					$('body').removeClass('body-f');
					console.log('on');
					setTimeout(function(){
						$('body').addClass('body-f');
						$('body').removeClass('body-l');
						console.log('off');
					},34);
					
				},k);
				
			}
			
			},7000);
			
			//firew
			
			var screenX=$(window).width();
			var screenY=$(window).height();
			var fireY=$('.firew').height();
			var fireX=$('.firew').width();
			
			
			
			setInterval(function(){
				$('.firew').css('height',(Math.random() * 10000000)%((screenY)/2)+(screenY)/2);
				$('.firew').css('width',(Math.random() * 100000000)%((screenX)/2)+(screenX)/2)
				$('.firew').css('top',(Math.random() * 100000000)%(screenY-fireY));
				$('.firew').css('left',(Math.random() * 100000000)%(screenX-fireX));
				$('.firew').fadeIn(100);
				setTimeout(function(){
					$('.firew').fadeOut(100);
				},80);
			},280);
			
			
			
			},<?php echo($T); ?>);
			

		
		});
		
		
		
		
	</script>
	
    
    <audio id="mp" preload="auto" loop="loop" autoplay="true" src="<?php echo(LW_APP_URL."data/sounds/".$__->getParams("sound")); ?>"></audio>
</body>
</html>
