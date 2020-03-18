<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
@if(session()->get("loi"))
	{{session()->get("loi")}}
    @php $url = session()->get("url");@endphp
        <script>
            (window.onload = function(){
                var pfEntries = performance.getEntriesByType("navigation");
                if(pfEntries[0].type === 'reload')
                    window.location.href = '{{url($url)}}';
            });
        </script>
@endif
</body>
</html>

