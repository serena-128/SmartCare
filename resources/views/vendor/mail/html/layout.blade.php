<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="UTF-8" />
  <style type="text/css">
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f3f3f3;
      color: #333333;
      margin: 0;
      padding: 0;
    }
    .wrapper {
      width: 100%;
      background-color: #f3f3f3;
      padding: 20px;
    }
    .content {
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border: 1px solid #e0e0e0;
    }
    .email-header {
      background-color: #4B0082; /* Deep purple */
      padding: 20px;
      text-align: center;
      color: #ffffff;
    }
    .email-header h1 {
      margin: 0;
      font-size: 26px;
      font-weight: 700;
      letter-spacing: 1px;
    }
    .email-body {
      padding: 20px;
      font-size: 16px;
      line-height: 1.5;
    }
    .email-footer {
      background-color: #f3f3f3;
      padding: 20px;
      text-align: center;
      font-size: 12px;
      color: #777777;
    }
    .button {
      background-color: #4B0082;
      color: #ffffff !important;
      padding: 12px 24px;
      text-decoration: none;
      border-radius: 4px;
      display: inline-block;
      margin-top: 20px;
      font-weight: bold;
    }
    @media only screen and (max-width: 600px) {
      .content {
        width: 100% !important;
      }
    }
  </style>
</head>
<body>
  <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
      <td align="center">
        <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
          <!-- Email Header -->
          <tr>
            <td class="email-header">
              <h1>SmartCare</h1>
            </td>
          </tr>
          <!-- Email Body -->
          <tr>
            <td class="email-body">
              {{ Illuminate\Mail\Markdown::parse($slot) }}
            </td>
          </tr>
          <!-- Email Footer -->
          <tr>
            <td class="email-footer">
              &copy; {{ date('Y') }} SmartCare. All rights reserved.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>