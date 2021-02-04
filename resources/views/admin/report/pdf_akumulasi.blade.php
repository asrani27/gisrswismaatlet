<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Data Rekapitulasi</title>
<style type="text/css">
.auto-style4 {
	text-align: center;
}
.auto-style5 {
	font-size: large;
}
.auto-style6 {
	border-style: solid;
    text-align: center;
	border-width: 1px;
}
.auto-style7 {
	border-color: #000000;
	border-width: 0px;
}
.auto-style8 {
	text-align: center;
	border-style: solid;
	border-width: 1px;
	background-color: #D0D0CD;
}
</style>
</head>

<body>

<div class="auto-style4">
	<strong><span class="auto-style5">Data Akumulasi<br />
	</span></strong> </div>
<table cellpadding="2" cellspacing="0" class="auto-style7" style="width: 100%">
	<tr>
		<td class="auto-style8"><strong>No</strong></td>
		<td class="auto-style8"><strong>Kelurahan</strong></td>
		<td class="auto-style8"><strong>Konfirmasi</strong></td>
		<td class="auto-style8"><strong>Suspect</strong></td>
		<td class="auto-style8"><strong>Probable</strong></td>
    </tr>
    @php
        $no =1;
    @endphp
    @foreach ($data as $item)        
	<tr>
		<td class="auto-style6">{{$no++}}</td>
		<td class="auto-style6">{{$item->nama}}</td>
		<td class="auto-style6">{{$item->konfirmasi}}</td>
		<td class="auto-style6">{{$item->suspect}}</td>
		<td class="auto-style6">{{$item->probable}}</td>
	</tr>
    @endforeach
</table>

</body>

</html>
