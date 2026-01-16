<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventPlanner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="w-full max-w-md bg-white shadow rounded-2xl p-8">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
