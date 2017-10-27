		<script type="text/javascript" src="jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="cycle2.js"></script>
		 <style type="text/css">
		 	*{
		 		margin: 0;
		 		padding: 0;
		 	}
		 	#container{
		 		width: 1200;
		 		height: 600px;
		 		overflow: hidden;
		 		background: #ff00ff;
		 	}
		 	#slideshow{
		 		height: 100%;
		 		width: 100%;
		 	}
		 	#slideshow img{
		 		height: 100%;
		 		width: 100%;
		 	}
		 	#pager{
		 		text-align: center;
		 		height: 120px;
		 		width: 100%;
		 		position: absolute;
		 		bottom: 5%;
		 		background: rgba(0,0,0,.5);
		 		z-index: 1000;
		 		opacity: 0;
		 		transition: all 0.3s ease-in-out 0s;	
		 	}
		 	#pager img{
		 		margin: 10px 5px;
		 		opacity: 0.3;
		 		transition: all 0.3s ease-in-out 0s;
		 	}
		 	#pager img:hover{
		 		opacity: 1;
		 		transform: scale(1.05);
		 		z-index: 100;
		 	}
		 	#pager:hover{
		 		opacity: 1;
		 	}
		 	#prev{
		 		height: 120px;
		 		width: 120px;
		 		position: absolute;
		 		top: 0;
		 		bottom: 0;  
		 		left: 0;
		 		margin: auto 10px;
		 		z-index: 1000;
		 	}
		 	
		 	#next{
		 		height: 120px;
		 		width: 120px;
		 		position: absolute;
		 		top: 0;
		 		bottom: 0;
		 		right: 0;
		 		margin: auto 10px; 
		 		z-index: 1000;
		 	}
		 	
		 </style>
	
		<div id="container">
			<div id="slideshow" class="cycle-slideshow"
				data-cycle-fx = "fade"
				data-cycle-speed = "600"
				data-cycle-timeout = "3000"
				data-cycle-pager = "#pager"
				data-cycle-pager-template = "<a href='#'><img src='{{src}}' height=100 width=150 /></a>"
				data-cycle-next = "#next"
				data-cycle-prev = "#prev"
				data-cycle-manual-fx = "scrollHorz"
				data-cycle-mnual-speed = "400"
				data-cycle-pager-fx = "fade">
				<img src="a.jpeg">
				<img src="b.jpeg">
				<img src="c.jpg">
				<img src="d.jpeg">
				<img src="e.jpg">
				<img src="f.jpg">
				<img src="g.jpg">
			</div>
			<div id="pager"></div>
			<img id="prev" src="homepage/previous.png" />
			<img id="next" src="homepage/next.png"/>
		</div>