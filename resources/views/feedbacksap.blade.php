@extends('layout/main')

@section('title', 'Matkomp')

@section('container')
<div class="col-12">
    <div class="row" style="margin: 25px 15px">
        <h4 style="text-align: center">DATA GR VS SAP</h4>
    </div>
    <div class="row" style="margin: 30px 10px">
        <div class="col-md-6">
            <div class="card rounded card-primary card-outline">
                <h5 style="margin-top: 10px; text-align:center">Belum Terima Feedback dari SAP</h5>
                <table class="table" id="table-1">
                    <thead>
                        <tr>
                            <th width="1" style="text-align: center;">No</th>
                            <th style="text-align: center;">Surat Jalan</th>
                            <th style="text-align: center;">Nomor OS</th>
                            <th style="text-align: center;">Supplier</th>
                            <th style="text-align: center;">Nama Material/Komponen</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $nomor = 1; @endphp
                            @foreach($sapnull as $data)
                        <tr class="text-center">
                            <td>{{$nomor}}</td>
                            @if ($data->Shipment)
                            <td>{{$data->Shipment}}</td>
                            @else
                            <td>N/A</td>
                            @endif
                            @if ($data->OS_Number)
                            <td>{{$data->OS_Number}}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($data->Vendor_Name)
                            <td>{{$data->Vendor_Name}}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($data->Material_Desc)
                            <td>{{$data->Material_Desc}}</td>
                            @else
                            <td></td>
                            @endif
                            <td class="text-center" style="background-color: rgba(175, 175, 175, 0.884)">Belum ada Feedback SAP</td>
                        </tr>
                        @php $nomor++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card rounded card-success card-outline">
                <h5 style="margin-top: 10px; text-align:center">OS Completed (FULL)</h5>
                <table class="table" id="table-2">
                    <thead>
                        <tr>
                            <th width="1" style="text-align: center;">No</th>
                            <th style="text-align: center;">GR Date Time</th>
                            <th style="text-align: center;">Surat Jalan</th>
                            <th style="text-align: center;">Nomor OS</th>
                            <th style="text-align: center;">Supplier</th>
                            <th style="text-align: center;">Nama Material/Komponen</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $nomor = 1; @endphp
                            @foreach($sapfull as $data)
                        <tr class="text-center">
                            <td>{{$nomor}}</td>
                            <td>{{$data->GR_Date_Time}}</td>
                            @if ($data->Shipment)
                            <td>{{$data->Shipment}}</td>
                            @else
                            <td>N/A</td>
                            @endif
                            @if ($data->OS_Number)
                            <td>{{$data->OS_Number}}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($data->Vendor_Name)
                            <td>{{$data->Vendor_Name}}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($data->Material_Desc)
                            <td>{{$data->Material_Desc}}</td>
                            @else
                            <td></td>
                            @endif
                            <td class="text-center" style="background-color: rgba(93, 248, 93, 0.884)">{{$data->Status_SAP}}</td>
                        </tr>
                        @php $nomor++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 30px 10px">
        <div class="col-md-6">
            <div class="card rounded card-warning card-outline">
                <h5 style="margin-top: 10px; text-align:center">OS OUTSTANDING (Partial)</h5>
                <table class="table" id="table-3">
                    <thead>
                        <tr>
                            <th width="1" style="text-align: center;">No</th>
                            <th style="text-align: center;">GR Date Time</th>
                            <th style="text-align: center;">Surat Jalan</th>
                            <th style="text-align: center;">Nomor OS</th>
                            <th style="text-align: center;">Supplier</th>
                            <th style="text-align: center;">Nama Material/Komponen</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $nomor = 1; @endphp
                            @foreach($sapoutstanding as $data)
                        <tr class="text-center">
                            <td>{{$nomor}}</td>
                            <td>{{$data->GR_Date_Time}}</td>
                            @if ($data->Shipment)
                            <td>{{$data->Shipment}}</td>
                            @else
                            <td>N/A</td>
                            @endif
                            @if ($data->OS_Number)
                            <td>{{$data->OS_Number}}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($data->Vendor_Name)
                            <td>{{$data->Vendor_Name}}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($data->Material_Desc)
                            <td>{{$data->Material_Desc}}</td>
                            @else
                            <td></td>
                            @endif
                            <td class="text-center" style="background-color: rgba(248, 248, 93, 0.884)">{{$data->Status_SAP}}</td>
                        </tr>
                        @php $nomor++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card rounded card-red card-outline">
                <h5 style="margin-top: 10px; text-align:center">Data Error</h5>
                <table class="table" id="table-4">
                    <thead>
                        <tr>
                            <th width="1" style="text-align: center;">No</th>
                            <th style="text-align: center;">GR Date Time</th>
                            <th style="text-align: center;">Surat Jalan</th>
                            <th style="text-align: center;">Nomor OS</th>
                            <th style="text-align: center;">Supplier</th>
                            <th style="text-align: center;">Nama Material/Komponen</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $nomor = 1; @endphp
                            @foreach($saperror as $data)
                        <tr class="text-center">
                            <td>{{$nomor}}</td>
                            <td>{{$data->GR_Date_Time}}</td>
                            @if ($data->Shipment)
                            <td>{{$data->Shipment}}</td>
                            @else
                            <td>N/A</td>
                            @endif
                            @if ($data->OS_Number)
                            <td>{{$data->OS_Number}}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($data->Vendor_Name)
                            <td>{{$data->Vendor_Name}}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($data->Material_Desc)
                            <td>{{$data->Material_Desc}}</td>
                            @else
                            <td></td>
                            @endif
                            <td class="text-center" style="background-color: rgba(248, 93, 93, 0.884)">{{$data->Status_SAP}}</td>
                        </tr>
                        @php $nomor++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function() {
        $('#table-1').DataTable( {
            scrollY:        '40vh',
            scrollCollapse: true,
            paging:         false
        } );
        $('#table-2').DataTable( {
            scrollY:        '40vh',
            scrollCollapse: true,
            paging:         false
        } );
        $('#table-3').DataTable( {
            scrollY:        '40vh',
            scrollCollapse: true,
            paging:         false
        } );
        $('#table-4').DataTable( {
            scrollY:        '40vh',
            scrollCollapse: true,
            paging:         false
        } );
    } );
</script>
@endsection
