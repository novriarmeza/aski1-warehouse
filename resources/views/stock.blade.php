@extends('layout/main')

@section('title', 'Matkomp')

@section('container')
<div class="row" style="margin: 10px">
    <div class="col-md-12">
        <h5 style="margin-top: 10px; text-align:center">REALTIME STOCK MATKOM ASKI PLANT 1</h5>
        <table class="table gr-item" id="table-1">
            <thead>
                <tr>
                    <th width="1" style="text-align: center;">No</th>
                    <th style="text-align: center;">Material</th>
                    <th style="text-align: center;">Nama Material/Komponen</th>
                    <th style="text-align: center;">Stock</th>
                    <th style="text-align: center;">UoM</th>
                    <th style="text-align: center;">Status</th>
                </tr>
            </thead>

            <tbody>
                @php $nomor = 1; @endphp
                    @foreach($stock_detail as $data)
                <tr class="text-center">
                    <td>{{$nomor}}</td>
                    @if ($data->Material)
                    <td>{{$data->Material}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($data->Material_Desc)
                    <td>{{$data->Material_Desc}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($data->selisih)
                    <td>{{round($data->selisih, 2)}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($data->UoM)
                    <td>{{$data->UoM}}</td>
                    @else
                    <td></td>
                    @endif
                    <td>N/A</td>
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
