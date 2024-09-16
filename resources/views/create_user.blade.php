<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <!-- Vite Directive untuk Vanilla CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Ubuntu", sans-serif;
            background: linear-gradient(135deg, #4c4cfa, #6fa3ef);
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .frame {
            padding: 20px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.3); 
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px); 
            width: 480px;
            display: flex;
            justify-content: center;
        }

        .p-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            margin: 20px;
            animation: fadeIn 1.5s ease-out;
        }

        @keyframes fadeIn {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        h1 {
            font-family: 'Pacifico', cursive;
            color: #4c4cfa;
            margin-bottom: 20px;
            text-align: center;
            font-size: 2em;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-15px);
            }
            60% {
                transform: translateY(-10px);
            }
        }

        .p-form__group {
            margin-bottom: 15px;
        }

        .p-form__label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .p-form__input {
            width: 100%;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .p-form__input:focus {
            border-color: #6fa3ef;
        }

        .p-button--positive {
            width: 100%;
            padding: 10px;
            background-color: #4c4cfa;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            animation: pulse 1.5s infinite;
        }

        .p-button--positive:hover {
            background-color: #6fa3ef;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="frame">
        <div class="p-card u-align--center">
            <h1>Create User</h1>

            <form action="{{ route('user.store') }}" method="POST" class="p-form p-form--stacked">
                @csrf

                <div class="p-form__group">
                    <label for="nama" class="p-form__label">Nama:</label>
                    <input type="text" id="nama" name="nama" class="p-form__input" required>
                </div>

                <div class="p-form__group">
                    <label for="npm" class="p-form__label">NPM:</label>
                    <input type="text" id="npm" name="npm" class="p-form__input" required>
                </div>

                <div class="p-form__group">
                    <label for="kelas" class="p-form__label">Kelas:</label>
                    <input type="text" id="kelas" name="kelas" class="p-form__input" required>
                </div>

                <div class="p-form__group">
                    <button type="submit" class="p-button--positive">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>