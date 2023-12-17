{{-- Giao diện --}}
<script src="/template/admin/plugins/jquery/jquery.min.js"></script>

<script src="/template/admin/plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="/template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

{{-- <script src="/template/admin/plugins/chart.js/Chart.min.js"></script> --}}

<script src="/template/admin/plugins/sparklines/sparkline.js"></script>

<script src="/template/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/template/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<script src="/template/admin/plugins/jquery-knob/jquery.knob.min.js"></script>

<script src="/template/admin/plugins/moment/moment.min.js"></script>
<script src="/template/admin/plugins/daterangepicker/daterangepicker.js"></script>

<script src="/template/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="/template/admin/plugins/summernote/summernote-bs4.min.js"></script>

<script src="/template/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script src="/template/admin/dist/js/adminlte.js?v=3.2.0"></script>


{{-- Data Table --}}
<link href=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/dataTables.bootstrap4.min.css rel=stylesheet>
<script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js></script>

<script>

  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>

{{--Thống kê doanh số  --}}

{{-- Tạo lịch--}}

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
$(function() {
  $( "#datepicker" ).datepicker({
    dateFormat:"yy-mm-dd"
  });
} );
</script>

<script>
$(function() {
  $( "#datepicker2" ).datepicker({
    dateFormat:"yy-mm-dd"

  });
} );
</script>


{{--Tạo ra biểu đồ --}}

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
  $(document).ready(function(){
    chart30daysorder();
    // Lấy ra dữ liệu tạo biểu đồ 
    var chart = new Morris.Area({
      // ID of the element in which to draw the chart.
      element: 'myfirstchart',
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      parseTime:false,
      hideHover: 'auto',
      // The name of the data record attribute that contains x-values.
      xkey: 'period',
      // A list of names of data record attributes that contain y-values.
      ykeys: ['order','sales','quantity'],
      behaveLikeLine: true,
      // Labels for the ykeys -- will be displayed when you hover over the
      // chart.
      labels: ['Đơn hàng','doanh số','số lượng']
    });

    // Thống kê 30 ngày
    function chart30daysorder(){
      $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          url:"{{('/admin/days-order')}}",
          method:"POST",
          dateType:"JSON",
          data:{
             _token: '{{csrf_token()}}'
          },

          success:function(data){
            chart.setData(JSON.parse(data)); 
          }
      });
    }

    // Chọn option theo khoảng tg "Tuần qua, Tháng trước, Tháng này, Năm qua"
    $('.dashboard-filter').change(function(){
      var dashboard_value = $(this).val();

      $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          url:"{{('/admin/dashboard-filter')}}",
          method:"POST",
          dateType:"JSON",
          data:{
            dashboard_value: dashboard_value, _token: '{{csrf_token()}}'
          },

          success:function(data){
            chart.setData(JSON.parse(data)); 
          }
      });
    });

    // Lọc theo form từ ngày mấy đến ngày mấy
    $('#btn-dashboard-filter').click(function(){
      var from_date = $('#datepicker').val();
      var to_date = $('#datepicker2').val();
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:"{{'/admin/filter-by-date'}}",
          method:"POST",
          dateType:"JSON",
          
          data:{
            from_date: from_date, to_date: to_date, _token: '{{csrf_token()}}'
          },
          success:function(data){
            chart.setData(JSON.parse(data)); 
          }
        });
    });
});

</script>


{{-- Xử lý số lượng đã bán ra --}}
<script type="text/javascript">
  $('.order_details').change(function(){
      var status = $(this).val();
      var id = $(this).children(":selected").attr("id");
      var _token = $('input[name="_token"]').val();
      //lay ra so luong
      quantity = [];
      $("input[name='product_sales_quantity']").each(function(){
          quantity.push($(this).val());
      });
      //lay ra product id
      order_product_id = [];
      $("input[name='order_product_id']").each(function(){
          order_product_id.push($(this).val());
      });

      $.ajax({
        url : "{{'/admin/manage/update-invoice-qty'}}",
            method: 'POST',
            data:{_token:_token, status:status ,id:id ,quantity:quantity, order_product_id:order_product_id},
            success:function(data){
                alert('Thay đổi tình trạng đơn hàng thành công');
                location.reload();
            }
      });


  });
</script>

@yield('footer')