<?php include 'Database.php';
$rset = mysqli_query($conn, "SELECT * FROM amount where ID=1");
$row = mysqli_fetch_assoc($rset);
$amount = $row['bankAmount'];

# GET CATEGORIES FOR DROP DOWN
$cats = array();
$i = 1;
$rset1 = mysqli_query($conn, "SELECT * FROM gameCategories");
while($row1 = mysqli_fetch_assoc($rset1)) {
	$cats[$i] = $row1['category'];
	$i++;
}

?>
<!doctype html>

<html lang="en">
<head>
 	<meta charset="utf-8">

	<title>The Weakest Link</title>

	<link rel="stylesheet" href="weakestLink.css">

	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
	
	</head>

<body>

	<script>
		function resetMoney() {
			$('#one, #two, #three, #four, #five, #six, #seven, #eight, #nine, #ten').removeClass("active");
			$('#zero').addClass("active");
		}

		function bankMoney() {
			var total = $('.active').closest('div').find(":input").val();
			var posting = $.post("reqBank.php", {'linkTotal' : total}, function() {
				location.reload(true);
			});
		}

		function clearBank() {
			$.post("reqBank.php", {'action' : 'RESET_BANK'}, function() {
				location.reload(true);
			});
		}

		function correctNext() {
			var moneyId = $('.active').closest('div').attr('id');
			if(moneyId === 'zero') {
				$('#one').addClass('active');
				$('#zero').removeClass('active');
			} else if(moneyId === 'one') {
				$('#two').addClass('active');
				$('#one').removeClass('active');
			} else if(moneyId === 'two') {
				$('#three').addClass('active');
				$('#two').removeClass('active');
			} else if(moneyId === 'three') {
				$('#four').addClass('active');
				$('#three').removeClass('active');
			} else if(moneyId === 'four') {
				$('#five').addClass('active');
				$('#four').removeClass('active');
			} else if(moneyId === 'five') {
				$('#six').addClass('active');
				$('#five').removeClass('active');
			} else if(moneyId === 'six') {
				$('#seven').addClass('active');
				$('#six').removeClass('active');
			} else if(moneyId === 'seven') {
				$('#eight').addClass('active');
				$('#seven').removeClass('active');
			} else if(moneyId === 'eight') {
				$('#nine').addClass('active');
				$('#eight').removeClass('active');
			} else if(moneyId === 'nine') {
				$('#ten').addClass('active');
				$('#nine').removeClass('active');
			}
		}

		function startTimer(duration, display) {
			var timer = duration, minutes, seconds;
			setInterval(function () {
			minutes = parseInt(timer / 60, 10)
			seconds = parseInt(timer % 60, 10);

			minutes = minutes < 10 ? "0" + minutes : minutes;
			seconds = seconds < 10 ? "0" + seconds : seconds;

			display.text(minutes + ":" + seconds);

			if (--timer < 0) {
			    timer = duration;
			}
			}, 1000);
		}

		function _timer(callback)
		{
		    var time = 0;     //  The default time of the timer
		    var mode = 1;     //    Mode: count up or count down
		    var status = 0;    //    Status: timer is running or stoped
		    var timer_id;    //    This is used by setInterval function
		    
		    // this will start the timer ex. start the timer with 1 second interval timer.start(1000) 
		    this.start = function(interval)
		    {
		        interval = (typeof(interval) !== 'undefined') ? interval : 1000;
		 
		        if(status == 0)
		        {
		            status = 1;
		            timer_id = setInterval(function()
		            {
		                switch(mode)
		                {
		                    default:
		                    if(time)
		                    {
		                        time--;
		                        generateTime();
		                        if(typeof(callback) === 'function') callback(time);
		                    }
		                    break;
		                    
		                    case 1:
		                    if(time < 86400)
		                    {
		                        time++;
		                        generateTime();
		                        if(typeof(callback) === 'function') callback(time);
		                    }
		                    break;
		                }
		            }, interval);
		        }
		    }
		    
		    //  Same as the name, this will stop or pause the timer ex. timer.stop()
		    this.stop =  function()
		    {
		        if(status == 1)
		        {
		            status = 0;
		            clearInterval(timer_id);
		        }
		    }
		    
		    // Reset the timer to zero or reset it to your own custom time ex. reset to zero second timer.reset(0)
		    this.reset =  function(sec)
		    {
		        sec = (typeof(sec) !== 'undefined') ? sec : 0;
		        time = sec;
		        generateTime(time);
		    }
		    
		    // Change the mode of the timer, count-up (1) or countdown (0)
		    this.mode = function(tmode)
		    {
		        mode = tmode;
		    }
		    
		    // This methode return the current value of the timer
		    this.getTime = function()
		    {
		        return time;
		    }
		    
		    // This methode return the current mode of the timer count-up (1) or countdown (0)
		    this.getMode = function()
		    {
		        return mode;
		    }
		    
		    // This methode return the status of the timer running (1) or stoped (1)
		    this.getStatus
		    {
		        return status;
		    }
		    
		    // This methode will render the time variable to hour:minute:second format
		    function generateTime()
		    {
		        var second = time % 60;
		        var minute = Math.floor(time / 60) % 60;
		        var hour = Math.floor(time / 3600) % 60;
		        
		        second = (second < 10) ? '0'+second : second;
		        minute = (minute < 10) ? '0'+minute : minute;
		        hour = (hour < 10) ? '0'+hour : hour;
		        
		        $('div.timer span.second').html(second);
		        $('div.timer span.minute').html(minute);
		        $('div.timer span.hour').html(hour);
		    }
		}
		 
		// example use
		var timer;
		 
		$(document).ready(function(e) 
		{
		    timer = new _timer
		    (
		        function(time)
		        {
		            if(time == 0)
		            {
		                timer.stop();
		                //alert('time out');
							document.getElementById( 'timer-beep' ).play();
		            }
		        }
		    );
		    timer.reset(0);
		    timer.mode(0);
		});

	// $(function() {
	// 	$( '.timer' ).timer(function() {
	// 		document.getElementById( 'timer-beep' ).play();
	// 	});

	// });
	
	function changeCat(cat) {
		console.log(cat);
		$('#questionCat').html('Question Category: '+cat);
	}
	</script>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<table id="moneyTable">
					<tbody>
						<tr><td><div class="money" id="ten"><input id="ten-input" type="hidden" value="1700">$1700</div></td></tr>
						<tr><td><div class="money" id="nine"><input id="nine-input" type="hidden" value="1450">$1400</div></td></tr>
						<tr><td><div class="money" id="eight"><input id="eight-input" type="hidden" value="1200">$1200</div></td></tr>
						<tr><td><div class="money" id="seven"><input id="seven-input" type="hidden" value="1050">$1050</div></td></tr>
						<tr><td><div class="money" id="six"><input id="six-input" type="hidden" value="900">$900</div></td></tr>
						<tr><td><div class="money" id="five"><input id="five-input" type="hidden" value="750">$750</div></td></tr>
						<tr><td><div class="money" id="four"><input id="four-input" type="hidden" value="600">$600</div></td></tr>
						<tr><td><div class="money" id="three"><input id="three-input" type="hidden" value="400">$400</div></td></tr>
						<tr><td><div class="money" id="two"><input id="two-input" type="hidden" value="250">$250</div></td></tr>
						<tr><td><div class="money" id="one"><input id="one-input" type="hidden" value="100">$100</div></td></tr>
						<tr><td><div class="money active" id="zero"><input id="zero-input" type="hidden" value="0">$0</div></td></tr>
					</tbody>
				</table>
			</div>
			<div class="col-sm-9">
			<div class="row">
				<div class="row">
					<select id="category" style="margin: 5px 0;" onchange="changeCat(this.value);">
						<?php foreach($cats as $index => $cat) { ?>
							<option value="<?= $cat ?>"><?= $index ?>. <?= $cat ?></option>
						<?php }?>
					</select>		
				</div>
				<div class="row">
					<div class="well" style="margin-top:5px;">
						<div class="row" id="timer"></div>
						<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-6">
								<div class="timer">
						            <span class="hour">00</span>:<span class="minute">00</span>:<span class="second">00</span>
						        </div>
					        </div>
					        <div class="col-sm-3"></div>
				        </div>
						
						<audio id="timer-beep">
						  <source src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/41203/beep.mp3"/>
						  <source src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/41203/beep.ogg" />
						</audio>
						<div class="row">
							<div class="control">
					            <button class="btn btn-primary btn-large" onClick="timer.start(1000)">Start</button> 
					            <button class="btn btn-danger btn-large" onClick="timer.stop()">Stop</button> 
					            <button class="btn btn-warning btn-large" onClick="timer.reset(120)">Reset</button> 
					            <button class="btn btn-default" onClick="timer.mode(0)">Count down</button>
				        	</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="well" style="margin-top:5px;">
						<h3 id="questionCat"></h3>
						<p id="question"></p>
						<hr/>
						<div class="row">
							<button type="button" class="btn btn-danger btn-large" style="margin-left:15px;" onclick="resetMoney();">Incorrect</button>
							<button type="button" class="btn btn-success pull-right btn-large" style="margin-right: 15px;" onclick="correctNext();">Correct</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="well">
						<h3 style="text-align:center;">Bank</h3>
						<h2 style="text-align:center;"><?= $amount ?></h2>
						<hr>
						<div class="row" style="text-align:center;">
							<button type="button" class="btn btn-info btn-xlarge" style="margin-left:15px;" onclick="bankMoney();">BANK</button>
						</div>
						<div class="row" style="text-align:center;">
							<a style="margin-left:15px;" onclick="clearBank();" href="#">Reset Bank</a>
						</div>
					</div>
				</div>
				<div class="row">
					<button type="button" class="btn btn-primary btn-large" id="reset_btn" onclick="resetMoney();">Reset</button>	
				</div>
			</div>
		</div>
	</div>

</body>
</html>
