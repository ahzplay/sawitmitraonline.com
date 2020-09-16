@extends('base.jeasyui')

@section('content')
    {{Session::get('tokenJwt')}}
    {{--{{Session::get('isLogin')}}--}}
    <table id="datagrid-pks" title="PKS Table" class="easyui-datagrid" style="width:100%;height:455px"
           url="{{url('/fetch-pks')}}"
           toolbar="#pks-table-toolbar" pagination="true"
           rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
        <tr>
            <th field="id" width="20" hidden="true">id</th>
            <th field="pks_name" width="30">PKS Name</th>
            <th field="agreement_number" width="20">Agreement Number</th>
            <th field="province_code" width="20" hidden="true">Sub District</th>
            <th field="city_code" width="20" hidden="true">Sub District</th>
            <th field="district_code" width="20" hidden="true">Sub District</th>
            <th field="district_name" width="20">District</th>
            <th field="sub_district_code" width="20" hidden="true">Sub District</th>
            <th field="sub_district_name" width="20">Sub District</th>
            <th field="created_at" width="20">Input Date</th>
        </tr>
        </thead>
    </table>
    <div id="pks-table-toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="create()">New</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editPks()">Detail</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyPks()">Remove</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-filter" plain="true" onclick="criteria()">Criteria</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-man" plain="true" onclick="picture()">Picture</a>
    </div>

    <div id="dialog-pks" class="easyui-dialog" style="width:900px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="form-pks" method="post" novalidate style="margin:0;padding:20px 50px">
            <table>
                <tr>
                    <td width="30%">
                        <div style="margin-bottom:10px">
                            <label>PKS Name :</label>
                            <input name="pks_name" class="easyui-textbox"  style="width:100%;">
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
                            <input class="easyui-combobox" id="province-combobox" name="province_code" required="true" style="width:100%;" data-options="
                                url:'{{url('/fetch-provinces')}}',
                                method:'get',
                                valueField:'province_code',
                                textField:'province_name',
                                panelHeight:'auto',
                                labelPosition: 'top',
                                onSelect: function(val){
                                    var url = '{{url('/fetch-cities')}}?code='+val.province_code;
                                    console.log(url);
                                    $('#city-combobox').combobox('reload', url);
                                }
                            ">
                            {{--<label style="font-size: 8px;">Jika customer tidak ada silahkan <a href="#" onclick="window.open('{{url('/master-customer')}}', '_blank')">input</a> dahulu. <a href="#" onclick="reload_customer_combogrid()">reload data</a> </label>--}}
                        </div>
                        <div style="margin-bottom:10px">
                            <label>City :</label>
                            <input class="easyui-combobox" id="city-combobox" name="city_code" required="true" style="width:100%;" data-options="
                                method:'get',
                                valueField:'city_code',
                                textField:'city_name',
                                panelHeight:'auto',
                                labelPosition: 'top',
                                onSelect: function(val){
                                    var url = '{{url('/fetch-districts')}}?code='+val.city_code;
                                    console.log(url);
                                    $('#district-combobox').combobox('reload', url);
                                }
                            ">
                            {{--<label style="font-size: 8px;">Jika customer tidak ada silahkan <a href="#" onclick="window.open('{{url('/master-customer')}}', '_blank')">input</a> dahulu. <a href="#" onclick="reload_customer_combogrid()">reload data</a> </label>--}}
                        </div>
                        <div style="margin-bottom:10px">
                            <label>District :</label>
                            <input class="easyui-combobox" id="district-combobox" name="district_code" required="true" style="width:100%;" data-options="
                                method:'get',
                                valueField:'district_code',
                                textField:'district_name',
                                panelHeight:'auto',
                                labelPosition: 'top',
                                onSelect: function(val){
                                    var url = '{{url('/fetch-subDistricts')}}?code='+val.district_code;
                                    console.log(url);
                                    $('#subDistrict-combobox').combobox('reload', url);
                                }
                            ">
                            {{--<label style="font-size: 8px;">Jika customer tidak ada silahkan <a href="#" onclick="window.open('{{url('/master-customer')}}', '_blank')">input</a> dahulu. <a href="#" onclick="reload_customer_combogrid()">reload data</a> </label>--}}
                        </div>

                        <div style="margin-bottom:10px">
                            <label>Sub District :</label>
                            <input class="easyui-combobox" id="subDistrict-combobox" name="sub_district_code" required="true" style="width:100%;" data-options="
                                method:'get',
                                valueField:'sub_district_code',
                                textField:'sub_district_name',
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
                        {{--<div style="margin-bottom:10px">
                            <center><img id="image1"/></center>
                            <input id="f1" class="easyui-filebox" name="file1" style="width:300px" data-options="
	prompt:'Choose a file...',
	onChange: function(value){
		var f = $(this).next().find('input[type=file]')[0];
		if (f.files && f.files[0]){
			var reader = new FileReader();
			reader.onload = function(e){
			    console.log(e.target.result);
				$('#image1').attr('src', e.target.result);
				$('#image1').attr('height', 100);
			}
			reader.readAsDataURL(f.files[0]);
		}
	}">
                        </div>--}}
                        <div style="margin-bottom:10px">
                            <label>Longitude :</label>
                            <input id="longitude" name="longitude" class="easyui-textbox" style="width:100%;" editable="false">
                        </div>
                        <div style="margin-bottom:10px">
                            <label>Latitude :</label>
                            <input id="latitude" name="latitude" class="easyui-textbox" style="width:100%;" editable="false">
                        </div>
                    </td>
                </tr>
            </table>

        </form>
    </div>

    <div id="dialog-criteria" class="easyui-dialog" style="width:800px; height: 700px; padding: 20px;" data-options="closed:true,modal:true,border:'thin'">
        <center>
            <label style="font-size: 22px;">LATEST PRICE ON <strong>2020/12/28</strong></label>
            <br>
            <label style="font-size: 25px;">--> <strong style="color: darkgreen">Rp 2.489,11</strong> per Kg <--</label>
        </center>
        <br><br>
        <label id="pks-id-hidden"></label>

        <table id="datagrid-tbs-prices" title="TBS Prices" style="width:100%;height:300px"
               toolbar="#toolbar-tbs-prices" pagination="true" idField="id"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
                <th width="50" data-options="field:'id'" >ID</th>
                <th width="50" data-options="field:'pks_id',editor:{type:'numberbox'}" >pks id</th>
                <th width="150" data-options="field:'price_date',align:'left',editor:{type:'datebox'}">Price Date</th>
                <th width="150" data-options="field:'status',
                        formatter:function(value,row){
                            return row.status;
                        },
                        editor:{
                            type:'combobox',
                            options:{
                                height:30,
                                valueField:'status',
                                textField:'status',
                                method:'get',
                                url:'{{url('get-tbs-status')}}',
                                required:true
                            }
                        }">Status</th>
                <th field="price" width="150" data-options="align:'right',editor:{type:'numberbox',options:{precision:2}}">Price</th>
                <th width="150" data-options="field:'price_unit',
                        formatter:function(value,row){
                            return row.price_unit;
                        },
                        editor:{
                            type:'combobox',
                            options:{
                                height:30,
                                valueField:'unit',
                                textField:'unit',
                                method:'get',
                                url:'{{url('get-price-unit')}}',
                                required:true
                            }
                        }">Unit</th>
                {{--<th data-options="field:'status',width:60,align:'center',editor:{type:'checkbox',options:{on:'P',off:''}}">Status</th>--}}
            </tr>
            </thead>
        </table>
        <div id="toolbar-tbs-prices">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#datagrid-tbs-prices').edatagrid('addRow')">New</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#datagrid-tbs-prices').edatagrid('destroyRow')">Remove</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#datagrid-tbs-prices').edatagrid('saveRow')">Save</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#datagrid-tbs-prices').edatagrid('cancelRow')">Cancel</a>
        </div>
        <br><br>
        <table id="datagrid-pks" title="Criteria" class="easyui-datagrid" style="width:100%;height:170px;"
               url="{{url('/fetch-pks')}}"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
                <th field="id" width="20" hidden="true">id</th>
                <th field="pks_name" width="20">Price Date</th>
                <th field="agreement_number" width="20">Price</th>
                <th field="province_code" width="20" >Unit</th>
                <th field="city_code" width="20" >status</th>
            </tr>
            </thead>
        </table>
    </div>

    <div id="dialog-picture" class="easyui-dialog" style="width:600px; height: 550px; padding: 20px;" data-options="closed:true,modal:true,border:'thin'">
        <div class="row">
            <div class="col-md-12 text-center">
                <div id="upload-demo" style="border: grey; border-width: thin;"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <input type="file" id="image">
                <button class="btn btn-outline-primary btn-block upload-image" style="margin-top:2%">Upload Image</button>
            </div>
        </div>
    </div>

    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="savePks()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-pks').dialog('close')" style="width:90px">Cancel</a>
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
            $('#dialog-pks').dialog('open').dialog('center').dialog('setTitle','Ubah item');
            $('#form-pks').form('clear');
            url = '{{url('/create-pks')}}';
        }

        function criteria(){
            var row = $('#datagrid-pks').datagrid('getSelected');
            if (row) {
                $('#dg').datagrid('reload');
                $('#dialog-criteria').dialog('open').dialog('center').dialog('setTitle', row.pks_name );
                $('#pks-id-hidden').html('PKS ID : ' + '<strong>'+row.id+'</strong>');
                $('#form-pks').form('load', row);
                $('#criteria-pks-lable').html(row.pks_name);
                url = '{{url('/updateBrand')}}?brandId=' + row.id;
                $('#datagrid-tbs-prices').datagrid('load', {
                    pksId: row.id,
                });
            }
        }

        function picture(){
            var row = $('#datagrid-pks').datagrid('getSelected');
            if (row) {
                $('#dialog-picture').dialog('open').dialog('center').dialog('setTitle', row.pks_name + ' picture');
            }
        }

        function editPks(){
            var row = $('#datagrid-pks').datagrid('getSelected');
            if (row){
                $('#dialog-pks').dialog('open').dialog('center').dialog('setTitle','Ubah item');
                $('#form-pks').form('load',row);
                url = '{{url('/updateBrand')}}?brandId='+row.brand_id;
            }
        }

        function savePks(){
            $('#form-pks').form('submit',{
                url: url,
                iframe: false,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    console.log(result);
                    var result = eval('('+result+')');
                    if (result.status){
                        $.messager.show({
                            title: 'Success',
                            msg: "Data create."
                        });
                        $('#dialog-pks').dialog('close');        // close the dialog
                        $('#datagrid-pks').datagrid('reload');    // reload the user data
                    } else {
                        $.messager.show({
                            title: 'Error',
                            msg: result.message
                        });
                    }
                }
            });
        }
        function destroyPks(){
            var row = $('#datagrid-pks').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmation','Are you sure to remove this item ?',function(r){
                    if (r){
                        $.post('{{url('destroy-pks')}}',{id:row.id},function(result){
                            if (result.success){
                                console.log(result);
                                $('#datagrid-pks').datagrid('reload');    // reload the user data
                            } else {
                                console.log(result);
                                $.messager.show({
                                    // show error message
                                    title: 'Error',
                                    msg: result.message
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>

    <script type="text/javascript">
        $(function() {
            $('#datagrid-tbs-prices').edatagrid({
                url: '{{url('fetch-tbs-prices')}}',
                saveUrl: '{{url('create-tbs-price')}}',
                /*updateUrl: ...,
                destroyUrl: ...*/
            });
        });
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var resize = $('#upload-demo').croppie({
            enableExif: true,
            enableOrientation: true,
            viewport: { // Default { width: 100, height: 100, type: 'square' }
                width: 400,
                height: 250,
                type: 'square' //square
            },
            boundary: {
                width: 500,
                height: 350
            }
        });


        $('#image').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                resize.croppie('bind',{
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('.upload-image').on('click', function (ev) {
            resize.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (img) {
                $.ajax({
                    url: "",
                    type: "POST",
                    data: {"image":img},
                    success: function (data) {
                        html = '<img src="' + img + '" />';
                        $("#preview-crop-image").html(html);
                    }
                });
            });
        });


    </script>
@endsection


