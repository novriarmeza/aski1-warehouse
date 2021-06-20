@extends('layout/main')

@section('title', 'Matkomp')

@section('container')
<div class="row" style="margin: 30px 50px;">
    @foreach ($ospendings as $data)
    <div class="col-md-3">
        <a href="{{url('/matkomp/osdata/ospending')}}">
        <div class="card" style="width:20rem; margin:10px; background-color:rgb(187, 1, 1)">
            <div class="card-body">
              <h4 class="card-title" style="text-align: center; color:white; font-weight:bold">OS Pending</h4>
              <h1 class="card-subtitle mb-2 text-muted" style="text-align: center; padding-top:10px; font-size:70px; color:white; font-weight:bold">{{$data->jumlah}}</h1>
            </div>
        </div>
        </a>
    </div>
    @endforeach
    @foreach ($oscompletes as $data)
    <div class="col-md-3">
        <a href="{{url('/matkomp/osdata/osnew')}}">
        <div class="card" style="width:20rem; margin:10px; background-color:rgba(30, 150, 0, 0.884)">
            <div class="card-body">
                <h4 class="card-title" style="text-align: center; color:white; font-weight:bold">OS Completed</h4>
                <h1 class="card-subtitle mb-2 text-muted" style="text-align: center; padding-top:10px; font-size:70px; color:white; font-weight:bold">{{$data->jumlah}}</h1>
            </div>
          </div>
        </a>
    </div>
    @endforeach
    @foreach ($oscancels as $data)
    <div class="col-md-3">
        <a href="{{url('/matkomp/osdata/oscancel')}}">
        <div class="card" style="width:20rem; margin:10px; background-color:rgba(231, 123, 0, 0.986)">
            <div class="card-body">
                <h4 class="card-title" style="text-align: center; color:white; font-weight:bold">OS Cancel</h4>
                <h1 class="card-subtitle mb-2 text-muted" style="text-align: center; padding-top:10px; font-size:70px; color:white; font-weight:bold">{{$data->jumlah}}</h1>
              </div>
          </div>
        </a>
    </div>
    @endforeach
    @foreach ($osnews as $data)
    <div class="col-md-3">
        <a href="{{url('/matkomp/osdata/osnew')}}">
        <div class="card" style="width:20rem; margin:10px; background-color:rgb(131, 131, 131)">
            <div class="card-body">
                <h4 class="card-title" style="text-align: center; color:white; font-weight:bold">OS New</h4>
                <h1 class="card-subtitle mb-2 text-muted" style="text-align: center; padding-top:10px; font-size:70px; color:white; font-weight:bold">{{$data->jumlah}}</h1>
            </div>
          </div>
        </a>
    </div>
    @endforeach
</div>
<div class="row" style="margin: 10px">
    <div class="col-md-6">
        <h5>DETAIL OS PENDING</h5>
        <table class="table" id="table-1">
            <thead>
                <tr>
                    <th width="1" style="text-align: center;">No</th>
                    <th style="text-align: center;">Delivery Date</th>
                    <th style="text-align: center;">OS Number</th>
                    <th style="text-align: center;">Material_Desc</th>
                    <th style="text-align: center;">Supplier</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: center;">UoM</th>
                    <th style="text-align: center;">Status</th>
                </tr>
            </thead>

            <tbody>
                @php $nomor = 1; @endphp
                    @foreach($osdtlpending as $data)
                <tr class="text-center">
                    <td>{{$nomor}}</td>
                    <td><?php echo date('d-m-Y', strtotime($data->Delivery_Date)); ?></td>
                    @if ($data->OS_Number)
                    <td>{{$data->OS_Number}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($data->Material_Desc)
                    <td>{{$data->Material_Desc}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($data->Vendor_Name)
                    <td>{{$data->Vendor_Name}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($data->Qty)
                    <td>{{$data->Qty}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($data->Uom)
                    <td>{{$data->Uom}}</td>
                    @else
                    <td></td>
                    @endif
                    <td style="background-color: rgb(255, 83, 83)"> Pending </td>
                </tr>
                @php $nomor++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <h5>DETAIL OS COMPLETE</h5>
        <table class="table" id="table-2">
            <thead>
                <tr>
                    <th width="1" style="text-align: center;">No</th>
                    <th style="text-align: center;">Delivery Date</th>
                    <th style="text-align: center;">OS Number</th>
                    <th style="text-align: center;">Material_Desc</th>
                    <th style="text-align: center;">Supplier</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: center;">UoM</th>
                    <th style="text-align: center;">Status</th>
                </tr>
            </thead>

            <tbody>
                @php $nomor = 1; @endphp
                    @foreach($osdtlcomplete as $data)
                <tr class="text-center">
                    <td>{{$nomor}}</td>
                    <td><?php echo date('d-m-Y', strtotime($data->Delivery_Date)); ?></td>
                    @if ($data->OS_Number)
                    <td>{{$data->OS_Number}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($data->Material_Desc)
                    <td>{{$data->Material_Desc}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($data->Vendor_Name)
                    <td>{{$data->Vendor_Name}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($data->Qty)
                    <td>{{$data->Qty}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($data->Uom)
                    <td>{{$data->Uom}}</td>
                    @else
                    <td></td>
                    @endif
                    <td style="background-color: rgb(98, 238, 110)"> Compeleted </td>
                </tr>
                @php $nomor++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function() {
        $('#table-1').DataTable( {
            scrollY:        '48vh',
            scrollCollapse: true,
            paging:         false
        } );
        $('#table-2').DataTable( {
            scrollY:        '48vh',
            scrollCollapse: true,
            paging:         false
        } );
        
    } );
</script>
@endsection
