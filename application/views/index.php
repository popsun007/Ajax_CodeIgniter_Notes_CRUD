<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="utf-8">
        <title>Notes</title>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <script>
        	$(document).ready(function(){
        		var Html = function ($res)
        		{
					var html = "<div><h4>";
					html += $res.title + "<a class='btn-danger' href='/notes/delete/" + $res.id + "'>DELETE</a></h4>";
					html += "<form class='update' action='/notes/update/" + $res.id + "' method='post'>"
					html += "<textarea class='description' name='descp' id='" + $res.id + "'>" + $res.description + "</textarea>";
					html += "</form</div>";
					return html;
				};
        		$.get("/notes/get_all", function(res){
    				for(var i=0; i<res.infos.length; i++)
    				{
    					var html = Html(res.infos[i]);
	        			$('.row').append(html);
    				}
        		}, "json");
        		$("form").on('submit', function(){
        			$.post("/notes/add_notes", $(this).serialize(),function(res){
        				var html = Html(res.infos);
        				$('.row').append(html);
        				$('form').trigger('reset');
        			},"json");
        			return false;
        		})
        		$(document).on('click', '.btn-danger', function(){
        			$.post($(this).attr('href'), $(this).serialize(),function(res){
	    				var new_html = '';
	    				for(var i=0; i<res.infos.length; i++)
	    				{
	    					var html = Html(res.infos[i]);
		        			new_html += html;
	    				}
	    				console.log(new_html);
	    				$('.row').html(new_html);
        			}, 'json');
        			return false;
        		})
        		$(document).on('submit','.update', function(){
        			$.post($(this).attr('action'), $(this).serialize(),function(res){
        				$($(this).textarea).html(res.note.description);
        			}, 'json');
        			return false;
        		})
        		$(document).on('change', 'textarea', function(){
        			$(this).parent().submit();
        			$(this).focus();
        		})

        	})
        </script>
        <style>
        	.row
        	{
        		margin-left: 50px;
        	}
        </style>
    </head>
    <body>
        <div class="container">
        	<div class="row">
        	</div>
        	<form class="add" action="/notes/add_notes" method="post">
        		<input type="text" name="title" placeholder="Insert note title here...">
        		<input type="submit" class="btn btn-primary" value="Add Note">
        	</form>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>