<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Transposer</title>
    <script src="/lib/js/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            initEvents();
            initElements();
            ajaxSearch("");
            $('#search-box').focus();
        });

        function buildTable(data){
            var table = "<table id=\"search-results-table\">";
            for(var i=0, len=data.length; i < len; i++){
                table += "<tr>"
                table +="<td class=\"search-result\">";
                table += data[i]; //readable text
                table += "</td>";
                table += "</tr>"
            }
            table += "</table>";
            return table;
        }
        function pageInit(){
            initEvents();
        }
        
        function initElements(){
            $("#transposer-main-view").hide();
        }

        function initEvents(){
            $(document).on('keydown','#search-box', function(event) {
                textChanged();
            });

            $(document).on('keyup','#search-box', function(event) {
                textChanged();
            });

            $(document).on('oncut','#search-box', function(event) {
                textChanged();
            });

            $(document).on('onpaste','#search-box', function(event) {
                textChanged();
            });

            $(document).on('click touchstart','#search-box', function(event) {
                $(this).select();
                textChanged();
            });

            $(document).on('click tap', '.search-result', function(event){
                ajaxGetSongContent($(this).text());
            })

            $(document).on('click touchstart', '#content-layout-container', function(event){
                $("#search-results-container").hide();
            })
        }

        function textChanged(){
            var searchbox = $("#search-box");
            ajaxSearch(searchbox.val());
        }

        function ajaxSearch(query){
            $("#search-results-container").show();
            $.ajax({
                url: "/transposer/songs/search.php",
                type: "GET",
                dataType: "json",
                data: {
                    q: query
                },
                success: function(data){
                    var table = buildTable(data);
                    $("#search-results-view").html(table);
                },
                error: function(){
                    console.log("Error");
                }
            });
        }

        function ajaxGetSongContent(title){
            $.ajax({
                url: "/transposer/songs/get.php",
                type: "GET",
                dataType: "json",
                data: {
                    title: title
                },
                success: function(data){
                    var body_content = "<b>" + data['title'] + "</b>";
                    body_content += "<br/><br/>"
                    body_content += data['content'];
                    $("#transposer-main-view").html(body_content);
                },
                error: function(){
                    console.log("Error");
                }
            });
            $("#search-results-container").hide();
            $("#transposer-main-view").show();
        }
    
    
    </script>
    <style type="text/css">
        #app-container{
            border: none;
            padding: 0px;
        }
        #top-layout-container{
            width: 100%;
            height: 80px;
            background: white;
            box-shadow: 0 4px 4px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
            
        }
        #content-layout-container{
            width:100%;
            margin: auto; /*Center the alignment*/
        }
        
        #search-container{
            padding: 2px 0px 0px 0px;
            width: 70%;
			position: absolute;
			top: 70px;
			transform: translateX(-50%);
			left: 50%;
        }
        #content-container{
            padding: 15px 0px 0px 0px;
            width: 90%;
            margin: auto; /*Center the alignment*/
        }
        #search-box-container{
            width: 70%;
            margin: auto; /*Center the alignment*/
            background: white;
            padding: 5px;
            border-radius: 2px;
            box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
        }
        
        #search-box{
            border: none;
            width: 100%;
            height: 50px;
            font-size: 34px;
            outline: none;
            position: relative;
            /*Vertical align*/
            /*position: relative;
            top: 50%;
            transform: translateY(-50%);*/
            z-index: 1;
        }
        
        #search-results-container{
            background: white;
            position: relative;
            border-radius: 2px;
            box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
            z-index: 2;
        }
        #search-results-table{
            width: 100%;
        }
        
        .search-result{
            color: black;
            background: #f7f8f9;
            border-radius: 3px;
			cursor: pointer; /*Required to make touch events register*/
            padding: 10px 10px 10px 10px;
        }
        
        .search-result:hover{
            background: #e5e5e5;
            transition-duration: 0.2s;
        }
        
        #transposer-main-view{
            width: 70%;
            background: white;
            padding: 20px;
            margin: 10 auto;
            white-space: pre-wrap;
            box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
        }
        
        body{
            padding: 0px;
            margin: 0px;
            font-family: 'Helvetica', 'Arial', sans-serif;
        }
		.center{
			height: 100%;
			width: 100%;
			margin: auto;
		}
    </style>
</head>
<body>
<div id="app-container">
    <!-- TOP LAYOUT -->
    <div id="top-layout-container">
		<table class="center">
			<tr><td></td></tr>
			<tr>
				<td>
					<div id="search-box-container">
						<input id="search-box" type="text"></input>
					</div>
				</td>
			</tr>
			<tr><td></td></tr>
		</table>
        <div id="search-container">
            <div id="search-results-container">
                <div id="search-results-view"></div>
            </div>
        </div>
    </div>
    
    <!-- CONTENT LAYOUT -->
    <div id="content-layout-container">
        <div id="content-container">
            <div id="transposer-main-view">
            </div>
        </div>
    </div>
</div>
</body>
</html>