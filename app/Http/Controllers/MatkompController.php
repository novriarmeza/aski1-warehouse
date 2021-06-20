<?php

namespace App\Http\Controllers;

use App\Tb_Ordersheet;
use App\Tb_GR;
use App\Tb_GI;
use App\Tb_GR_Details;
use App\Tb_Lot_Besar;
use App\Tb_Lot_Kecil;
use App\Tb_PRO;
use App\Tb_STD_LOM_SAP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MatkompController extends Controller
{
    public function index()
    {
        $ospendings = DB::select('select count(jumlah) as jumlah from (select count(dbo.tb_OrderSheet.Row_ID_OS) as jumlah from dbo.tb_OrderSheet left join dbo.tb_GR on dbo.tb_OrderSheet.Row_ID_OS = dbo.tb_GR.Row_ID_OS where dbo.tb_GR.Row_ID_OS is null and dbo.tb_OrderSheet.Delivery_Date <= getdate() and dbo.tb_OrderSheet.Status = ? group by OS_Number) as t1',['Confirmed']);
        $oscompletes = DB::select('select count(jumlah) as jumlah from (select count(dbo.tb_OrderSheet.Row_ID_OS) as jumlah from dbo.tb_OrderSheet inner join dbo.tb_GR on dbo.tb_OrderSheet.Row_ID_OS = dbo.tb_GR.Row_ID_OS inner join dbo.tb_GR_Details on dbo.tb_OrderSheet.Row_ID_OS = dbo.tb_GR_Details.Row_ID_OS where dbo.tb_GR.Cancel_Status is null and dbo.tb_GR_Details.Feedback_GR_SAP = ? and dbo.tb_GR_Details.From_Cancel_GR = ? and dbo.tb_OrderSheet.Status = ? group by OS_Number) as t1',['1','N','Confirmed']);
        $oscancels = DB::select('select count(jumlah) as jumlah from (select count(dbo.tb_OrderSheet.Row_ID_OS) as jumlah from dbo.tb_OrderSheet left join dbo.tb_GR on dbo.tb_OrderSheet.Row_ID_OS = dbo.tb_GR.Row_ID_OS where dbo.tb_GR.Row_ID_OS is null and dbo.tb_OrderSheet.Delivery_Date <= getdate() and dbo.tb_OrderSheet.Status = ? group by OS_Number) as t1',['D']);
        $osnews = DB::select('select count(jumlah) as jumlah from (select count(dbo.tb_OrderSheet.Row_ID_OS) as jumlah from dbo.tb_OrderSheet left join dbo.tb_GR on dbo.tb_OrderSheet.Row_ID_OS = dbo.tb_GR.Row_ID_OS where dbo.tb_GR.Row_ID_OS is null and dbo.tb_OrderSheet.Delivery_Date <= getdate() and dbo.tb_OrderSheet.Status = ? group by OS_Number) as t1',['N']);
        $osdtlpending = DB::select('select OS_Number, Material_Desc, Vendor_Name, Qty, Uom, Delivery_Date from dbo.tb_OrderSheet left join dbo.tb_GR on dbo.tb_OrderSheet.Row_ID_OS = dbo.tb_GR.Row_ID_OS where dbo.tb_GR.Row_ID_OS is null and dbo.tb_OrderSheet.Delivery_Date <= getdate() and dbo.tb_OrderSheet.Status = ? group by OS_Number, Material_Desc, Vendor_Name, Qty, Uom, Delivery_Date',['Confirmed']);
        $osdtlcomplete = DB::select('select OS_Number, Material_Desc, Vendor_Name, Qty, Uom, Delivery_Date from dbo.tb_OrderSheet inner join dbo.tb_GR on dbo.tb_OrderSheet.Row_ID_OS = dbo.tb_GR.Row_ID_OS inner join dbo.tb_GR_Details on dbo.tb_OrderSheet.Row_ID_OS = dbo.tb_GR_Details.Row_ID_OS where dbo.tb_GR.Cancel_Status is null and dbo.tb_GR_Details.Feedback_GR_SAP = ? and dbo.tb_GR_Details.From_Cancel_GR = ? and dbo.tb_OrderSheet.Status = ? group by OS_Number, Material_Desc, Qty, Uom, Delivery_Date,Vendor_Name',['1','N','Confirmed']);

        return view('index', compact('ospendings','oscompletes','oscancels','osnews','osdtlpending','osdtlcomplete'));
    }

    public function gr()
    {
        $gr = DB::select('select sum(Qty) as TotalOS, isnull(sum(qtyGR),0) as TotalGR, Shipment, OS_Number, Material_Desc, Vendor_Name, GR_Date from (select sum(Qty) as Qty, Row_ID_OS, OS_Number, Material, Material_Desc, Vendor_Name from dbo.tb_OrderSheet where dbo.tb_OrderSheet.Status = ? group by OS_Number, Material, Material_Desc, Vendor_Name,Row_ID_OS) as t0
        LEFT JOIN
        (select sum(Qty_Lot_Kecil) as qtyGR, dbo.tb_GR.Row_ID_OS, Shipment,GR_Date from dbo.tb_GR
        inner join dbo.tb_Lot_Kecil on dbo.tb_GR.ID_Lot_Kecil = dbo.tb_Lot_Kecil.ID_Lot_Kecil
        inner join dbo.tb_GR_Details on dbo.tb_GR.Row_ID_GR = dbo.tb_GR_Details.Row_ID_GR
        where dbo.tb_GR.Cancel_Status is null and dbo.tb_GR_Details.Feedback_GR_SAP = ? and dbo.tb_GR_Details.From_Cancel_GR = ?
        group by Shipment,dbo.tb_GR.Row_ID_OS,GR_Date) as t1 on t0.Row_ID_OS = t1.Row_ID_OS group by Shipment, OS_Number, Material_Desc, Vendor_Name,GR_Date order by GR_Date desc',['Confirmed','1','N']);

        return view('gr', compact('gr'));
    }

    public function sap()
    {
        $sapnull = DB::select("select Shipment, OS_Number, Material_Desc, Vendor_Name, Status_SAP,GR_Date_Time from dbo.tb_GR
        inner join dbo.tb_GR_Details on dbo.tb_GR.Row_ID_GR = dbo.tb_GR_Details.Row_ID_GR
        inner join dbo.tb_OrderSheet on dbo.tb_GR.Row_ID_OS = dbo.tb_OrderSheet.Row_ID_OS
        where dbo.tb_GR_Details.Feedback_GR_SAP is null
        group by Shipment, OS_Number, Material_Desc, Vendor_Name, Status_SAP,GR_Date_Time");
        $sapfull = DB::select("select Shipment, OS_Number, Material_Desc, Vendor_Name, Status_SAP,GR_Date_Time from dbo.tb_GR
        inner join dbo.tb_GR_Details on dbo.tb_GR.Row_ID_GR = dbo.tb_GR_Details.Row_ID_GR
        inner join dbo.tb_OrderSheet on dbo.tb_GR.Row_ID_OS = dbo.tb_OrderSheet.Row_ID_OS
        where dbo.tb_GR_Details.Status_SAP= 'FULL'
        group by Shipment, OS_Number, Material_Desc, Vendor_Name, Status_SAP,GR_Date_Time");
        $sapoutstanding = DB::select("select Shipment, OS_Number, Material_Desc, Vendor_Name, Status_SAP,GR_Date_Time from dbo.tb_GR
        inner join dbo.tb_GR_Details on dbo.tb_GR.Row_ID_GR = dbo.tb_GR_Details.Row_ID_GR
        inner join dbo.tb_OrderSheet on dbo.tb_GR.Row_ID_OS = dbo.tb_OrderSheet.Row_ID_OS
        where dbo.tb_GR_Details.Status_SAP= 'OUTSTANDING'
        group by Shipment, OS_Number, Material_Desc, Vendor_Name, Status_SAP,GR_Date_Time");
        $saperror = DB::select("select Shipment, OS_Number, Material_Desc, Vendor_Name, Status_SAP,GR_Date_Time from dbo.tb_GR
        inner join dbo.tb_GR_Details on dbo.tb_GR.Row_ID_GR = dbo.tb_GR_Details.Row_ID_GR
        inner join dbo.tb_OrderSheet on dbo.tb_GR.Row_ID_OS = dbo.tb_OrderSheet.Row_ID_OS
        where dbo.tb_GR_Details.Status_SAP!= 'FULL' and dbo.tb_GR_Details.Status_SAP!= 'OUTSTANDING'
        group by Shipment, OS_Number, Material_Desc, Vendor_Name, Status_SAP,GR_Date_Time");

        return view('feedbacksap', compact('sapnull','sapfull','sapoutstanding','saperror'));
    }

    public function stock()
    {
        // $stock_detail = DB::select("select sum(kecil.Qty_Lot_Kecil)as qtygr,case when "."sap.UoM"." = 'KG' then isnull(sum(gi.Qty_Lot_Kecil),0)/1000 else isnull(sum(gi.Qty_Lot_Kecil),0) end as qtygi,(sum(kecil.Qty_Lot_Kecil)-case when "."sap.UoM"." = 'KG' then isnull(sum(gi.Qty_Lot_Kecil),0)/1000 else isnull(sum(gi.Qty_Lot_Kecil),0) end) as selisih ,besar.Material,besar.Material_Desc, sap.Max_Stock, sap.Min_Stock,sap.UoM from dbo.tb_Lot_Kecil as kecil left join dbo.tb_Lot_Besar as besar on kecil.ID_Lot_Besar = besar.ID_Lot_Besar right join dbo.tb_GR as gr on gr.ID_Lot_Kecil = kecil.ID_Lot_Kecil left join dbo.tb_GI as gi on gr.ID_Lot_Kecil = gi.ID_Lot_Kecil left join dbo.tb_STD_LOM_SAP as sap on besar.Material = sap.Material group by besar.Material,besar.Material_Desc,sap.Max_Stock,sap.Min_Stock,sap.UoM,sap.UoM");
        $stock_detail = DB::select("select sum(kecil.Qty_Lot_Kecil)as qtygr,case when sap.UoM = 'KG' then isnull(sum(gi.Qty_Lot_Kecil),0)/1000 else isnull(sum(gi.Qty_Lot_Kecil),0) end as qtygi,(sum(kecil.Qty_Lot_Kecil)-case when sap.UoM = 'KG' then isnull(sum(gi.Qty_Lot_Kecil),0)/1000 else isnull(sum(gi.Qty_Lot_Kecil),0) end) as selisih ,besar.Material,besar.Material_Desc, sap.Max_Stock, sap.Min_Stock,sap.UoM
        from dbo.tb_Lot_Kecil as kecil
        inner join dbo.tb_Lot_Besar as besar on kecil.ID_Lot_Besar = besar.ID_Lot_Besar
        right join dbo.tb_GR as gr on gr.ID_Lot_Kecil = kecil.ID_Lot_Kecil
        inner join dbo.tb_GR_Details as grd on grd.Row_ID_GR = gr.Row_ID_GR
        left join dbo.tb_GI as gi on gr.ID_Lot_Kecil = gi.ID_Lot_Kecil
        left join dbo.tb_STD_LOM_SAP as sap on besar.Material = sap.Material
        where gr.Cancel_Status is null and grd.Feedback_GR_SAP = 1 and grd.From_Cancel_GR = 'N'
        group by besar.Material,besar.Material_Desc,sap.Max_Stock,sap.Min_Stock,sap.UoM,sap.UoM");
        // $stockkritiss = DB::select("select count(t1.selisih) as jumlah from (select (sum(kecil.Qty_Lot_Kecil)-case when sap.UoM = 'KG' then isnull(sum(gi.Qty_Lot_Kecil),0)/1000 else isnull(sum(gi.Qty_Lot_Kecil),0) end) as selisih,besar.Material,besar.Material_Desc, sap.Max_Stock, sap.Min_Stock,sap.UoM from dbo.tb_Lot_Kecil as kecil left join dbo.tb_Lot_Besar as besar on kecil.ID_Lot_Besar = besar.ID_Lot_Besar right join dbo.tb_GR as gr on gr.ID_Lot_Kecil = kecil.ID_Lot_Kecil left join dbo.tb_GI as gi on gr.ID_Lot_Kecil = gi.ID_Lot_Kecil left join dbo.tb_STD_LOM_SAP as sap on besar.Material = sap.Material group by besar.Material,besar.Material_Desc,sap.Max_Stock,sap.Min_Stock,sap.UoM,sap.UoM) as t1 where t1.selisih < t1.Min_Stock");
        // $overstocks = DB::select("select count(t1.selisih) as jumlah from (select (sum(kecil.Qty_Lot_Kecil)-case when sap.UoM = 'KG' then isnull(sum(gi.Qty_Lot_Kecil),0)/1000 else isnull(sum(gi.Qty_Lot_Kecil),0) end) as selisih,besar.Material,besar.Material_Desc, sap.Max_Stock, sap.Min_Stock,sap.UoM from dbo.tb_Lot_Kecil as kecil left join dbo.tb_Lot_Besar as besar on kecil.ID_Lot_Besar = besar.ID_Lot_Besar right join dbo.tb_GR as gr on gr.ID_Lot_Kecil = kecil.ID_Lot_Kecil left join dbo.tb_GI as gi on gr.ID_Lot_Kecil = gi.ID_Lot_Kecil left join dbo.tb_STD_LOM_SAP as sap on besar.Material = sap.Material group by besar.Material,besar.Material_Desc,sap.Max_Stock,sap.Min_Stock,sap.UoM,sap.UoM) as t1 where t1.selisih > t1.Max_Stock");
        // $stocknormals = DB::select("select count(t1.selisih) as jumlah from (select (sum(kecil.Qty_Lot_Kecil)-case when sap.UoM = 'KG' then isnull(sum(gi.Qty_Lot_Kecil),0)/1000 else isnull(sum(gi.Qty_Lot_Kecil),0) end) as selisih,besar.Material,besar.Material_Desc, sap.Max_Stock, sap.Min_Stock,sap.UoM from dbo.tb_Lot_Kecil as kecil left join dbo.tb_Lot_Besar as besar on kecil.ID_Lot_Besar = besar.ID_Lot_Besar right join dbo.tb_GR as gr on gr.ID_Lot_Kecil = kecil.ID_Lot_Kecil left join dbo.tb_GI as gi on gr.ID_Lot_Kecil = gi.ID_Lot_Kecil left join dbo.tb_STD_LOM_SAP as sap on besar.Material = sap.Material group by besar.Material,besar.Material_Desc,sap.Max_Stock,sap.Min_Stock,sap.UoM,sap.UoM) as t1 where t1.selisih < t1.Max_Stock and t1.selisih > t1.Min_Stock");

        return view('stock', compact('stock_detail'));
    }

}
