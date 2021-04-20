<!DOCTYPE html>
<html>

<head>

	<!-- Meta Tag -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$judul?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php $logo_app = $setting->logo_kiri == null ? base_url().'assets/img/favicon.png' : base_url().$setting->logo_kiri; ?>
    <link rel="shortcut icon" href="<?= $logo_app ?>" type="image/x-icon">

	<!-- Required CSS -->
	<!-- v3 -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/v4-shims.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/Ionicons/css/ionicons.min.css">
	<!-- pace-progress -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/pace-progress/themes/silver/pace-theme-center-circle.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- multi select -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/multiselect/css/multi-select.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- summernote -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/summernote/summernote-bs4.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/jquery.toast.min.css">
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/toastr/toastr.min.css">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/dropify/css/dropify.min.css">

	<!-- Datatables Buttons -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

	<!-- textarea editor -->
	<!-- summernote -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/plugins/summernote/summernote-bs4.css">
	<!-- /texarea editor; -->

	<!-- fonts -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/adminlte/dist/css/fonts.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/adminlte/dist/css/adminlte.min.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/app/css/mystyle.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/app/css/show.toast.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    <!-- jQuery -->
    <script src="<?=base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?=base_url()?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="<?=base_url()?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

</head>

<script type="text/javascript">
	let base_url = '<?=base_url()?>';
</script>

<?php

function buat_tanggal($str) {
	$str = str_replace("Jan", "Januari", $str);
	$str = str_replace("Feb", "Februari", $str);
	$str = str_replace("Mar", "Maret", $str);
	$str = str_replace("Apr", "April", $str);
	$str = str_replace("May", "Mei", $str);
	$str = str_replace("Jun", "Juni", $str);
	$str = str_replace("Jul", "Juli", $str);
	$str = str_replace("Aug", "Agustus", $str);
	$str = str_replace("Sep", "September", $str);
	$str = str_replace("Oct", "Oktober", $str);
	$str = str_replace("Nov", "Nopember", $str);
	$str = str_replace("Dec", "Desember", $str);
	$str = str_replace("Mon", "Senin", $str);
	$str = str_replace("Tue", "Selasa", $str);
	$str = str_replace("Wed", "Rabu", $str);
	$str = str_replace("Thu", "Kamis", $str);
	$str = str_replace("Fri", "Jumat", $str);
	$str = str_replace("Sat", "Sabtu", $str);
	$str = str_replace("Sun", "Minggu", $str);
	return $str;
}

function singkat_tanggal($str) {
	$str = str_replace("Jan", "Jan", $str);
	$str = str_replace("Feb", "Feb", $str);
	$str = str_replace("Mar", "Mar", $str);
	$str = str_replace("Apr", "Apr", $str);
	$str = str_replace("May", "Mei", $str);
	$str = str_replace("Jun", "Jun", $str);
	$str = str_replace("Jul", "Jul", $str);
	$str = str_replace("Aug", "Aug", $str);
	$str = str_replace("Sep", "Sep", $str);
	$str = str_replace("Oct", "Okt", $str);
	$str = str_replace("Nov", "Nov", $str);
	$str = str_replace("Dec", "Des", $str);
	$str = str_replace("Mon", "Sen", $str);
	$str = str_replace("Tue", "Sel", $str);
	$str = str_replace("Wed", "Rab", $str);
	$str = str_replace("Thu", "Kam", $str);
	$str = str_replace("Fri", "Jum", $str);
	$str = str_replace("Sat", "Sab", $str);
	$str = str_replace("Sun", "Min", $str);
	return $str;
}

?>

<body class="layout-top-nav layout-navbar-fixed">
	<div class="wrapper">
