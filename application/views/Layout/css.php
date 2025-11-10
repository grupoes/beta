<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MIA-SISTEMA DE GESTION PARA DESARROLLO DE TESIS</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>public/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>public/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>public/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>public/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>public/assets/css/colors.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="https://docs.handsontable.com/pro/bower_components/handsontable-pro/dist/handsontable.full.min.css">


	<link href="<?php echo base_url()?>public/assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>public/toastr.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>public/fullcalendar.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>public/css/loading-bar.css" rel="stylesheet" type="text/css">
  <!--<link href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">





	<!-- /global stylesheets -->
	<style type="text/css">
	    #iman{
	   	height: 33px;
	  	width: 150px;
	    }

.paneles{

background: #fff;
padding: 200px;

}
  .flotante {
    height: 0px;
    border-bottom: 1px solid #ddd;
    position: fixed;
    top: 140px;
    /* left: 0px; */
    right: 165px;
    z-index: 999999;
    width: 0px;


}

#column-right {
    height: 0px;
    border-bottom: 1px solid #ddd;
    position: fixed;
    top: 150px;
    /* left: 0px; */
    right: 320px;
    z-index: 999999;
    width: 0px;
}

.loader {
  height: 20px;
  width: 250px;
  position: relative;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}
.loader--dot {
  animation-name: loader;
  animation-timing-function: ease-in-out;
  animation-duration: 3s;
  animation-iteration-count: infinite;
  height: 20px;
  width: 20px;
  border-radius: 100%;
  background-color: black;
  position: absolute;
  border: 2px solid white;
}
.loader--dot:first-child {
  background-color: #8cc759;
  animation-delay: 0.5s;
}
.loader--dot:nth-child(2) {
  background-color: #8c6daf;
  animation-delay: 0.4s;
}
.loader--dot:nth-child(3) {
  background-color: #ef5d74;
  animation-delay: 0.3s;
}
.loader--dot:nth-child(4) {
  background-color: #f9a74b;
  animation-delay: 0.2s;
}
.loader--dot:nth-child(5) {
  background-color: #60beeb;
  animation-delay: 0.1s;
}
.loader--dot:nth-child(6) {
  background-color: #fbef5a;
  animation-delay: 0s;
}
.loader--text {
  position: relative;
  top: 200%;
  left: 0;
  right: 0;
  width: 20rem;
  margin: auto;
}
.loader--text:after {
  content: "Espere por favor";
  font-weight: bold;
  animation-name: loading-text;
  animation-duration: 3s;
  animation-iteration-count: infinite;
  font-size:18px;
}

@keyframes loader {
  15% {
    transform: translateX(0);
  }
  45% {
    transform: translateX(230px);
  }
  65% {
    transform: translateX(230px);
  }
  95% {
    transform: translateX(0);
  }
}
@keyframes loading-text {
  0% {
    content: "Espere por favor";
  }
  25% {
    content: "Espere por favor.";
  }
  50% {
    content: "Espere por favor..";
  }
  75% {
    content: "Espere por favor...";
  }
}

._1qkq{
float:left;
margin-left:12px !important;
min-height:1px;
position:relative;
width:52px !important}
._1qkz{
  width:500px !important
}
._1qkq:first-child{
  margin-left:0 !important
}
._1r_y ._1r_z{
  background:#29487d;
  border:none;
  border-radius:3px;
  box-shadow:none;
  color:rgba(255, 255, 255, .5);
  font-size:14px;
  margin-top:2px;
  padding:0;width:100%
  }
._1r_y ._1r_z input{
  box-sizing:border-box;
  color:#fff;
  font-size:14px;
  height:40px;
  line-height:40px;
  padding-left:36px
  }
  ._1r_y ._1r_z input::-webkit-input-placeholder{
    color:rgba(255, 255, 255, .5);
    opacity:1
  }

  ._1r_y ._1s0b{
    background-repeat:no-repeat;
    background-size:26px 244px;
    background-position:0 -170px;
    cursor:pointer;height:16px;
    left:12px;opacity:.4;
    position:absolute;
    top:14px;
    width:16px
    }

  ._1r_y ._1r__._1s0b{opacity:1}

  ._58al{font-family:SF Optimized, system-ui, -apple-system, BlinkMacSystemFont, '.SFNSText-Regular', sans-serif;letter-spacing:-0.01em}
  ._58al::-webkit-input-placeholder{color:rgba(0, 0, 0, .40);text-align:left}
  ._58al{padding:0 54px 0 28px}.fbChatTypeahead
  ._58al{padding:0 98px 0 28px}
  ._58al::-webkit-input-placeholder{color:rgba(0, 0, 0, .40);text-align:center}
  ._58al{background-color:#f6f7f9;border-radius:5px;border-style:none;box-sizing:border-box;font-family:Helvetica Neue, Segoe UI, Helvetica, Arial, sans-serif;font-size:14px;height:30px;line-height:30px;padding:0 28px}
  ._58al{background-color:#f0eeec}
  ._58al{line-height:normal}
  ._58al::-ms-clear{display:none}
  ._58al{width:204px}
  ._58al{background:transparent;border:0;margin:0;outline:0;padding:0;width:100%}._58al::-ms-clear{height:0;width:0}._58al::-webkit-input-placeholder

  ._1s0b{background-repeat:no-repeat;background-size:26px 244px;background-position:0 -170px;cursor:pointer;height:16px;left:12px;opacity:.4;position:absolute;top:14px;width:16px}
  ._1s0b{opacity:1}

	</style>
</head>

