    <!-- FOOTER-->
        <div class="footer">
            <div class="footer-info">
               <div class="container">
                  <div class="row">
                      @yield('danhmucfooter')
                  </div>
               </div>
            </div>
            <div class="copyright-info p-b-20">
               <div class="container">
                  <div class="row">
                     <div class="col-md-6">
                        <p>Copyright © 2018. Designed by <a href="mailto: duongthanhqui1997@gmail.com">Yang Qing Gui</a>. All rights reseved</p>
                     </div>
                     <div class="col-md-6">
                        <ul class="social-icon">
                           <li><a href="#" class="linkedin"></a></li>
                           <li><a href="#" class="google-plus"></a></li>
                           <li><a href="#" class="twitter"></a></li>
                           <li><a href="#" class="facebook"></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <!-- END FOOTER-->
        <!--GO TOP-->
        <div id="goTop" data-toggle="tooltip" title="Back To Top"><img src="public/images/backtop.png" alt="Back To Top"></div>
        <input type="hidden" id="quyennd" value="{{$nd->Quyen}}">
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
    @yield('js')
    <!-- Main JS-->
    <script src="public/js/main.js"></script>
    <script>
        $(function (){
            // $('a[class*="tttk"]').click(function(e){
            //     e.preventDefault();
            // });

            $('a[data-menu="kqcls"]').click(function(e){
                if($('#quyennd').val() == 'bsk' || $('#quyennd').val() == 'bscc' || $('#quyennd').val() == 'pt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="tkcls"]').click(function(e){
                if($('#quyennd').val() == 'bsk' || $('#quyennd').val() == 'bscc' || $('#quyennd').val() == 'pt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
//                else{
//                    e.preventDefault();
//                    alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//                }
            });
            
            $('a[data-menu="banoi"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'pt' || $('#quyennd').val() == 'bscc'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="bangoai"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'bscc' || $('#quyennd').val() == 'pt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="ttnoi"]').click(function(e){
                if($('#quyennd').val() == 'bskt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
//                else{
//                    e.preventDefault();
//                    alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//                }
            });
            
            $('a[data-menu="ttngoai"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'bscc'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
//                else{
//                    e.preventDefault();
//                    alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//                }
            });
            
            $('a[data-menu="cls"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'pt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
//                else{
//                    e.preventDefault();
//                    alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//                }
            });
            
            $('a[data-menu="pt"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'pt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
//                else{
//                    e.preventDefault();
//                    alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//                }
            });
            
            $('a[data-menu="tt"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'pt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
//                else{
//                    e.preventDefault();
//                    alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//                }
            });

            $('a[data-menu="gcv"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'pt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
//                else{
//                    e.preventDefault();
//                    alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//                }
            });
            
            $('a[data-menu="grv"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'pt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
//                else{
//                    e.preventDefault();
//                    alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//                }
            });
            
            $('a[data-menu="kkvp"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'pt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
//                else{
//                    e.preventDefault();
//                    alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//                }
            });
            
            $('a[data-menu="bs"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'pt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
//                else{
//                    e.preventDefault();
//                    alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//                }
            });
            
            $('a[data-menu="cc"]').click(function(e){
                if($('#quyennd').val() == 'tdkb'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="dtcc"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'pt' || $('#quyennd').val() == 'bsk'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
//                else{
//                    e.preventDefault();
//                    alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//                }
            });
            
            $('a[data-menu="tkk"]').click(function(e){
                if($('#quyennd').val() == 'bskt' || $('#quyennd').val() == 'pt'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
//            $('a[data-menu="tk"]').click(function(e){
//                e.preventDefault();
//                alert('Chức năng vẫn đang trong quá trình xây dựng chưa hoàn thiện, hãy truy cập sau!');
//            });
            
            $('a[data-menu="dkkb"]').click(function(e){
                if($('#quyennd').val() == 'tdcc'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="qlns"]').click(function(e){
                if($('#quyennd').val() == 'qlbv'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="qlcc"]').click(function(e){
                if($('#quyennd').val() == 'qlbv'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="qlk"]').click(function(e){
                if($('#quyennd').val() == 'qlbv'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="qll"]').click(function(e){
                if($('#quyennd').val() == 'qlbv'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="qlpb"]').click(function(e){
                if($('#quyennd').val() == 'qlbv'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="qlt"]').click(function(e){
                if($('#quyennd').val() == 'qlbv'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="qlkt"]').click(function(e){
                if($('#quyennd').val() == 'qlbv'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="qlb"]').click(function(e){
                if($('#quyennd').val() == 'qlbv'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="qltb"]').click(function(e){
                if($('#quyennd').val() == 'qlbv'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="qldp"]').click(function(e){
                if($('#quyennd').val() == 'qlbv'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
            
            $('a[data-menu="tkttk"]').click(function(e){
                if($('#quyennd').val() == 'qlbv'){
                    e.preventDefault();
                    alert('Bạn không có quyền truy cập danh mục này!');
                }
            });
        });
    </script>
</body>

</html>
<!-- end document-->
