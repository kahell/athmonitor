<!DOCTYPE html>
<html>
<head>
  <meta name='viewport' content='width=device-width'>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
  <title>A-Monitoring App</title>
</head>
<body bgcolor='#FFFFFF' style='margin: 0 auto;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;/*border: 3px solid #f9f9f9;*/height: 100%;width: 100%!important;'>
  <!-- HEADER -->
  <table class='head-wrap' bgcolor='#f9f9f9' style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif; width: 100.3%;'>
    <tr style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'>
      <td style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'></td>
      <td class='header container' style='margin: 0 auto!important;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;display: block!important;max-width: 600px!important;clear: both!important;'>

        <div class='content' style='margin: 0 auto;padding: 15px;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;max-width: 600px;display: block;'>
          <table bgcolor='#f9f9f9' style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;width: 100%;'>
            <tr style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'>
              <td style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'><img src='https://raw.githubusercontent.com/kahell/athmonitor/master/laravel_logo.png' style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;width: 76px;max-width: 100%;'></td>
              <td align='right' style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'><p style='font-size: 17px;color: #3f6ca4;margin: 0!important;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;margin-bottom: 6px;font-weight: normal;line-height: 1.6;' class='collapse'>Verification Email</p></td>
            </tr>
          </table>
        </div>
      </td>
      <td style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'></td>
    </tr>
  </table><!-- /HEADER -->

  <!-- BODY -->
  <table class='body-wrap' style='margin: 0;padding: 14px 0 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;width: 100%;'>
    <tr style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'>
      <td style='margin: 0;padding: 0;'></td>
      <td class='container' bgcolor='#FFFFFF' style='margin: 0 auto!important;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;display: block!important;max-width: 600px!important;clear: both!important;'>
        <div class='content' style='margin: 0 auto;padding: 15px;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;max-width: 600px;display: block;'>
          <table style='padding-top: 15px;margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;width: 100%;'>
            <tr style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'>
              <td align='center' style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'>
                <p align='center' style='font-size: 14px;margin: 0;padding: 0;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;'>Hi {{$name}}!</p>
                <p align='center' style='line-height: 1.5; font-size: 14px;'>
                  Please click the following link to recovery your account.
                </p>
                <br>
                <a style='text-decoration: none; background-color: #03a9f4; color: #FFF; padding-left: 150px; padding-right: 150px; padding-top: 10px; padding-bottom: 10px;' type='submit' href='{{ url('reset', $verification_code)}}'>
                  Recovery Email
                </a>
                <br>
              </td>
            </tr>
          </table>

        </div><!-- /content -->
      </td>
      <td style='margin: 0;padding: 0;'></td>
    </tr>
  </table>

  <!-- FOOTER -->
  <table class='footer-wrap' style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;width: 100%;clear: both!important;'>
    <tr style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'>
      <td style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'></td>
      <td class='container' style='margin: 0 auto!important;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;display: block!important;max-width: 600px!important;clear: both!important;'>
        <!-- content -->
        <div class='content' style='margin: 0 auto;padding: 15px;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;max-width: 600px;display: block;'>
          <table style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;width: 100%;'>
            <tr>
              <td align='center'>
                <a href='https://www.instagram.com/helfipangestu/' target='_blank' style='color:#000;text-decoration: none'>
                  <img style='width: 28px;height: 28px' src='https://raw.githubusercontent.com/kahell/agivest/master/assets/images/instagram.png' alt='' />
                </a>
                &nbsp;
                <a href='http://line.me/ti/p/@lae3620p' target='_blank' style='color:#000;text-decoration: none'>
                  <img style='width: 28px;height: 28px' src='https://raw.githubusercontent.com/kahell/agivest/master/assets/images/line.png' alt='' />
                </a>
              </td>
            </tr>
            <tr style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'>
              <td align='center' style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'>
                <p style='margin: 0;padding: 0;font-family: Roboto, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;color: #757575'>
                  <a href='http://www.suitdevelopers.com' style='margin: 0;padding: 0;font-family: Roboto, sans-serif;color: #000;'>www.athmonitoring.com</a> &copy; 2018 | All Rights Reserved.
                  <br />Jl. Panjang No.70, RT.6/RW.11, Kb. Jeruk, Jakarta Barat, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta
                  <br style='margin: 0;padding: 0;'>
                </p>
              </td>
            </tr>
          </table>
        </div><!-- /content -->
      </td>
      <td style='margin: 0;padding: 0;font-family:Helvetica Neue, Helvetica Helvetica, Arial, sans-serif;'></td>
    </tr>
  </table><!-- /FOOTER -->
</body>
</html>
