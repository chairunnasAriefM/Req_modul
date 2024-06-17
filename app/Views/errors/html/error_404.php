<?php if (ENVIRONMENT !== 'production') : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title><?= lang('Errors.pageNotFound') ?></title>

        <style>
            div.logo {
                height: 200px;
                width: 155px;
                display: inline-block;
                opacity: 0.08;
                position: absolute;
                top: 2rem;
                left: 50%;
                margin-left: -73px;
            }

            body {
                height: 100%;
                background: #fafafa;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                color: #777;
                font-weight: 300;
            }

            h1 {
                font-weight: lighter;
                letter-spacing: normal;
                font-size: 3rem;
                margin-top: 0;
                margin-bottom: 0;
                color: #222;
            }

            .wrap {
                max-width: 1024px;
                margin: 5rem auto;
                padding: 2rem;
                background: #fff;
                text-align: center;
                border: 1px solid #efefef;
                border-radius: 0.5rem;
                position: relative;
            }

            pre {
                white-space: normal;
                margin-top: 1.5rem;
            }

            code {
                background: #fafafa;
                border: 1px solid #efefef;
                padding: 0.5rem 1rem;
                border-radius: 5px;
                display: block;
            }

            p {
                margin-top: 1.5rem;
            }

            .footer {
                margin-top: 2rem;
                border-top: 1px solid #efefef;
                padding: 1em 2em 0 2em;
                font-size: 85%;
                color: #999;
            }

            a:active,
            a:link,
            a:visited {
                color: #dd4814;
            }
        </style>
    </head>

    <body>
        <div class="wrap">
            <h1>404</h1>

            <p>
                <?php if (ENVIRONMENT !== 'production') : ?>
                    <?= nl2br(esc($message)) ?>
                <?php else : ?>
                    <?= lang('Errors.sorryCannotFind') ?>
                <?php endif; ?>
            </p>
        </div>
    </body>

    </html>

<?php else : ?>
    <!-- app/Views/errors/html/error_404.php -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>404 Not Found</title>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f5f5f5;
            }

            .container {
                display: flex;
                flex-direction: row;
                align-items: center;
                text-align: left;
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .image-section img {
                width: 400px;
                /* Adjust based on your image size */
                height: auto;
            }

            .text-section {
                padding: 20px;
                max-width: 300px;
                /* Adjust based on your needs */
            }

            .text-section h1 {
                font-size: 3em;
                color: #2d2d2d;
                margin: 0;
            }

            .text-section p {
                font-size: 1.2em;
                color: #6c6c6c;
                margin: 10px 0;
            }

            .button {
                display: inline-block;
                padding: 10px 20px;
                margin-top: 10px;
                background-color: #ff7f50;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-size: 1em;
            }

            .button:hover {
                background-color: #ff5733;
            }
        </style>
    </head>

    <body>

        <div class="container">
            <div class="image-section">
                <img src="<?= base_url('assets/images/404.jpg') ?>" alt="Person at crossroads">
            </div>
            <div class="text-section">
                <h1>404<br>SORRY!</h1>
                <p>It seems like you directed to the wrong way.</p>
                <a href="<?= base_url() ?>" class="button">Back to home</a>
            </div>
        </div>
    </body>

    </html>
<?php endif; ?>