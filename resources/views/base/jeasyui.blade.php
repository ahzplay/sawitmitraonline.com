
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SAMO-ADMIN</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/jeasyui/themes/default/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jeasyui/themes/icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jeasyui/themes/color.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jeasyui/demo/demo.css')}}">
    <link rel=”stylesheet” href=”https://openlayers.org/en/v4.6.5/css/ol.css" type=”text/css”>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/css/ol.css" type="text/css">
    <style>
    </style>

    <script type="text/javascript" src="{{asset('js/jeasyui/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jeasyui/jquery.easyui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jeasyui/datagrid-export.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jeasyui/jquery.easyui.patch.js')}}"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/datagrid-detailview.js"></script>

</head>
<body>
<h2>SAMO</h2>
<p>Sawit Mitra Online - Manage Core Data.</p>
<div style="margin:20px 0;"></div>
<div class="easyui-panel" style="padding:5px;">
    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-man'">Home</a>
    <a href="#" class="easyui-menubutton" data-options="menu:'#master-menu', iconCls:'icon-ok'">Master</a>
    <a href="#" class="easyui-menubutton" data-options="menu:'#pks-menu', iconCls:'icon-search'">PKS</a>
    <a href="#" class="easyui-menubutton" data-options="menu:'#mobile-cms-menu',iconCls:'icon-tip'">Mobile CMS</a>
    <a href="#" class="easyui-linkbutton" data-options="plain:true, iconCls:'icon-reload'">Transaction</a>
    <a href="#" class="easyui-menubutton" data-options="menu:'#mm3', iconCls:'icon-help'">Bantuan</a>
    <a href="{{url('logout')}}" class="easyui-linkbutton" data-options="plain:true, iconCls:'icon-lock'">Keluar</a>
</div>
<div id="mobile-cms-menu" style="width:150px;">
    <div onclick="location.href='{{url('/purchase')}}'">Dashboard</div>
    <div onclick="location.href='{{url('/sale')}}'">CPO & TBS</div>
    <div onclick="location.href='{{url('/sale')}}'">Articles</div>
    <div onclick="location.href='{{url('/sale')}}'">Videos</div>
    <!--<div data-options="iconCls:'icon-remove'">Delete</div>-->
</div>
<div id="master-menu" style="width:150px;">
    <div onclick="location.href='{{url('/master-brand')}}'">Users</div>
</div>
<div id="pks-menu" style="width:150px;">
    <div onclick="location.href='{{url('/pks-page')}}'">Data</div>
    <div onclick="location.href='{{url('/master-motorcycle')}}'">PIC</div>
</div>
<div id="mm3" class="menu-content" style="background:#f0f0f0;padding:10px;text-align:left">
    <img src="{{asset('/img/logo-ahz.png')}}" style="width:160px;height:100px">
    {{--<img src="{{asset('/img/motoapp-dealer.png')}}" style="width:200px;height:100px">--}}
    <p style="font-size:14px;color:#444;">
        Sawit Mitra Online. Platform for connecting
        <br>Palm Oil Small Holder and Palm Oil Mills.
        <br><strong>Developed by AHZPlay.</strong>
    </p>

</div>



<p>
    @yield('content')
    @yield('js-add-on')

</p>

</body>
</html>
