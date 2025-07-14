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
                        <svg height="20" viewBox="0 0 1792 1792" width="20" fill="rgba(0, 140, 255, 1)" xmlns="http://www.w3.org/2000/svg"><path d="M320 1344q0-26-19-45t-45-19q-27 0-45.5 19t-18.5 45q0 27 18.5 45.5t45.5 18.5q26 0 45-18.5t19-45.5zm160-512v640q0 26-19 45t-45 19h-288q-26 0-45-19t-19-45v-640q0-26 19-45t45-19h288q26 0 45 19t19 45zm1184 0q0 86-55 149 15 44 15 76 3 76-43 137 17 56 0 117-15 57-54 94 9 112-49 181-64 76-197 78h-129q-66 0-144-15.5t-121.5-29-120.5-39.5q-123-43-158-44-26-1-45-19.5t-19-44.5v-641q0-25 18-43.5t43-20.5q24-2 76-59t101-121q68-87 101-120 18-18 31-48t17.5-48.5 13.5-60.5q7-39 12.5-61t19.5-52 34-50q19-19 45-19 46 0 82.5 10.5t60 26 40 40.5 24 45 12 50 5 45 .5 39q0 38-9.5 76t-19 60-27.5 56q-3 6-10 18t-11 22-8 24h277q78 0 135 57t57 135z"/></svg> 
                        <span class="like-count"><?= $faq['likes_count'] ?></span>
                    </button>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No FAQs available.</p>
        <?php endif; ?>
    </div>

    <script>
        function likeFAQ(faqId) { 
            if (!Number.isInteger(faqId)) {
                faqId = Number(faqId);
                if (!Number.isInteger(faqId)) {
                    alert("Invalid FAQ ID. Must be an integer.");
                    return;
                }
            }
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