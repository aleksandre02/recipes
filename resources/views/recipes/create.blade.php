<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <a href="{{ route('dashboard') }}"><img src="{{ asset('Images/logo.png') }}" alt="logo image"></a>
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li><a href="{{ route('recipes.create') }}">Add Recipe</a></li>

                </ul>
                <div class="search-login">
                    <input type="text" placeholder="Search...">
                    <a class="btn" href="{{ route('userdetail') }}">My Profile</a>


                </div>
            </nav>
        </div>
    </header>
    <main>
        <section class="add-recipe container">
            <h2>Add a New Recipe</h2>
            <form id="add-recipe-form" action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="recipe-title">Recipe Title</label>
                <input type="text" id="recipe-title" name="title" required>

                <label for="recipe-photo">Upload Image</label>
                <input type="file" id="recipe-photo" name="media" accept="image/*" required>
              
                <label for="recipe-description">Description</label>
                <textarea id="recipe-description" name="description" rows="3" required></textarea>

                <label for="recipe-ingredients">Ingredients (enter-separated)</label>
                <textarea id="recipe-ingredients" name="ingredients" rows="6" required></textarea>

                <label for="recipe-steps">Steps (enter-separated)</label>
                <textarea id="recipe-steps" name="steps" rows="6" required></textarea>

                <button type="submit" class="btn">Add Recipe</button>
            </form>
        </section>
    </main>
    <footer>
        <div class="container">
            <p>Disclaimer: The recipes provided on this website are for informational purposes only. Please ensure to follow all safety guidelines and check for food allergies before preparing any recipe.</p>
            <span>Copyright © 2017 All Rights Reserved by Scanfcode.</span>
        </div>
    </footer>
</body>
</html>
