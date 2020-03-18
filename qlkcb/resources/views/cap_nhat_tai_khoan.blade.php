<!DOCTYPE html>
<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache"); ?>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Yang Gui">
    <meta name="keywords" content="au theme template">
    <meta name="_token" content="{{ csrf_token() }}" />
    <!-- Title Page-->
    <title>Cập nhật tài khoản</title>
    <base href="{{ asset('') }}">
    <link rel="shortcut icon" href="public/images/icon/favicon.png">
    <!-- Fontfaces CSS-->
    <link href="public/css/font-face.css" rel="stylesheet" media="all">
    <link href="public/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
    <link href="public/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="public/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="public/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="public/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="public/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="public/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5" style="overflow-x: auto;">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#" class="none_href">
                                <img src="public/images/logo.jpg" alt="Logo BVĐKTT An Giang">
                            </a>
                        </div>
                        <div class="login-form">
                            <form>
                                <div class="row m-b-15" style="display: flex; align-items: center;">
                                    <div class="col-lg-4 text-center m-b-5">
                                        @if(isset($nd))
                                            @if($nd->nhanVien->Anh != '')
                                                <img data-anhtk="anhtk" class="avatar" style="width: 100px; height: 100px" src="public/upload/anhnv/{{$nd->nhanVien->Anh}}" alt="Ảnh người dùng" />
                                            @else
                                                 <img data-anhtk="anhtk" class="avatar" style="width: 100px; height: 100px" src="public/images/icon/avatar-01.jpg" alt="Ảnh người dùng" />
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input class="form-control" type="file" id='anhdd'>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                        <label class="form-control-label">Mật khẩu cũ</label>
                                            <input class="form-control" type="password" id='mkcu'>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                        <label class="form-control-label">Mật khẩu mới</label>
                                            <input class="form-control" type="password" id='mkm'>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                        <label class="form-control-label">Nhập lại MK mới</label>
                                            <input class="form-control" type="password" id='nlmk'>
                                        </div>
                                    </div>
                                </div>
                                <button class="au-btn au-btn--block au-btn--darkgreen m-b-10 m-t-10 font-bolder" type="button" id="btncntk">CẬP NHẬT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="public/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="public/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="public/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="public/vendor/slick/slick.min.js">
    </script>
    <script src="public/vendor/wow/wow.min.js"></script>
    <script src="public/vendor/animsition/animsition.min.js"></script>
    <script src="public/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="public/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="public/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="public/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="public/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="public/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="public/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="public/js/main.js"></script>
    <script src="public/js/pusher.js"></script>
    <script>

    $(function () {

        var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

        //Phần xử lý cho channel
        // Khởi tạo một đối tượng Pusher với app_key
        var pusher = new Pusher('d2f4702dc798a781c566', {
            cluster: 'ap1',
            encrypted: true
        });

        var chanel = pusher.subscribe('UserEvent');

        function capnhattk(data) {
            if(data.thaotac == 'cntk'){
                $('img[data-anhtk="anhtk"]').attr('src', 'public/upload/anhnv/'+data.anh);

            }
        }

        chanel.bind('App\\Events\\Admin\\UserEvent', capnhattk);

        $('#btncntk').click(function(){
            var mkc=$('#mkcu').val(), mkm=$('#mkm').val(), nlmk=$('#nlmk').val(),
            anh=$('#anhdd').val();
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            if(anh == '' && mkc.toString().trim() == '' && mkm.toString().trim() == '' && nlmk.toString().trim() == ''){
                alert('Thông tin không thay đổi!');
                return false;
            }
            if(anh != ''){
                formData.append('file', $('#anhdd')[0].files[0]);
            }
            if((mkc.toString().trim() != '' && (mkm.toString().trim() == '' || nlmk.toString().trim() == '')) || (mkm.toString().trim() != '' && (mkc.toString().trim() == '' || nlmk.toString().trim() == '')) | (nlmk.toString().trim() != '' && (mkm.toString().trim() == '' || mkc.toString().trim() == ''))){
                alert('Nếu muốn thay đổi mật khẩu bạn phải nhập đầy đủ thông tin!')
                return false;
            }
            else{
                if((mkc.toString().trim().length < 6 ||  mkc.toString().trim().length > 32) || (mkm.toString().trim().length < 6 ||  mkm.toString().trim().length > 32) || (nlmk.toString().trim().length < 6 ||  nlmk.toString().trim().length > 32)){
                    alert('Độ dài mật khẩu phải từ 6 - 32 ký tự!')
                    return false;
                }
                if(mkc.toString() != ''){
                    if(mkm.toString() != nlmk.toString()){
                        alert('Xác nhận mật khẩu mới không chính xác!')
                        return false;
                    }
                    formData.append('mkc', mkc);
                    formData.append('mkm', mkm);
                    formData.append('nlmk', nlmk);
                }
            }
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/cap_nhat_tai_khoan',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    // Success
                    if(data.msg == 'tc'){
                        alert("Cập nhật thành công!");
                    }
                    else if(data.msg == 'mksai'){
                        alert("Mật khẩu cũ không chính xác!");
                    }
                    else if(data.msg == 'koht'){
                        alert("Cập nhật tài khoản thất bại do không hỗ trợ kiểu file, các kiểu hỗ trợ là: .png; .jpg; .jpeg; .svg!");
                    }
                    else if(data.msg == 'mk_anh_tb'){
                        alert("Cập nhật mật khẩu và ảnh đại diện thất bại do mật khẫu cũ không khớp và file ảnh không được hỗ trợ kiểu file, các kiểu hỗ trợ là: .png; .jpg; .jpeg; .svg!");
                    }
                    else if(data.msg == 'anh_tc'){
                        alert("Cập nhật mật khẩu thất bại do mật khẩu cũ không khớp, cập nhật ảnh đại diện thành công!");
                    }
                    else if(data.msg == 'tc_anh_tb'){
                        alert("Cập nhật mật khẩu thành công, cập nhật ảnh đại diện thất bại do không hỗ trợ kiểu file, các kiểu hỗ trợ là: .png; .jpg; .jpeg; .svg!");
                    }
                    else{
                        alert("Cập nhật thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Cập nhật thất bại! Lỗi: "+jqXHR.msg+" | "+errorThrown);
                }
            });
        });
    });

    </script>
</body>

</html>
<!-- end document-->