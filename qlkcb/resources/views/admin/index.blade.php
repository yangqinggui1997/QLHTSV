@extends('admin.layout')

@section('title')
    {{ "Home - Quản trị viên" }}
@endsection

@section('content')
    <div class="main-content background_img">
                
    </div>
@endsection

@section('js')
<script src="public/js/pusher.js"></script>
<script>

    $(function () {
        //Phần xử lý cho channel
        // Khởi tạo một đối tượng Pusher với app_key
        var pusher = new Pusher('d2f4702dc798a781c566', {
            cluster: 'ap1',
            encrypted: true
        });
       
        //Đăng ký với kênh UserEvent đã tạo trong file UserEvent.php
        var channel = pusher.subscribe('UserEvent');
        function laytt(data) {
            if(data.thaotac == 'cntk'){
                $('img[data-anhtk="anhtk"]').attr('src', 'public/upload/anhnv/'+data.anh);
            }
        }

        //Bind một function laytt với sự kiện UserEvent.php
        channel.bind('App\\Events\\Admin\\UserEvent', laytt);
        //end xử lý channel
        
    });
    </script>
@endsection