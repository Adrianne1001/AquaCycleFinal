<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to AquaCycle, Ka-Tata!</title>
    </head>

    <body>
        <header>
            <img src="your-company-logo.png" alt="AquaCycle Logo" width="150" height="50">
            <h1>AquaCycle</h1>
        </header>

        <body>
            <p>Hi ,{{ $user->name }}</p>
            <p>Thank you for registering with AquaCycle! To unlock all the features of your account, please verify your email address by clicking the
                button below.</p>
            <a href="{{ $url }}"
                style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; text-decoration: none;">Verify Your Email
                Address</a>
            <p>Once you verify your email, you'll be able to access the Full Feature of our System. And will have the chance to collect points and exchange it with our exclusive Rewards!
            </p>
            <p>If you have any questions, please feel free to contact us at <a>aquacycledorsu@gmail.com</a></p>
        </body>
        <footer>
            <p>&copy; AquaCycle {{ date('Y') }}</p>
        </footer>
    </body>

</html>