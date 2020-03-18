        <!-- footer content -->
        <footer style="text-align: center;">
          <div class="pull-center">
            <a href="{{ url('/') }}"  class="site_title" style="color: inherit !important;"><i class="glyphicon glyphicon-education" style="border-color: #73879C !important"></i> <span>Hệ Thống Quản Lý Học Tập Sinh Viên!</span></a>
            <p>Khoa Công Nghệ Thông Tin - Đại học An Giang.</p>
            <p>©@php $_y='2019';$_cury=date('Y');@endphp @if($_y!==$_cury){{$_y.' - '.$_cury.'.'}}@else{{$_y.'.'}}@endif All Rights Reserved.</p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <!-- jQuery -->
    <script src="resources/js/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="resources/bootstraps/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    <script src="resources/bootstraps/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="resources/bootstraps/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- ALERTIFY JS -->
    <script src="resources/bootstraps/alertifyjs/alertify.min.js"></script>
    @yield('scripts')
    <!-- Custom Theme Scripts -->
    <script src="resources/js/custom.min.js"></script>
    <!-- Your specified script -->
    @yield('specifiedScript')
  </body>
</html>
