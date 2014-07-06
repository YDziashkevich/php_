<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Guest Book</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form class="formInput" method="post">
    <!--INPUT DATA-->
    <fieldset>
        <!-- Form Name -->
        <legend class="formName">Guest book</legend>
        <div class="name">
        <span class="textName">Name:</span>
        {{NAME}}
        </div> <div class="error">{{ERRORNAME}}</div>
        <!--email-->
        <div class="email">
        <span class="textEmail">e-mail:</span>
        {{EMAIL}}
        </div> <div class="error">{{ERROREMAIL}}</div>
        <!--Message-->
        <div class="message">
        <span class="textMessage">Message:</span>
        {{NAME}}
        </div> <div class="error">{{ERRORMESSAGE}}</div>
        <!-- CAPTCHA -->
        <div class="captcha">
            <table class="tableClass"><tr class="trClass">
                    <td>
                        <span class="captchaText">{{CAPTCHA}}</span>
                        <input name="captcha" class="inputCaptcha" type="text">
                    </td>
                    <!-- BUTTON -->
                    <td>
                        <input type="submit" class="inputButton" name="ok" value="OK">
                    </td>
                </tr>
            </table>
        </div>
        <div class="error">{{ERRORCAPTCHA}}</div>
        </fieldset>
    <!-- OUTPUT DATA -->
    <fieldset>
        <!-- Form Messages -->
        <legend class="formMessages">Messages</legend>
        {{MESSAGES}}
        {{PAGINATOR}}
    </fieldset>
    </form>
</body>
</html>