<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Website</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    <form action="{{ route('recipes.search') }}" method="GET">
        <input type="text" name="keyword" placeholder="Search...">
        <button type="submit" class="btn">Search</button>

                    <a class="btn" href="{{ route('userdetail') }}">My Profile</a>

                </div>
    </form>

            </nav>
        </div>
    </header>
    <main>
        <section class="recipes container">
            <h2>Today's Recipes</h2>
            <div class="recipe-filters">
                <div class="premium-cards-container">
                    <!-- <div class="recipe-card">
                        <a href="recipe-detail/?id=1">
                            <img src="{{ asset('Images/premium-1.png') }}" alt="premium placeholder">
                            <h4>Soko Kecze</h4>
                            <p>Mushrooms with traditional Georgian cheese Sulguni on top baked in oven.</p>
                            <span>Vegetarian</span>
                        </a>
                    </div>
                    <div class="recipe-card">
                        <a href="recipe-detail/?id=2">
                            <img src="{{ asset('Images/premium-2.png') }}" alt="premium placeholder">
                            <h4>Khinkali</h4>
                            <p>Traditional Georgian meat dumplings with a mix of some greens and soup inside.</p>
                            <span>Meat Based</span>
                        </a>
                    </div>
                    <div class="recipe-card">
                        <a href="recipe-detail/?id=3">
                            <img src="{{ asset('Images/premium-3.png') }}" alt="premium placeholder">
                            <h4>Nigvziani Badrijani</h4>
                            <p>Eggplants cooked with walnut stuffing and fresh pomegranate on top.</p>
                            <span>Vegetarian</span>
                        </a>
                    </div>
                    <div class="recipe-card">
                        <a href="recipe-detail/?id=4">
                            <img src="{{ asset('Images/premium-4.png') }}" alt="premium placeholder">
                            <h4>Qababi</h4>
                            <p>Traditional Georgian food, mixed meat grilled and wrapped in lavashi bread.</p>
                            <span>Meat Based</span>
                        </a>
                    </div>
                    <div class="recipe-card">
                        <a href="recipe-detail/?id=5">
                            <img src="{{ asset('Images/premium-1.png') }}" alt="premium placeholder">
                            <h4>Soko Kecze</h4>
                            <p>Mushrooms with traditional Georgian cheese Sulguni on top baked in oven.</p>
                            <span>Vegetarian</span>
                        </a>
                    </div>
                    <div class="recipe-card">
                        <a href="recipe-detail/?id=6">
                            <img src="{{ asset('Images/premium-2.png') }}" alt="premium placeholder">
                            <h4>Khinkali</h4>
                            <p>Traditional Georgian meat dumplings with a mix of some greens and soup inside.</p>
                            <span>Meat Based</span>
                        </a>
                    </div>
                    <div class="recipe-card">
                        <a href="recipe-detail/?id=7">
                            <img src="{{ asset('Images/premium-3.png') }}" alt="premium placeholder">
                            <h4>Nigvziani Badrijani</h4>
                            <p>Eggplants cooked with walnut stuffing and fresh pomegranate on top.</p>
                            <span>Vegetarian</span>
                        </a>
                    </div>
                    <div class="recipe-card">
                        <a href="recipe-detail/?id=8">
                            <img src="{{ asset('Images/premium-4.png') }}" alt="premium placeholder">
                            <h4>Qababi</h4>
                            <p>Traditional Georgian food, mixed meat grilled and wrapped in lavashi bread.</p>
                            <span>Meat Based</span>
                        </a>
                    </div> -->

                    @foreach ($recipes as $recipe)
                        <div class="recipe-card">
                            <a href="{{ route('recipes.show', $recipe->id) }}">
                            <img src="{{ asset('storage/' . $recipe->media) }}" alt="{{ $recipe->title }}">
                                <h4>{{ $recipe->title }}</h4>
                                <p>{{ $recipe->description }}</p>
                                @if (count($recipe->categories) > 0)
                                    <span class="categories">
                                        {{ $recipe->categories->pluck('name')->implode(', ') }}
                                    </span>                                
                                @endif
                            </a>
                           
                        </div>
                    @endforeach
                </div> 
            </div>
        </section>
        <!-- <section class="hero">
            <div class="hero-content">
                <h2>Best of the week</h2>
                <p>This dish has been selected unanimously across the platform.</p>
                <div class="recipe-card-container"> 
                    <div class="recipe-card chosen">
                        <a href="recipe-detail/?id=1">
                            <img src="{{ asset('Images/premium-1.png') }}" alt="premium placeholder">
                            <h4>Soko Kecze</h4>
                            <p>Mushrooms with traditional Georgian cheese Sulguni on top baked in oven.</p>
                            <span>Vegetarian</span>
                        </a>
                    </div>
                    <div class="tags">
                        <div class="tag">Best Tasting</div>
                        <div class="tag">Best Tasting</div>
                        <div class="tag">Best Tasting</div>
                        <div class="tag">Best Tasting</div>
                        <div class="tag">Best Tasting</div>
                        <div class="tag">Best Tasting</div>
                    </div>
                </div>
            </div>
        </section> -->
        <section class="offer">
            <h2>Exclusive Limited-Time Offer!</h2>
            <p>Unlock premium access to our recipe collection and enjoy exclusive features.</p>
            <div class="premium-cards-container">
                <div class="premium recipe-card">
                    <a href="#">
                        <img src="{{ asset('Images/premium-1.png') }}" alt="premium placeholder">
                        <h4>Soko Kecze</h4>
                        <p>Mushrooms with traditional Georgian cheese Sulguni on top baked in oven.</p>
                        <span>Vegetarian</span>
                    </a>
                </div>
                <div class="premium recipe-card">
                    <a href="#">
                        <img src="{{ asset('Images/premium-2.png') }}" alt="premium placeholder">
                        <h4>Khinkali</h4>
                        <p>Traditional Georgian meat dumplings with a mix of some greens and soup inside.</p>
                        <span>Meat Based</span>
                    </a>
                </div>
                <div class="premium recipe-card">
                    <a href="#">
                        <img src="{{ asset('Images/premium-3.png') }}" alt="premium placeholder">
                        <h4>Nigvziani Badrijani</h4>
                        <p>Eggplants cooked with walnut stuffing and fresh pomegranate on top.</p>
                        <span>Vegetarian</span>
                    </a>
                </div>
                <div class="premium recipe-card">
                    <a href="#">
                        <img src="{{ asset('Images/premium-4.png') }}" alt="premium placeholder">
                        <h4>Qababi</h4>
                        <p>Traditional Georgian food, mixed meat grilled and wrapped in lavashi bread.</p>
                        <span>Meat Based</span>
                    </a>
                </div>
                <a href="buy-premium" class="premium-btn btn">Buy Premium For Just $9.99 <span>$19.99</span></a>
            </div>           
        </section>
    </main>
    <footer>
        <div class="container">
            <p>Disclaimer: The recipes provided on this website are for informational purposes only. Please ensure to follow all safety guidelines and check for food allergies before preparing any recipe.</p>
            <span>Copyright © 2017 All Rights Reserved by Scanfcode.</span>
        </div>
    </footer>
    <!-- <script src="{{ asset('js/scripts.js') }}"></script> -->
</body>
</html>
