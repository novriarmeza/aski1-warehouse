@extends('layout/main')

@section('title', 'Matkomp')

@section('container')
<div class="row" style="margin: 10px">
    <div class="col-md-12">
        <h5 style="margin-top: 10px; text-align:center">DETAIL GR MATKOM ASKI PLANT 1</h5>
        <table class="table gr-item" id="table-1">
            <thead>
                <tr>
                    <th width="1" style="text-align: center;">No</th>
                    <th style="text-align: center;">GR Date Time</th>
                    <th style="text-align: center;">Surat Jalan</th>
                    <th style="text-align: center;">Nomor OS</th>
                    <th style="text-align: center;">Supplier</th>
                    <th style="text-align: center;">Nama Material/Komponen</th>
                    <th style="text-align: center;">Total OS</th>
                    <th style="text-align: center;">Total GR</th>
                    <th style="text-align: center;">Status</th>
                </tr>
            </thead>

            <tbody>
                @php $nomor = 1; @endphp
                    @foreach($gr as $data)
                    @if ($data->TotalOS == $data->TotalGR)
                    @php $status = "bg-success"; @endphp
                    @elseif($data->TotalOS > $data->TotalGR && $data->TotalGR > 0)
                    @php $status = "bg-warning"; @endphp
                    @elseif($data->TotalGR == 0)
                    @php $status = "bg-white"; @endphp
                    @endif
                <tr class="text-center">
                    <td>{{$nomor}}</td>
                    @if ($data->GR_Date)
                    <td>{{$data->GR_Date}}</td>
                    @else
                    <td>N/A</td>
                    @endif
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
                    @if ($data->TotalOS)
                    <td>{{round($data->TotalOS, 2)}}</td>
                    @else
                    <td>0</td>
                    @endif
                    @if ($data->TotalGR)
                    <td>{{round($data->TotalGR, 2)}}</td>
                    @else
                    <td>0</td>
                    @endif
                    @if ($data->TotalOS == $data->TotalGR)
                    <td class="text-center {{$status}}" style="font-weight: bold;">Completed</td>
                    @elseif ($data->TotalOS > $data->TotalGR && $data->TotalGR > 0)
                    <td class="text-center {{$status}}">Partial</td>
                    @elseif($data->TotalGR == 0)
                    <td class="text-center {{$status}}">Belum di GR</td>
                    @endif
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
            scrollY:        '60vh',
            scrollCollapse: true,
            paging:         false
        });
        // setInterval(function(){
        //     $.ajax({
        //         url: '{{url('/reloadgr')}}',
        //         type: 'get',
        //         success:function(response){

        //         }
        //     });
        //     $('load_content').fadeIn("slow");
        // }, 1000);
});
</script>
@endsection
