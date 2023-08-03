<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <script>
        function validateForm() {
            const emailInput = document.getElementById('email');
            const commentInput = document.getElementById('comment');
            const errors = document.getElementById('errors');
            errors.innerHTML = '';

            let isValid = true;

            if (!emailInput.value.trim()) {
                isValid = false;
                errors.innerHTML += '<p>Email is required</p>';
            } else if (!isValidEmail(emailInput.value)) {
                isValid = false;
                errors.innerHTML += '<p>Invalid email format</p>';
            }

            if (!commentInput.value.trim()) {
                isValid = false;
                errors.innerHTML += '<p>Comment is required</p>';
            }

            if (!isValid) {
                errors.style.display = 'block';
                return false;
            }

            return true;
        }

        function isValidEmail(email) {
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(email);
        }
    </script>
    <style>
        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            margin: 0 5px;
            padding: 5px 10px;
            text-decoration: none;
            background-color: #f2f2f2;
            color: #333;
            border-radius: 5px;
        }

        .pagination a.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
<h2>Leave a comment</h2>
<form action="/add-comment" method="post" onsubmit="return validateForm();">
    <input type="text" id="email" name="email" placeholder="Enter your email">
    <input type="text" id="comment" name="comment" placeholder="Enter your comment">
    <button type="submit">Add Comment</button>
</form>
<div id="errors" style="color: red; display: none;"></div>
<h4>Users Comments</h4>
<ul>
    <?php if (!empty($content)) {
        foreach ($content['comments'] as $comment): ?>
            <li><?= $comment['user_email'] ?> : <?= $comment['comment'] ?></li>
        <?php endforeach;
    } ?>
</ul>
<div class="pagination">
    <?php if (!empty($content)) {
        for ($page = 1; $page <= $content['totalPages']; $page++): ?>
            <a href="/?page=<?= $page ?>" class="<?= $page === $content['currentPage'] ? 'active' : '' ?>">
                <?= $page ?>
            </a>
        <?php endfor;
    } ?>
</div>
</body>
</html>
