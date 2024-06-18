document.addEventListener("DOMContentLoaded", function() {
    const recipeId = new URLSearchParams(window.location.search).get('id');
    fetchRecipeDetail(recipeId);
    fetchComments(recipeId);

    document.getElementById('add-comment-btn').addEventListener('click', function() {
        addComment(recipeId);
    });
});

function fetchRecipeDetail(id) {
    // Mock data for now
    const mockData = {
        title: "Khinkali",
        image: "/Images/premium-2.png",
        description: "Traditional Georgian meat dumplings with a mix of some greens and soup inside.",
        ingredients: [
            "for 30 Khinkali: Dough - 1.4 kilo of flour (1.1 kilo for the dough and .3 kilo for dusting and kneading)",
            "2 eggs, 450 ml of warm water",
            "700 grams of ground beef and pork mix, salt, half tsp of dried red pepper",
            "quarter tsp ground caraway seed",
            "2 small onions (optional) and 500 ml of water",
            "water and salt for the cooking pot."
        ],
        steps: [
            "Add 1.1 kilo of flour to a mixing bowl. Make a depression in the middle of the flour and add the eggs.",
            "Add 450 ml of warm water.", 
            "Mix the ingredients from the middle of the bowl until all of the flour is mixed.",
            "The dough should be formed into a ball.",
            "Divide the dough into two pieces.",
            "Sprinkle a work surface and one of the balls of dough with flour and knead (very firmly) and fold the dough.",
            "Carefully remove the excess dough."
        ]
    };

    displayRecipeDetail(mockData);
}

function displayRecipeDetail(recipe) {
    document.getElementById('recipe-title').innerText = recipe.title;
    document.getElementById('recipe-image').src = recipe.image;
    document.getElementById('recipe-description').innerText = recipe.description;

    const ingredientsList = document.getElementById('recipe-ingredients');
    recipe.ingredients.forEach(ingredient => {
        const li = document.createElement('li');
        li.textContent = ingredient;
        ingredientsList.appendChild(li);
    });

    const stepsList = document.getElementById('recipe-steps');
    recipe.steps.forEach(step => {
        const li = document.createElement('li');
        li.textContent = step;
        stepsList.appendChild(li);
    });
}

function fetchComments(recipeId) {
    // Mock comments data
    const comments = [
        { username: "user1", text: "Great recipe!" },
        { username: "user2", text: "Loved it, thanks for sharing." }
    ];

    displayComments(comments);
}

function displayComments(comments) {
    const commentsList = document.getElementById('comments-list');
    commentsList.innerHTML = ''; // Clear existing comments
    comments.forEach(comment => {
        const li = document.createElement('li');
        li.innerHTML = `<strong>${comment.username}</strong><p>${comment.text}</p>`;
        commentsList.appendChild(li);
    });
}

function addComment(recipeId) {
    const commentText = document.getElementById('comment-text').value;
    if (commentText.trim()) {
        const newComment = { username: "current_user", text: commentText };

        displayComments([newComment]);

        document.getElementById('comment-text').value = '';

        console.log('New comment added:', newComment);
    } else {
        alert("Comment cannot be empty.");
    }
}
