<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, width=device-width">
<script type="text/javascript" src="jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="jquery.bgswitcher.js"></script>
<script type="text/javascript" src="home.js"></script>
<style type="text/css">
.box {
	height: 400px;
	width: 98%;
	margin-right: 1%;
	margin-bottom: 10px;
}
</style>

<div class="box"><br /><br /><br />
	<div id="drivingJob_article1Sub">
		<span>We Are Looking For Great Drivers<br /> Throughout The Country</span>
	</div>
</div>
<script type="text/javascript">
	$(".box").bgswitcher({
		images: ["images/a.jpeg", "images/b.jpeg", "images/c.jpg", "images/d.jpeg", "images/e.jpg", "images/f.jpg", "images/g.jpg"],
		effect: "clip" //fade, blind, clip, slide, drop, hide
	});
</script>
