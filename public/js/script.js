document.addEventListener("DOMContentLoaded", function() {
    fetchRecipes();
});

function fetchRecipes() {
    fetch('http://your-backend-api-url.com/api/recipes')
        .then(response => response.json())
        .then(data => displayRecipes(data))
        .catch(error => console.error('Error fetching recipes:', error));
}

function displayRecipes(recipes) {
    const recipeList = document.getElementById('recipe-list');
    recipes.forEach(recipe => {
        const recipeItem = document.createElement('div');
        recipeItem.classList.add('recipe-item');
        recipeItem.innerHTML = `
            <img src="${recipe.media}" alt="${recipe.title}">
            <h2>${recipe.title}</h2>
            <p>${recipe.description}</p>
            <a href="recipe-detail/?id=${recipe.id}" class="btn">View Recipe</a>
        `;
        recipeList.appendChild(recipeItem);
    });
}
