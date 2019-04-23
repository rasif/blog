<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>404</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:300,700">
        <style>
            *
            {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html,
            body
            {
                height: 100%;
                font-family: 'Quicksand', sans-serif;
                text-align: center;
            }

            .error
            {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .error__title
            {
                font-family: 'Quicksand', sans-serif;
                font-weight: 700;
                font-size: 60px;
                margin-bottom: 20px;
            }

            .error__text
            {
                margin-bottom: 10px;
            }

            .error__link
            {
                color: #5fb1de;
                text-decoration: none;
                font-weight: 300;
            }
        </style>
    </head>
    <body>
        <div class="error">
            <h1 class="error__title">404</h1>
            <p class="error__text">We couldn’t find this page.</p>
            <p class="error__text">
                Maybe it’s out there, somewhere...
                You can always find insightful stories on our 
                <a class="error__link" href="/">homepage</a>.
            </p>
        </div>
    </body>
</html>