<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>香港樹木搜尋</title>

        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="HKSearchTree">
        <link rel="apple-touch-icon" href="https://res.cloudinary.com/dcmnwc3ux/image/upload/v1514056506/LOTUSFA_COM_ICON.png">

        <!-- boostrap style sheet -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style type="text/css">
            a:link {
                text-decoration: none;
                color: #1a0dab;
            }

            a:visited {
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }

            a:active {
                text-decoration: underline;
            }
            .sultStats {
                color: #808080;
                font-size: small;
            }
        </style>
        <script>
        var x;
        function search() {
            x = document.getElementById("searchInput").value;
            window.location.href = x;
        }
        </script>

    </head>
    <body >
        
        
        
        <div class="jumbotron container" >
          <h1>香港樹木搜尋</h1> 
          <p> 如欲了解更多，請前往 <a href="https://hksearchtree.lotusfa.com">https://hksearchtree.lotusfa.com</a></p>
          <p></p> 
          <div class="input-group" >
            <input id="searchInput" type="text" class="form-control" placeholder="Enter Tree Code....">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button" onclick="search()">Search</button>
            </span>
          </div>
        </div>

        <div class="container">
          <p class="sultStats">About  {{$count}} results</p>

          @if ($count != 0)
          <table class="table" id="trees_result" >
            <thead>
              <tr>
                <th>Location</th>
                <th>Name</th>
                <th>Tree Code</th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $trees as $tree )
                <tr >
                <td>{{$tree['District']}}</td>
                <td>{{$tree['Name']}}</td>
                <td><a href="../info/{{$tree['ID']}}">{{$tree['Code']}}</a></td>
                </tr>
                @endforeach
            </tbody>
          </table>
          @endif

          <p class="sultStats">Search More: ie. <a href="../search/{{$ranString}}">{{$ranString}}</a></p>
        </div>

        
        <footer class="w3-center w3-black w3-padding-64 w3-opacity w3-hover-opacity-off">
          <p>以上資料由<a href="http://www.greening.gov.hk/treeregister/map/treeIndex.aspx#districtPanel" >香港政府網站</a>提供</p>
          <p>Powered by <a href="https://lotusfa.com/" title="LotusFa" target="_blank" class="w3-hover-text-green">lotusfa.com</a></p>
        </footer>
        <!-- Google Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-80492067-1', 'auto');
            ga('send', 'pageview');

          </script>
    </body>
</html>