@extends('admin.main')
@section('content')
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
          
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$invoice}}</h3>
              <p>Tất cả các đơn hàng</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
              </div>
              <a href="/admin/manage/customers" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$invoice_complete}}</h3>
                <p>Các đơn đã hoàn thành</p>
              </div>
            <div class="icon">
            <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/admin/manage/customers/successful" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$invoice_new}}</h3>
                <p>Đơn chưa duyệt</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
                <a href="/admin/manage/customers/new" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-3 col-6">
          
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$invoice_cancel}}</h3>
              <p>Đơn bị hủy</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
              <a href="/admin/manage/customers/cancel" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
        </div>
    
        <form autocomplete="off">
          @csrf
          <div class="row">
              <div class="col">
                <p>Từ ngày: <input type="text" class="form-control" id="datepicker"></p>
                <input type="button" value="Lọc kết quả" class="btn btn-primary btn-sm" id="btn-dashboard-filter">
              </div>
              <div class="col">
                <p>Đến ngày: <input type="text" class="form-control" id="datepicker2"></p>
  
              </div>

              <div class="col">
                <p>
                  Lọc theo:
                  <select class="dashboard-filter form-control">
                    <option >--Chọn--</option>
                    <option value="7ngay">Tuần qua</option>
                    <option value="thangtruoc">Tháng trước</option>
                    <option value="thangnay">Tháng này</option>
                    <option value="nam">Năm qua</option>
                  </select>
                </p>
              </div>  
            </div>
        </form>
          <div class="row">
            <div class="col">
              <div id="myfirstchart" style="height: 250px;"></div>
            </div>
          
          </div>
          
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>


@endsection