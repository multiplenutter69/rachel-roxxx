<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stefan Framework</title>
        <style type="text/css">
            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/32px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 32px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            p {
                margin: 12px 15px 12px 15px;
            }

            #container {
                width: 600px; 
                height: 300px; 
                border: 1px solid #D0D0D0;
                border-radius: 5px;
                box-shadow: 0 0 8px #D0D0D0;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <h1>Welcome to Stefan Framework!</h1>
            <p>
                <?php echo "<b>Stefan Framework " . SF_VERSION_NUMBER . " - " . SF_VERSION . "</b>"; ?>
            </p>
            <p>
                Welcome to Stefan Framework, the best MVC PHP Framework you will ever tried
            </p>
        </div>
    </body>
</html>
