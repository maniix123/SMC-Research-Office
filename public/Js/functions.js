//For dynamic adding of active class to navbar
$(document).ready(function () {
    var url = window.location;
    $('ul.nav a[href="'+ url +'"]').parent().addClass('active2');
    $('ul.nav a').filter(function() {
         return this.href == url;
    }).parent().addClass('active2');
});
//AdminLTE options
$(document).ready(function(){
	var AdminLTEOptions = {
		navbarMenuSlimscroll: true,
		navbarMenuSlimscrollWidth: "3px", //The width of the scroll bar
		navbarMenuHeight: "200px",
		wheelStep: 120
	};
	$('.testing-custom-list').slimScroll({
		position: 'right',
		height: '500px',
		railVisible: false,
		alwaysVisible: false,
		wheelStep: 120
	});
});
//search function
function searchJournals(tab, type)
{
	var search = $('#searchInput').val(), optionSelect = $('#optionSelect').val();
	if((optionSelect == "") || (search.length == 0))
	{
    	$('#posts').removeClass('hide');
    	$('.search_results').addClass('hide');
    	alert('Please try again');
	}
	else
	{
		$.ajax({
		    dataType: "json",
		    url: '/search/'+search+ '/option/'+optionSelect+'/tab/'+tab+'/type/'+type,
		    success: function (result) {
		        if(result.length == 0)
		        {
		        	$('#posts').addClass('hide');
		        	$('.search_results').removeClass('hide');
		        	$('.search_results').html('<h1 class="text-center">There are no results</h1>');
		        }
		        else{
		        	$('#posts').addClass('hide');
		        	$('.search_results').removeClass('hide');
		        	var output = '';
			    	for(var i = 0; i < result.length; i++)
			        {
							output += "<div class='hvr-float-shadow'><h3>"+ result[i].proposal+"</h3>";
							output += "<p>Abstract: </p>";
							output += '<blockquote><i>"'+result[i].abstract+'"</i></blockquote>';
							output += "<p>Author:  <i class='fa fa-book' aria-hidden='true'></i> "+result[i].author +"</p>";
							output += "<p>School Year: <i class = 'fa fa-calendar' aria-hidden='true'></i> "+result[i].schoolyear+"</p>";
							output += "<p>Posted by: <i class='fa fa-user' aria-hidden='true'></i> "+result[i].user.name+"</p></div>";
			        }
			     	$('.search_results').html(output);
		        }
		    },
		});
	}
}
function searchJournalsForStudents(tab, type, department)
{
	var search = $('#searchInput').val(), optionSelect = $('#optionSelect').val();
	if((optionSelect == "") || (search.length == 0))
	{
    	$('#posts').removeClass('hide');
    	$('.search_results').addClass('hide');
    	alert('Please try again');
	}
	else
	{
		$.ajax({
		    dataType: "json",
		    url: '/search/'+search+ '/option/'+optionSelect+'/tab/'+tab+'/type/'+type+'/department/'+department,
		    success: function (result) {
		    	console.log(result);
		        if(result.length == 0)
		        {
		        	$('#posts').addClass('hide');
		        	$('.search_results').removeClass('hide');
		        	$('.search_results').html('<h1 class="text-center">There are no results</h1>');
		        }
		        else{
		        	$('#posts').addClass('hide');
		        	$('.search_results').removeClass('hide');
		        	var output = '';
			    	for(var i = 0; i < result.length; i++)
			        {
							output += "<div class='hvr-float-shadow'><h3>"+ result[i].proposal+"</h3>";
							output += "<p>Abstract: </p>";
							output += '<blockquote><i>"'+result[i].abstract+'"</i></blockquote>';
							output += "<p>Author:  <i class='fa fa-book' aria-hidden='true'></i> "+result[i].author +"</p>";
							output += "<p>School Year: <i class = 'fa fa-calendar' aria-hidden='true'></i> "+result[i].schoolyear+"</p>";
							output += "<p>Posted by: <i class='fa fa-user' aria-hidden='true'></i> "+result[i].user.name+"</p></div>";
			        }
			     	$('.search_results').html(output);
		        }
		    },
		});
	}
}