<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentsettings>
            <o:AllowPNG />
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentsettings>
    </xml>
    <![endif]-->
    <!--[if gt mso 15]>
    <style type="text/css" media="all">
        /* Outlook 2016 Height Fix */
        table, tr, td {border-collapse : collapse;}
        
        tr { font-size : 0px; line-height : 0px; border-collapse : collapse; }
    </style>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <meta name="robots" content="noindex, nofollow">
    <title>Order Confirmation Email</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
    
    <link rel="preload" href="{{ asset('/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2') }}" as="font"
          type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}" as="font"
          type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}" as="font"
          type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('/assets/fonts/wolmart.woff?png09e') }}" as="font" type="font/woff"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            margin                   : 0;
            padding                  : 0;
            mso-line-height-rule     : exactly;
            -ms-text-size-adjust     : 100%;
            -webkit-text-size-adjust : 100%;
        }
        
        body, table, td, p, a, li {
            -webkit-text-size-adjust : 100%;
            -ms-text-size-adjust     : 100%;
            font-family              : 'Lato', Arial, Helvetica, sans-serif;
        }
        
        table td {
            border-collapse : collapse;
        }
        
        table {
            border-spacing  : 0;
            border-collapse : collapse;
            border-color    : #FFFFFF;
        }
        
        p, a, li, td, blockquote {
            mso-line-height-rule : exactly;
        }
        
        p, a, li, td, body, table, blockquote {
            -ms-text-size-adjust     : 100%;
            -webkit-text-size-adjust : 100%;
        }
        
        img, a img {
            border          : 0;
            outline         : none;
            text-decoration : none;
        }
        
        img {
            -ms-interpolation-mode : bicubic;
        }
        
        * img[tabindex="0"] + div {
            display : none !important;
        }
        
        a[href^=tel], a[href^=sms], a[href^=mailto], a[href^=date] {
            color           : inherit;
            cursor          : default;
            text-decoration : none;
        }
        
        a[x-apple-data-detectors] {
            color           : inherit !important;
            text-decoration : none !important;
            font-size       : inherit !important;
            font-family     : inherit !important;
            font-weight     : inherit !important;
            line-height     : inherit !important}
        
        .logo {
            width  : 220px !important;
            height : 35px !important;
        }
        
        .logo-footer {
            width  : 129px !important;
            height : 29px !important;
        }
        
        .table-container .alert-icon {
            width  : 120px !important;
            height : 120px !important;
        }
        
        .table-container .avatar-img {
            width  : 64px !important;
            height : 64px !important;
        }
        
        .x-gmail-data-detectors, .x-gmail-data-detectors * {
            border-bottom : 0 !important;
            cursor        : default !important}
        
        form textarea {
            width     : 100%;
            max-width : 100%;
        }
        
        @media screen {
            body {
                font-family : 'Lato', Arial, Helvetica, sans-serif;
            }
        }
        
        @media only screen and (max-width : 640px) {
            body {
                margin  : 0px !important;
                padding : 0px !important;
            }
            
            body, table, td, p, a, li, blockquote {
                -webkit-text-size-adjust : none !important;
            }
            
            .table-main, .table-container, .social-icons, table, .table-container td {
                width     : 100% !important;
                min-width : 100% !important;
                margin    : 0 !important;
                float     : none !important;
            }
            
            .table-container img {
                width     : 100% !important;
                max-width : 100% !important;
                display   : block;
                height    : auto !important;
            }
            
            .table-container a {
                width     : 50% !important;
                max-width : 100% !important;
            }
            
            .table-container .logo {
                width  : 200px !important;
                height : 30px !important;
            }
            
            .table-container .alert-icon {
                width  : 120px !important;
                height : 120px !important;
            }
            
            .social-icons {
                float        : none !important;
                margin-left  : auto !important;
                margin-right : auto !important;
                width        : 220px !important;
                max-width    : 220px !important;
                min-width    : 220px !important;
                background   : #f1f1f1 !important;
            }
            
            .social-icons td {
                width      : auto !important;
                min-width  : 1% !important;
                margin     : 0 !important;
                float      : none !important;
                text-align : center;
            }
            
            .social-icons td a {
                width     : auto !important;
                max-width : 100% !important;
                font-size : 10px !important;
            }
            
            .mobile-title {
                font-size : 34px !important;
            }
            
            .table-container .logo-footer {
                width         : 129px !important;
                height        : 29px !important;
                margin-bottom : 20px !important;
            }
            
            .block-img {
                width         : 100%;
                height        : auto;
                margin-bottom : 20px;
            }
            
            .info-block {
                padding : 0 !important;
            }
            
            .video-img {
                width  : 100% !important;
                height : auto !important;
            }
            
            .post-footer-container td {
                text-align : center !important;
                padding    : 0 40px 0 40px !important;
            }
        }
    
    </style>
</head>
<body style="padding: 0; margin: 0; -webkit-font-smoothing:antialiased; background-color:#f1f1f1; -webkit-text-size-adjust:none;">
<!--Main Parent Table -->
<table width="100%" border="0" cellpadding="0" direction="ltr" bgcolor="#f1f1f1" cellspacing="0" role="presentation"
       style="width: 640px; min-width: 640px; margin:0 auto 0 auto;">
    <tbody>
    <tr>
        <td>
            <!--Content Starts Here -->
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="640"
                   style="width: 640px; min-width: 640px;" role="presentation" bgcolor="#f1f1f1">
                <tr>
                    <td height="30" style="line-height:30px;min-height:30px;">
                    </td>
                </tr>
            </table>
            <!--Top Header Starts Here -->
            <table border="0" bgcolor="#fff" cellpadding="0" cellspacing="0" width="640" role="presentation"
                   width="640" style="width: 640px; min-width: 640px;" align="center" class="table-container ">
                <tbody>
                <tr width="640" style="width: 640px; min-width: 640px; " align="center">
                    <td>
                        <table cellpadding="0" cellspacing="0" border="0" align="center" width="640"
                               style="width: 640px; min-width: 640px;" role="presentation" bgcolor="#fff">
                            <tr>
                                <td height="35" style="line-height:35px;min-height:35px;">
                                </td>
                            </tr>
                        </table>
                        <table cellpadding="0" cellspacing="0" border="0" width="640"
                               style="width: 640px; min-width: 640px;" role="presentation" align="center"
                               bgcolor="#fff">
                            <tr>
                                <td align="left">
                                    <table cellpadding="0" cellspacing="0" border="0" role="presentation" align="center"
                                           bgcolor="#fff">
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" border="0" align="center"
                                                       role="presentation">
                                                    <tr>
                                                        <td align="center">
                                                            <img src="{{ serverPath (optional (siteSettings () -> settings) -> logo) }}"
                                                                 alt="Logo" width="220" class="logo">
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table cellpadding="0" cellspacing="0" border="0" align="center"
                                                       width="640" style="width: 640px; min-width: 640px;"
                                                       role="presentation" bgcolor="#fff">
                                                    <tr>
                                                        <td height="35" style="line-height:35px;min-height:35px;">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <!--Top Header Ends Here -->
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="640"
                   style="width: 640px; min-width: 640px;" role="presentation" bgcolor="#f7f8fb">
                <tr>
                    <td height="30" style="line-height:30px;min-height:30px;">
                    </td>
                </tr>
            </table>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="640" role="presentation"
                   bgcolor="#f7f8fb" class="table-container ">
                <tbody>
                <tr>
                    <td align="left"
                        style="color:#45535C;padding:20px 40px 0 40px;font-family: 'Lato', Arial, Helvetica, sans-serif;font-weight:800;font-size:34px;-webkit-font-smoothing:antialiased;line-height:1.2;"
                        class="table-container mobile-title">
                        Hi, {{ $user -> name }}!
                    </td>
                </tr>
                <tr>
                    <td align="left"
                        style="color:#5a5a5a;padding:20px 40px 0 40px;font-family: 'Lato', Arial, Helvetica, sans-serif;font-weight:normal;font-size:16px;-webkit-font-smoothing:antialiased;line-height:1.4;"
                        class="table-container">
                        Thank you for your purchase. Your order is being processed and will be on its way shortly. You
                        will
                        receive another email with tracking information once your order is dispatched.
                    </td>
                </tr>
                </tbody>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="640"
                   style="width: 640px; min-width: 640px;" role="presentation" bgcolor="#f7f8fb">
                <tr>
                    <td height="60" style="line-height:60px;min-height:60px;">
                    </td>
                </tr>
            </table>
            <table cellpadding="10px" cellspacing="0" border="1" align="center"
                   style="width: 640px; min-width: 640px; margin: 0 auto">
                <thead>
                <tr>
                    <td align="left" colspan="2">
                        Sale ID #
                    </td>
                    <td>
                        {{ $sale -> sale_id }}
                    </td>
                </tr>
                </thead>
                <tbody style="background: #FFFFFF">
                @if(count ($sale -> products) > 0)
                    @foreach($sale -> products as $product)
                        <tr>
                            <td align="left" width="20%">
                                <img src="{{ serverPath ($product ?-> product -> image) }}"
                                     alt="{{ $product ?-> product -> title() }}" style="height: 50px" />
                            </td>
                            <td width="60%">
                                {{ $product -> product -> title() }} ({{ $product -> quantity }})
                            </td>
                            <td width="20%">
                                {{ number_format ($product -> net_price, 2) }}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2">
                        TOTAL
                    </td>
                    <td>
                        {{ number_format ($sale -> total, 2) }}
                    </td>
                </tr>
                @if($sale -> coupon)
                    <tr>
                        <td colspan="2">
                            Coupon Code
                        </td>
                        <td>
                            {{ $sale -> coupon ?-> code }}
                            ({{ number_format ($sale -> percentage_discount, 2) }}%)
                        </td>
                    </tr>
                @endif
                <tr>
                    <td colspan="2">
                        SHIPPING
                    </td>
                    <td>
                        {{ number_format ($sale -> shipping, 2) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        NET
                    </td>
                    <td>
                        {{ number_format ($sale -> net, 2) }}
                    </td>
                </tr>
                </tfoot>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="640"
                   style="width: 640px; min-width: 640px;" role="presentation" bgcolor="#FFFFFF">
                <tr>
                    <td height="60" style="line-height:60px;min-height:60px;">
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="640"
                   style="width: 640px; min-width: 640px;" bgcolor="#FFFFFF" role="presentation"
                   class="table-container ">
                <tbody>
                <tr>
                    <td style="padding:0 40px;">
                        <table cellpadding="0" cellspacing="0" border="0" align="left" width="270" role="presentation"
                               class="table-container">
                            <tbody>
                            <tr>
                                <td height="20" style="line-height:20px;min-height:20px;">
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top"
                                    style="color: #111111; font-family: 'Lato', Arial, Helvetica, sans-serif; font-size: 16px; line-height: 16px;font-weight:bold;">
                                    Delivery address:
                                </td>
                            </tr>
                            <tr>
                                <td height="10" style="line-height:10px;min-height:10px;">
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top"
                                    style="color: #111111; font-family: 'Lato', Arial, Helvetica, sans-serif; font-size: 14px; line-height: 14px;font-weight:normal;">
                                    {{ $sale -> customer -> address }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="640"
                   style="width: 640px; min-width: 640px;" role="presentation" bgcolor="#FFFFFF">
                <tr>
                    <td height="60" style="line-height:60px;min-height:60px;">
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="640"
                   style="width: 640px; min-width: 640px;" bgcolor="#f7f8fb" role="presentation"
                   class="table-container ">
                <tbody>
                <tr>
                    <td style="padding:0 40px;">
                        <table cellpadding="0" cellspacing="0" border="0" align="left" role="presentation"
                               class="table-container">
                            <tbody>
                            <tr>
                                <td height="20" style="line-height:20px;min-height:20px;">
                                    <br />
                                    We appreciate your business and strive to provide you with the best service
                                    possible. If you have
                                    any questions or need to make changes to your order, please do not hesitate to
                                    contact us.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="640"
                   style="width: 640px; min-width: 640px;" role="presentation" bgcolor="#f7f8fb">
                <tr>
                    <td height="30" style="line-height:30px;min-height:30px;"></td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="640"
                   style="width: 640px; min-width: 640px;" role="presentation" bgcolor="#f7f8fb">
                <tr>
                    <td height="30" style="line-height:30px;min-height:30px;" align="center">
                        @if(!empty(trim (optional (siteSettings () -> settings) -> facebook)))
                            <a href="{{ optional (siteSettings () -> settings) -> facebook }}"
                               style="text-decoration: none;color: #000;margin-right: 10px;padding-bottom: 50px;">
                                <img src="{{ asset ('/assets/images/social/facebook-brands.png') }}"
                                     style="height: 20px;" />
                            </a>
                        @endif
                        
                        @if(!empty(trim (optional (siteSettings () -> settings) -> twitter)))
                            <a href="{{ optional (siteSettings () -> settings) -> twitter }}"
                               style="text-decoration: none;color: #000;margin-right: 10px;padding-bottom: 50px;">
                                <img src="{{ asset ('/assets/images/social/twitter-brands.png') }}"
                                     style="height: 20px;" />
                            </a>
                        @endif
                        
                        @if(!empty(trim (optional (siteSettings () -> settings) -> instagram)))
                            <a href="{{ optional (siteSettings () -> settings) -> instagram }}"
                               style="text-decoration: none;color: #000;margin-right: 10px;padding-bottom: 50px;">
                                <img src="{{ asset ('/assets/images/social/instagram-brands.png') }}"
                                     style="height: 20px;" />
                            </a>
                        @endif
                        
                        @if(!empty(trim (optional (siteSettings () -> settings) -> youtube)))
                            <a href="{{ optional (siteSettings () -> settings) -> youtube }}"
                               style="text-decoration: none;color: #000;margin-right: 10px;padding-bottom: 50px;">
                                <img src="{{ asset ('/assets/images/social/youtube-brands.png') }}"
                                     style="height: 20px;" />
                            </a>
                        @endif
                        
                        @if(!empty(trim (optional (siteSettings () -> settings) -> pinterest)))
                            <a href="{{ optional (siteSettings () -> settings) -> pinterest }}"
                               style="text-decoration: none;color: #000;margin-right: 10px;padding-bottom: 50px;">
                                <img src="{{ asset ('/assets/images/social/pinterest-brands.png') }}"
                                     style="height: 20px;" />
                            </a>
                        @endif
                        
                        @if(!empty(trim (optional (siteSettings () -> settings) -> tiktok)))
                            <a href="{{ optional (siteSettings () -> settings) -> tiktok }}"
                               style="text-decoration: none;color: #000;margin-right: 10px;padding-bottom: 50px;">
                                <img src="{{ asset ('/assets/images/social/icons8-tiktok-30.png') }}"
                                     style="height: 20px;" />
                            </a>
                        @endif
                        
                        @if(!empty(trim (optional (siteSettings () -> settings) -> whatsapp)))
                            <a href="{{ optional (siteSettings () -> settings) -> whatsapp }}"
                               style="text-decoration: none;color: #000;margin-right: 10px;padding-bottom: 50px;">
                                <img src="{{ asset ('/assets/images/social/whatsapp-brands.png') }}"
                                     style="height: 20px;" />
                            </a>
                        @endif
                    </td>
                </tr>
            </table>
            <!--Bottom Section Ends Here -->
            <!--Main Td  Ends Here -->
        </td>
    </tr>
    </tbody>
    <!--Main Parent Table Ends Here -->
</table>
</body>
</html>