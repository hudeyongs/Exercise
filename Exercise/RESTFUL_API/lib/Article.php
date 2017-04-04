<?php

/**
 * Class Article
 */
class Article
{

    /**
     * @var
     */
    private $_db;

    /**
     * Article constructor.
     * @param $_db
     */
    public function __construct($_db)
    {
        $this->_db = $_db;
    }

    /**
     * 创建文章
     * @param $title
     * @param $content
     * @param $user_id
     */
    public function create($title, $content, $user_id)
    {
        if (empty($title))
        {
            throw new Exception('文章标题不能为空', ARTICLE_TITLE_CANNOT_EMPTY);
        }
        if (empty($content))
        {
            throw new Exception('文章内容不能为空', ARTICLE_CONTENT_CANNOT_EMPTY);
        }
        $sql = 'INSERT INTO `article` (
`title`, `content`, `user_id`, `created_at`
) VALUES (:title, :content, :user_id, :created_at)';
        $created_at = date('Y-m-d', time());
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':created_at', $created_at);
        if ( ! $stmt->execute())
        {
            throw new Exception('发表文章失败', Error::ARTICLE_CREATE_FAIL);
        }
        return [
          'article_id' => $this->_db->lastInsertId(),
            'title' => $title,
            'content' => $content,
            'user_id' => $user_id,
            'created_at' => $created_at
        ];
    }

    /**
     * 查看一篇文章
     * @param $article_id
     * @return mixed
     * @throws Exception
     */
    public function view($article_id)
    {
        if (empty($article_id))
        {
            throw new Exception('文章 id 不能为空', ErrorCode::ARTICLE_ID_CANNOT_EMPTY);
        }
        $sql = 'SELECT * FROM `article` WHERE
 `article_id` =:id';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($article))
        {
            throw new Exception('文章不存在', ErrorCode::ARTICLE_NOT_FOUND);
        }
        return $article;
    }

    /**
     * 编辑文章
     * @param $article_id
     * @param $title
     * @param $content
     * @param $user_id
     */
    public function edit($article_id, $title, $content, $user_id)
    {
        $article = $this->view($article_id);
        var_dump($article['user_id']);
        var_dump($user_id);
        exit;
        if ($article['user_id'] != $user_id)
        {
            throw new Exception('您无权编辑该文章', ErrorCode::PERMISSION_DENIED);
        }
        $title = empty($title) ? $article['title'] : $title;
        $content = empty($content) ? $article['content'] : $content;
        if ($title == $article['title'] && $content == $article['content'])
        {
            return $article;
        }
        $sql = 'UPDATE `article` SET `title` =:title, `content` =:content WHERE ABSOLUTE 
`article_id` =:id';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':article_id', $article_id);
        if ( ! $stmt->execute())
        {
            throw new Exception('文章编辑失败', ErrorCode::ARTICLE_EDIT_FAIL);
        }
        return [
          'article_id' => $article_id,
            'title' => $title,
            'content' => $content,
            'created_at' => $article['created_at']
        ];
    }

    /**
     * 删除文章
     * @param $article_id
     * @param $user_id
     */
    public function delete($article_id, $user_id)
    {

    }

    /**
     * 获取文章列表
     * @param $user_id
     * @param int $page
     * @param int $size
     */
    public function getList($user_id, $page = 1, $size = 10)
    {

    }
}
