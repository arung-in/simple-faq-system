<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .faq-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .like-btn {
            background: #eee;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .like-btn:hover {
            background: #ddd;
        }
        .like-count {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <?php if (isset($title)) : ?>
        <h1><?= htmlspecialchars($title) ?></h1>
    <?php endif; ?> 
    <h1>Frequently Asked Questions</h1>
    
    <div id="faq-container">
        <?php if (isset($faqs) && is_array($faqs)) : ?>
            <?php foreach ($faqs as $faq): ?>
                <div class="faq-item" data-faq-id="<?= $faq['id'] ?>">
                    <h3><?= $faq['title'] ?></h3>
                    <p><?= $faq['content'] ?></p>
                    <!-- <p><?= $csrfToken ?></p> -->
                    <button class="like-btn" onclick="likeFAQ(<?= $faq['id'] ?>)">
                        👍 <span class="like-count"><?= $faq['likes_count'] ?></span>
                    </button>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No FAQs available.</p>
        <?php endif; ?>
    </div>

    <script>
        function likeFAQ(faqId) {
            const csrfToken = "<?= $csrfToken ?? '' ?>";
            fetch('/faqs-api/like', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    faqId: faqId,
                    _csrf_token: csrfToken
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the like count on the page
                    const likeCountElement = document.querySelector(`.faq-item[data-faq-id="${faqId}"] .like-count`);
                    if (likeCountElement) {
                        likeCountElement.textContent = data.newCount;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing your like');
            });
        }
    </script>
</body>
</html>