@extends('base.jeasyui')

@section('content')
    {{Session::get('tokenJwt')}}
    <table id="datagrid-brand" title="PKS Table" class="easyui-datagrid" style="width:100%;height:455px"
           url="{{url('/fetch-pks')}}"
           toolbar="#toolbar" pagination="true"
           rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
        <tr>
            <th field="pks_name" width="20">PKS Name</th>
            <th field="agreement_number" width="20">Agreement</th>
            <th field="sub_district" width="20">Sub District</th>
            <th field="created_at" width="20">Input Date</th>
        </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="create()">New</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Update</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-filter" plain="true" onclick="criteria()">Criteria</a>
    </div>

    <div id="dialog-brand" class="easyui-dialog" style="width:900px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="form-brand" method="post" novalidate style="margin:0;padding:20px 50px">
            <table>
                <tr>
                    <td width="30%">
                        <div style="margin-bottom:10px">
                            <label>PKS Name :</label>
                            <input name="pks_name" class="easyui-textbox" style="width:100%;">
                        </div>
                        <div style="margin-bottom:10px">
                            <label>Agreement Number :</label>
                            <input name="agreement_number" class="easyui-textbox" style="width:100%;">
                        </div>
                        <div style="margin-bottom:10px">
                            <label>Telephone :</label>
                            <input name="telephone" class="easyui-textbox"  style="width:100%;">
                        </div>
                        <div style="margin-bottom:10px">
                            <label>Fax :</label>
                            <input name="fax" class="easyui-textbox"  style="width:100%;">
                        </div>
                    </td>
                    <td width="5%"></td>
                    <td width="30%">
                        <div style="margin-bottom:10px">
                            <label>Address :</label>
                            <input name="address" class="easyui-textbox" data-options="multiline:true" style="width:100%;height:89px">
                        </div>
                        <div style="margin-bottom:10px">
                            <label>SIUP Number :</label>
                            <input name="siup_number" class="easyui-textbox" style="width:100%;">
                        </div>
                        <div style="margin-bottom:10px">
                            <label>NPWP Number :</label>
                            <input name="npwp_number" class="easyui-textbox" style="width:100%;">
                        </div>
                    </td>
                    <td width="5%"></td>
                    <td width="30%">
                        <div style="margin-bottom:10px">
                            <label>Province :</label>
                            <input class="easyui-combobox" id="province-combobox" name="province" required="true" style="width:100%;" data-options="
                                url:'{{url('/fetch-provinces')}}',
                                method:'get',
                                valueField:'code',
                                textField:'name',
                                panelHeight:'auto',
                                labelPosition: 'top',
                                onSelect: function(val){
                                    var url = '{{url('/fetch-cities')}}?code='+val.code;
                                    console.log(url);
                                    $('#city-combobox').combobox('reload', url);
                                }
                            ">
                            {{--<label style="font-size: 8px;">Jika customer tidak ada silahkan <a href="#" onclick="window.open('{{url('/master-customer')}}', '_blank')">input</a> dahulu. <a href="#" onclick="reload_customer_combogrid()">reload data</a> </label>--}}
                        </div>
                        <div style="margin-bottom:10px">
                            <label>City :</label>
                            <input class="easyui-combobox" id="city-combobox" name="city" required="true" style="width:100%;" data-options="
                                method:'get',
                                valueField:'code',
                                textField:'name',
                                panelHeight:'auto',
                                labelPosition: 'top',
                                onSelect: function(val){
                                    var url = '{{url('/fetch-districts')}}?code='+val.code;
                                    console.log(url);
                                    $('#district-combobox').combobox('reload', url);
                                }
                            ">
                            {{--<label style="font-size: 8px;">Jika customer tidak ada silahkan <a href="#" onclick="window.open('{{url('/master-customer')}}', '_blank')">input</a> dahulu. <a href="#" onclick="reload_customer_combogrid()">reload data</a> </label>--}}
                        </div>
                        <div style="margin-bottom:10px">
                            <label>District :</label>
                            <input class="easyui-combobox" id="district-combobox" name="district" required="true" style="width:100%;" data-options="
                                method:'get',
                                valueField:'code',
                                textField:'name',
                                panelHeight:'auto',
                                labelPosition: 'top',
                                onSelect: function(val){
                                    var url = '{{url('/fetch-subDistricts')}}?code='+val.code;
                                    console.log(url);
                                    $('#subDistrict-combobox').combobox('reload', url);
                                }
                            ">
                            {{--<label style="font-size: 8px;">Jika customer tidak ada silahkan <a href="#" onclick="window.open('{{url('/master-customer')}}', '_blank')">input</a> dahulu. <a href="#" onclick="reload_customer_combogrid()">reload data</a> </label>--}}
                        </div>

                        <div style="margin-bottom:10px">
                            <label>Sub District :</label>
                            <input class="easyui-combobox" id="subDistrict-combobox" name="sub_district" required="true" style="width:100%;" data-options="
                                method:'get',
                                valueField:'code',
                                textField:'name',
                                panelHeight:'auto',
                                labelPosition: 'top',
                            ">
                            {{--<label style="font-size: 8px;">Jika customer tidak ada silahkan <a href="#" onclick="window.open('{{url('/master-customer')}}', '_blank')">input</a> dahulu. <a href="#" onclick="reload_customer_combogrid()">reload data</a> </label>--}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                       <div style="margin-bottom:10px">
                           <label>Tentukan Koordinat :</label>
                           <div id="map" class="map" style="height: 300px; width: 500px;"></div>
                       </div>
                    </td>
                    <td width="5%"></td>
                    <td width="30%">
                        <div style="margin-bottom:10px">
                            <label>Longitude :</label>
                            <input id="longitude" name="longitude" class="easyui-textbox" style="width:100%;" >
                        </div>
                        <div style="margin-bottom:10px">
                            <label>Latitude :</label>
                            <input id="latitude" name="latitude" class="easyui-textbox" style="width:100%;" >
                        </div>
                    </td>
                </tr>
            </table>

        </form>
    </div>
    <div id="dialog-criteria" class="easyui-dialog" style="width:900px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="form-brand" method="post" novalidate style="margin:0;padding:20px 50px">
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveBrand()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-brand').dialog('close')" style="width:90px">Cancel</a>
    </div>
@endsection

@section('js-add-on')
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/build/ol.js"></script>
    <script type="text/javascript">
        var map = new ol.Map({
            target: 'map',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([106.8283, 6.1750]),
                zoom: 3
            })
        });

        map.on('click', function(evt){
            console.info(evt.pixel);
            console.info(map.getPixelFromCoordinate(evt.coordinate));
            console.info(ol.proj.toLonLat(evt.coordinate));
            var coords = ol.proj.toLonLat(evt.coordinate);
            var lat = coords[1];
            var lon = coords[0];
            var locTxt = "Latitude: " + lat + " Longitude: " + lon;
            console.log(locTxt);
            $('#latitude').textbox({
                value: lat
            });
            $('#longitude').textbox({
                value: lon
            });
        });
    </script>

    <script type="text/javascript">
        var url;
        function create(){
            $('#dialog-brand').dialog('open').dialog('center').dialog('setTitle','Item baru');
            $('#form-brand').form('clear');
            url = '{{url('/create-pks')}}';
        }

        function criteria(){
            var row = $('#datagrid-brand').datagrid('getSelected');
            if (row){
                $('#dialog-criteria').dialog('open').dialog('center').dialog('setTitle',row.pks_name+' Criteria');
                $('#form-brand').form('load',row);
                url = '{{url('/updateBrand')}}?brandId='+row.brand_id;
            }
        }

        function editUser(){
            var row = $('#datagrid-brand').datagrid('getSelected');
            if (row){
                $('#dialog-brand').dialog('open').dialog('center').dialog('setTitle','Ubah item');
                $('#form-brand').form('load',row);
                url = '{{url('/updateBrand')}}?brandId='+row.brand_id;
            }
        }
        function saveBrand(){
            $('#form-brand').form('submit',{
                url: url,
                iframe: false,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    console.log(result.status);
                    var result = eval('('+result+')');
                    if (result.status){
                        $.messager.show({
                            title: 'Success',
                            msg: result.message
                        });
                        $('#dialog-brand').dialog('close');        // close the dialog
                        $('#datagrid-brand').datagrid('reload');    // reload the user data
                    } else {
                        $.messager.show({
                            title: 'Error',
                            msg: result.message
                        });
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#datagrid-brand').datagrid('getSelected');
            if (row){
                $.messager.confirm('Konfirmasi','Apakah anda ingin menghapus item ini?',function(r){
                    if (r){
                        $.post('{{url('/removeBrand')}}',{brandId:row.brand_id},function(result){
                            if (result.success){
                                $('#datagrid-brand').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>
@endsection


