<script>
	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": true,
		"positionClass": "toast-bottom-right",
		"preventDuplicates": false,
		"showDuration": "500",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};
	// Pusher.logToConsole = true;
	var pusher = new Pusher("{{ env('PUSHER_KEY') }}", {
		cluster : 'mt1'
	});
	var channel = pusher.subscribe('loginChannel');
	channel.bind('loginEvent', function(data) {
		@if(Auth::user()->role == 'Super Admin')
		var count = document.getElementById('userCount').innerHTML;
		if(count == ''){document.getElementById('userCount').textContent = 1;}
		else {document.getElementById('userCount').textContent = (parseInt(count) + 1);}
		$('#menuNotifications').prepend('<li><a href="/Admin/Notifications"><i class="fa fa-user text-aqua"></i><span>'+data.user+' logged in</span><br>'+
			'<span class="pull-right">'+moment().fromNow()+'</span></a></li>');
		toastr["info"](data.user + ' logged in');
		@endif
	});
	channel2 = pusher.subscribe('userPostEventChannel');
	channel2.bind('App\\Events\\userPostEvent', function(data) {
		@if(Auth::user()->role == 'Super Admin')
		var count = document.getElementById('userCount').innerHTML;
		if(count == ''){document.getElementById('userCount').innerHTML = 1;}
		else {document.getElementById('userCount').innerHTML = (parseInt(count) + 1);}
		$('#menuNotifications').prepend('<li><a href="/Admin/PostReview/'+data.id+'"><i class="fa fa-book text-aqua"></i><span>'+data.name+' submitted a new journal for review</span><br>'+
			'<span class="pull-right">'+moment().fromNow()+'</span></a></li>');
		toastr["success"](data.name + ' submitted a new journal for review');
		@endif
	});

	channel3 = pusher.subscribe('userRegisteredChannel');
	channel3.bind('userRegistered', function(data) {
		@if(Auth::user()->role == 'Super Admin')
		var count = document.getElementById('userCount2').innerHTML;
		if(count == ''){document.getElementById('userCount2').innerHTML = 1;}
		else {document.getElementById('userCount2').innerHTML = (parseInt(count) + 1);}
		$('#pendingUsers').prepend('<li><a href="/Admin/PendingUsers/"><i class="fa fa-user text-aqua"></i><span>'+data.user+' is awaiting for account approval</span><br>'+
			'<span class="pull-right">'+moment().fromNow()+'</span></a></li>');
		toastr["success"](data.user + ' is awaiting for account approval.');
		@endif
	});
	function markAllAsRead()
	{
		$.ajax({
			dataType: "json",
			url: '/Admin/AcceptUsersOnclick',
		});
		document.getElementById('userCount').innerHTML = '';
	}
</script>