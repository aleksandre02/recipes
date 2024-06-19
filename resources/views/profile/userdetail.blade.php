<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Detail</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userdetail.css') }}">
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
        <section class="user-detail container">
            <h2>My Profile</h2>
            <div class="user-info">
                <p><strong>Username:</strong> <span id="username">{{ Auth::user()->username }}</span></p>
                <p><strong>Email:</strong> <span id="email">{{ Auth::user()->email }}</span></p>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit">
                {{ __('Logout') }}
            </button>
        </form>
                <!-- Do not display the password for security reasons -->
            </div>
            <h3>My Recipes</h3>
            <div class="recipe-grid" id="user-recipes">
                @foreach(Auth::user()->recipes as $recipe)
                    <div class="recipe-card">
                        <a href="{{ route('recipes.show', $recipe->id) }}">
                            <img src="{{ asset('Images/premium-1.png') }}" alt="premium placeholder">
                            <h4>{{ $recipe->title }}</h4>
                            <p>{{ $recipe->description }}</p>
                            @if($recipe->categories->count() > 0)
                                <span class="categories">{{ $recipe->categories->pluck('name')->implode(', ') }}</span>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
    <footer>
        <div class="container">
            <p>Disclaimer: The recipes provided on this website are for informational purposes only. Please ensure to follow all safety guidelines and check for food allergies before preparing any recipe.</p>
            <span>Copyright © 2017 All Rights Reserved by Scanfcode.</span>
        </div>
    </footer>
    <script src="{{ asset('js/user-detail.js') }}"></script>
</body>
</html>
