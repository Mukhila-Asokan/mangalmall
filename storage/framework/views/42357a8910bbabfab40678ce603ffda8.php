<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo e(asset('adminassets/editor_assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminassets/editor_assets/css/range.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('adminassets/editor_assets/css/dropzone.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('adminassets/editor_assets/css/nice-select.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('adminassets/editor_assets/css/spectrum.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminassets/editor_assets/css/font-awesome.min.css')); ?>">
	<link rel="shortcut icon" type="image/ico" href="" />
	<link rel="stylesheet" href="<?php echo e(asset('adminassets/editor_assets/css/typekitcss')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminassets/editor_assets/css/style.css')); ?>">
<style>
		
		/*=============================
		Loader Style
		=============================*/

		.pxg_preloader {
			background-color: #F5F7FF;
			height: 100%;
			width: 100%;
			position: fixed;
			margin-top: 0px;
			top: 0px;
			z-index: 1111111111;
		}

		.pxg_preloader.loaderout {
			display: none;
		}

		.pxg_preloader .pxg_loader_container {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 100px;
			height: 100px;
			border: 3px solid #ebebec;
			border-radius: 50%;
		}

		.pxg_preloader .pxg_loader_container:before {
			position: absolute;
			content: "";
			display: block;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 100px;
			height: 100px;
			border-top: 3px solid var(--pxg-primary-color);
			border-radius: 50%;
			animation: loaderspiner 1.8s infinite ease-in-out;
			-webkit-animation: loaderspiner 1.8s infinite ease-in-out;
		}

		@keyframes loaderspiner {
			0% {
				transform: translate(-50%, -50%) rotate(0deg);
			}

			100% {
				transform: translate(-50%, -50%) rotate(360deg);
			}
		}

		@-webkit-keyframes loaderspiner {
			0% {
				transform: translate(-50%, -50%) rotate(0deg);
			}

			100% {
				transform: translate(-50%, -50%) rotate(360deg);
			}
		}

		.pxg_preloader .pxg_loader_icon {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 80px;
			text-align: center;
		}

		.pxg_preloader .pxg_loader_icon img {
			animation: loaderheart alternate 900ms infinite;
			width: 40px;
		}

		@keyframes loaderheart {
			0% {
				transform: scale(1);
			}

			100% {
				transform: scale(1.2);
			}
		}

		/**/
		/*=============================
		Request Loader Style
		=============================*/

		.request_loader.hidden_loader {
			opacity: 0;
			display: none;
		}
		.request_loader {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: 9999999;
			transition: all 0.3s ease-in;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			background: linear-gradient(91.52deg, #ff479f57 2.41%, #ff783f82 81.75%);
		}
		.request_loader .loader {
			position: relative;
			width: 60px;
			height: 60px;
			border-radius: 50%;
			margin: 75px;
			display: inline-block;
			vertical-align: middle;
		}
		.request_loader .loader-1 .loader_outter {
			position: absolute;
			border: 4px solid var(--pxg-primary-color);
			border-left-color: transparent;
			border-bottom: 0;
			width: 100%;
			height: 100%;
			border-radius: 50%;
			animation: request-loader-1-outter 1s cubic-bezier(0.42, 0.61, 0.58, 0.41) infinite;
		}
		.request_loader .loader-1 .loader_inner {
			position: absolute;
			border: 4px solid var(--pxg-primary-color);
			border-radius: 50%;
			width: 40px;
			height: 40px;
			left: calc(50% - 20px);
			top: calc(50% - 20px);
			border-right: 0;
			border-top-color: transparent;
			animation: request-loader-1-inner 1s cubic-bezier(0.42, 0.61, 0.58, 0.41) infinite;
		}
		@keyframes request-loader-1-outter {
			0% {
			transform: rotate(0deg);
			}
			100% {
			transform: rotate(360deg);
			}
		}
		@keyframes request-loader-1-inner {
			0% {
			transform: rotate(0deg);
			}
			100% {
			transform: rotate(-360deg);
			}
		}

		.lds-ring {
  display: inline-block;
  width: 80px;
  height: 80px; 
}
.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 64px;
  height: 64px;
  margin: 8px;
  border: 8px solid #ccc;
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
}
.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
  animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
  animation-delay: -0.15s;
}
@keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

	</style>

	

    <title><?php echo e($venue->venuename); ?></title>
  </head>
  <body>
	 <!--Preloader Start-->
        <!--div class="pxg_preloader ">
            <div class="pxg_loader_container">
                <div class="pxg_loader_icon">
                    <div class="lds-ring">
					  <div></div>
					  <div></div>
					  <div></div>
					  <div></div>
					</div>
                </div>
            </div>
        </div-->

        <!--Dashboard Start-->
		<!--Processing  Start-->
        <div class="request_loader hidden_loader" id="preloader">
                <div class="loader loader-1">
                    <div class="loader_outter"></div>
                    <div class="loader_inner"></div>
                </div>
            </div>
        <!--Processing Start-->
		
	<div class="mt_main_wrapper">
		<div class="mt_dashboard_section">
			<div class="mt_sidebar_main">
				<div class="mt_mini_toggle">
					<div class="toggle-btn">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
				<div class="mt_sidebar_logos">
					<a href="#"><img src="<?php echo e(asset('adminassets/images/logo-light.png')); ?>" style = "width:75px;" title="" alt="Logo"/></a>
				</div>
				<div class="mt_sidebar_manu">
                <ul class="editorMenus">
						<li class=" mt_hide"><a href="javascript:;" onclick="openSection(this,'text')">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="22" viewBox="0 0 15 22"> <defs><filter id="filter-chain-1" filterUnits="userSpaceOnUse"> <feOffset dx="-15" in="SourceAlpha"/> <feGaussianBlur stdDeviation="4.472" result="dropBlur"/> <feFlood flood-color="#9c46fa" flood-opacity="0.07"/> <feComposite operator="in" in2="dropBlur" result="dropShadowComp"/> <feComposite in="SourceGraphic" result="shadowed"/> <feImage x="0" y="2" width="15" height="19" preserveAspectRatio="none" xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMTUiIGhlaWdodD0iMTkiPjxsaW5lYXJHcmFkaWVudCBpZD0iZ3JhZCIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSI3LjUiIHkxPSIyIiB4Mj0iNy41IiB5Mj0iMTciPgogIDxzdG9wIG9mZnNldD0iMCIgc3RvcC1jb2xvcj0iI2I0NGRmYyIvPgogIDxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzlhNDZmYSIvPgo8L2xpbmVhckdyYWRpZW50Pgo8cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyYWQpIi8+PC9zdmc+"/> <feComposite operator="in" in2="SourceGraphic"/> <feBlend in2="shadowed" result="gradientFill"/></filter> </defs> <path d="M15.000,6.524 L9.706,6.524 L9.706,21.000 L5.294,21.000 L5.294,6.524 L-0.000,6.524 L-0.000,2.000 L14.992,2.000 L15.000,6.524 Z" class="cls-1"/></svg>
						<span>text</span></a>
						</li>
						<li class="mt_hide"><a href="javascript:;" onclick="openSection(this,'image')">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"> <path d="M19.995,9.113 C19.995,9.296 19.980,9.478 19.967,9.791 C19.511,9.422 19.133,9.125 18.764,8.816 C17.435,7.704 16.110,6.586 14.780,5.475 C14.210,4.998 13.741,5.023 13.222,5.574 C12.279,6.577 11.346,7.590 10.370,8.642 C9.537,7.983 8.754,7.368 7.974,6.748 C7.034,6.001 6.679,6.051 5.924,7.015 C4.089,9.354 2.250,11.689 0.411,14.024 C0.324,14.136 0.229,14.241 0.138,14.349 C0.094,14.330 0.050,14.311 0.006,14.292 C0.006,14.068 0.006,13.844 0.006,13.620 C0.004,9.862 0.002,7.280 0.001,3.522 C-0.000,1.313 1.239,-0.000 3.323,0.001 C7.783,0.002 12.243,0.001 16.702,0.008 C18.774,0.012 19.989,1.300 19.995,3.491 C20.000,5.757 19.997,6.847 19.995,9.113 ZM6.898,9.057 C6.975,8.959 7.072,8.878 7.189,8.759 C11.291,12.017 15.379,15.263 19.497,18.533 C18.837,19.537 17.988,19.991 16.919,19.997 C15.653,20.003 14.386,19.996 13.120,19.996 C9.802,19.995 6.484,19.996 3.166,19.991 C1.844,19.990 0.869,19.372 0.319,18.091 C0.239,17.906 0.274,17.557 0.393,17.402 C2.548,14.609 4.724,11.834 6.898,9.057 ZM14.180,7.749 C15.296,8.663 16.491,9.640 17.685,10.617 C18.346,11.159 19.013,11.695 19.664,12.251 C19.804,12.370 19.975,12.562 19.979,12.725 C20.006,13.853 19.994,14.981 19.994,16.288 C17.247,14.107 14.633,12.032 12.045,9.976 C12.759,9.231 13.447,8.513 14.180,7.749 Z" class="cls-1"/></svg>
						<span>image</span></a>
						</li>
						<li class="mt_hide"><a href="javascript:;" onclick="openSection(this,'background')">
						<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21">
						  <path d="M17.963,20.028 C14.676,20.034 11.389,20.034 8.102,20.028 C6.927,20.026 6.061,19.195 6.032,18.025 C6.009,17.088 6.029,16.151 6.033,15.214 C6.033,15.172 6.053,15.130 6.076,15.044 C6.723,15.044 7.346,15.044 8.017,15.044 C8.017,16.018 8.017,16.978 8.017,17.981 C11.357,17.981 14.649,17.981 17.982,17.981 C17.982,14.692 17.982,11.388 17.982,8.036 C17.005,8.036 16.045,8.036 15.057,8.036 C15.057,7.357 15.057,6.725 15.057,6.072 C15.130,6.057 15.199,6.030 15.269,6.030 C16.191,6.027 17.113,6.008 18.035,6.032 C19.184,6.062 20.024,6.925 20.026,8.069 C20.034,11.370 20.034,14.672 20.027,17.974 C20.025,19.163 19.157,20.026 17.963,20.028 ZM11.971,14.033 C8.700,14.045 5.429,14.047 2.158,14.037 C0.856,14.034 0.037,13.176 0.035,11.859 C0.032,10.239 0.034,8.618 0.034,6.997 C0.034,5.392 0.031,3.786 0.035,2.180 C0.038,0.878 0.881,0.036 2.187,0.035 C5.428,0.032 8.669,0.031 11.910,0.035 C13.162,0.036 14.030,0.869 14.035,2.120 C14.048,5.406 14.044,8.692 14.032,11.977 C14.028,13.173 13.168,14.029 11.971,14.033 Z" class="cls-1"/>
						</svg>
						<span>Background</span></a>
						</li>
						<li class="active"><a href="javascript:;" onclick="openSection(this,'customcss')">
						<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21">
						  <path d="M19.652,16.820 L12.499,16.820 L12.499,19.637 L14.188,19.637 C14.560,19.637 14.862,19.942 14.862,20.319 C14.862,20.695 14.560,21.000 14.188,21.000 L6.812,21.000 C6.440,21.000 6.138,20.695 6.138,20.319 C6.138,19.942 6.440,19.637 6.812,19.637 L8.501,19.637 L8.501,16.820 L1.348,16.820 C0.603,16.820 -0.000,16.210 -0.000,15.457 L-0.000,13.967 L21.000,13.967 L21.000,15.457 C21.000,16.210 20.397,16.820 19.652,16.820 ZM-0.000,1.363 C-0.000,0.610 0.603,-0.000 1.348,-0.000 L19.652,-0.000 C20.397,-0.000 21.000,0.610 21.000,1.363 L21.000,12.605 L-0.000,12.605 L-0.000,1.363 ZM13.812,7.883 C13.504,8.095 13.425,8.519 13.635,8.830 C13.766,9.023 13.977,9.127 14.192,9.127 C14.323,9.127 14.455,9.088 14.572,9.008 L17.043,7.302 C17.265,7.149 17.398,6.895 17.398,6.623 C17.398,6.350 17.265,6.096 17.043,5.943 L14.572,4.237 C14.264,4.025 13.845,4.105 13.635,4.416 C13.425,4.726 13.504,5.150 13.812,5.363 L15.637,6.623 L13.812,7.883 ZM8.817,9.650 C8.922,9.709 9.035,9.737 9.147,9.737 C9.382,9.737 9.611,9.612 9.735,9.390 L12.440,4.524 C12.622,4.196 12.507,3.780 12.183,3.596 C11.858,3.411 11.448,3.528 11.265,3.856 L8.560,8.722 C8.378,9.050 8.493,9.465 8.817,9.650 ZM3.957,7.302 L6.428,9.008 C6.544,9.088 6.677,9.127 6.808,9.127 C7.023,9.127 7.234,9.023 7.365,8.830 C7.575,8.519 7.495,8.095 7.188,7.883 L5.363,6.623 L7.188,5.363 C7.495,5.150 7.575,4.726 7.365,4.416 C7.155,4.105 6.736,4.025 6.428,4.237 L3.957,5.943 C3.735,6.096 3.602,6.350 3.602,6.623 C3.602,6.895 3.735,7.149 3.957,7.302 Z" class="cls-1"/>
						</svg>
						<span>custom css/js</span></a>
						</li>
						<li class="mt_hide"><a href="javascript:;" onclick="openSection(this,'form')">
						<svg xmlns="http://www.w3.org/2000/svg" width="17" height="21">
						  <path d="M15.240,21.000 L2.681,21.000 C1.725,21.000 0.947,20.211 0.947,19.242 L0.947,1.758 C0.947,0.788 1.725,-0.000 2.681,-0.000 L11.194,-0.000 L11.194,4.102 C11.194,5.071 11.972,5.859 12.928,5.859 L16.974,5.859 L16.974,19.242 C16.974,20.211 16.196,21.000 15.240,21.000 ZM3.571,10.007 C3.260,10.007 3.009,10.227 3.009,10.500 C3.009,10.772 3.260,10.993 3.571,10.993 C3.882,10.993 4.133,10.772 4.133,10.500 C4.133,10.227 3.882,10.007 3.571,10.007 ZM3.571,13.007 C3.260,13.007 3.009,13.228 3.009,13.500 C3.009,13.772 3.260,13.993 3.571,13.993 C3.882,13.993 4.133,13.772 4.133,13.500 C4.133,13.228 3.882,13.007 3.571,13.007 ZM3.571,16.007 C3.260,16.007 3.009,16.227 3.009,16.500 C3.009,16.772 3.260,16.993 3.571,16.993 C3.882,16.993 4.133,16.772 4.133,16.500 C4.133,16.227 3.882,16.007 3.571,16.007 ZM13.444,10.007 L5.820,10.007 C5.510,10.007 5.258,10.227 5.258,10.500 C5.258,10.773 5.510,10.993 5.820,10.993 L13.444,10.993 C13.755,10.993 14.006,10.773 14.006,10.500 C14.006,10.227 13.755,10.007 13.444,10.007 ZM13.444,13.007 L5.820,13.007 C5.510,13.007 5.258,13.227 5.258,13.500 C5.258,13.773 5.510,13.993 5.820,13.993 L13.444,13.993 C13.755,13.993 14.006,13.773 14.006,13.500 C14.006,13.227 13.755,13.007 13.444,13.007 ZM13.444,16.007 L5.820,16.007 C5.510,16.007 5.258,16.227 5.258,16.500 C5.258,16.773 5.510,16.993 5.820,16.993 L13.444,16.993 C13.755,16.993 14.006,16.773 14.006,16.500 C14.006,16.227 13.755,16.007 13.444,16.007 ZM12.350,4.102 L12.350,0.343 L16.636,4.687 L12.928,4.687 C12.610,4.687 12.350,4.425 12.350,4.102 Z" class="cls-1"/>
						</svg>
						<span>Form</span></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="mt_main_structure">
				<div class="mt_structure_header">
					<div class="toggle-btn">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<div class="mt_header_left">
						<div class="mt_sidebar_logos">
							<a href="#"><img src="<?php echo e(asset('adminassets/images/logo-light.png')); ?>"></a>
						</div>
					</div>
					<div class="mt_st_heading">
                        <h3>Edit - <?php echo e($theme->themename); ?></h3>
					</div>
					
					</div>
				</div><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/editor/header.blade.php ENDPATH**/ ?>