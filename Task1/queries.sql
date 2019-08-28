# 1. запрос на постановку лайка от юзера к новости;
INSERT INTO likes (user_id, post_id) VALUES(:user_id, :post_id);

# 2. запрос на отмену лайка;
DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id;

# 3. выборка пользователей, оценивших новость, желательно учесть что их могут быть тысячи и сделать возможность постраничного вывода;
SELECT users.* FROM likes JOIN users ON likes.user_id = users.id WHERE likes.post_id = :post_id LIMIT :limit OFFSET :offset;

# 4. запрос для вывода ленты новостей;
# С фильтром по категориям
SELECT * FROM posts WHERE user_id != :user_id AND category_id = :category_id ORDER BY created_at DESC LIMIT :limit OFFSET :offset;
# Без фильтра по категориям
SELECT * FROM posts WHERE user_id != :user_id ORDER BY created_at DESC LIMIT :limit OFFSET :offset;

# 5. запрос на добавление поста в ленту.
INSERT INTO posts (content, category_id, user_id) VALUES (:content, :category_id, :user_id);
