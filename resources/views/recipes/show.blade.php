<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Detail</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <a href="{{ route('recipes.index') }}"><img src="{{ asset('Images/logo.png') }}" alt="logo image"></a>
                    <li><a href="{{ route('recipes.index') }}">Home</a></li>
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
        <section class="recipe-detail container">
            <h2 id="recipe-title">{{ $recipe->title }}</h2>
            <img src="" alt="Dish Image" id="recipe-image">
            <p id="recipe-description">{{ $recipe->description }}</p>
            <h3>Ingredients</h3>
            <ul id="recipe-ingredients">
                @if (count($recipe->ingredients) > 0)
                    @foreach($recipe->ingredients as $ingredient)
                        <li>
                            <span style="display: inline-block;width: 40%;">{{ $ingredient->name }}</span>
                            <span style="display: inline-block;width: 40%;padding-left:11rem;">{{ $ingredient->quantity }}</span>
                        </li>
                    @endforeach                              
                @endif
            </ul>
            <h3>Steps</h3>
            <ol id="recipe-steps">
                @if (count($recipe->steps) > 0)
                    @foreach($recipe->steps->sortBy('step_number') as $step)
                        <li>
                            {{ $step->description }}
                        </li>
                    @endforeach                              
                @endif
            </ol>
            <h3>Comments</h3>
            <div id="comments-section">
                <ul id="comments-list">
                    @if (count($recipe->comments) > 0)
                        @foreach($recipe->comments->sortBy('created_at') as $comment)
                            <li>
                                {{ $comment->body }}
                                {{ $comment->user->username }}
                            </li>
                        @endforeach                              
                    @endif
                </ul>
                <div class="add-comment">
                    <h4>Add a Comment</h4>
                    <form method="POST" action="{{ route('comments.store', $recipe->id)}}">
                        @csrf
                        <textarea id="comment-text" name="body" placeholder="Write your comment here..."></textarea>
                        <button type="submit" id="add-comment-btn" class="btn">Submit Comment</button>
                    </form>
                </div>
            </div>
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
