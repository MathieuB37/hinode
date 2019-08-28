<?php

namespace App\Repository;

use App\Entity\ArticleTranslation;
use App\Repository\DefaultRepository;

class ArticleTranslationsRepository extends DefaultRepository
{
    public function getArticleByLang(int $id, string $lang): ArticleTranslation
    {
        // Preparing the request in order to avoid SQL injection
        try {
            $request = $this->dataBase->getPDO()->prepare(
                'SELECT * from article_translations WHERE language_id
                IN (SELECT id FROM languages WHERE languages.name = :lang)
                AND article_translations.article_id = :id;'
            );
            // Binding value
            if (!$request->bindValue(":id", $id, \PDO::PARAM_INT) ||
                !$request->bindValue(":lang", $lang, \PDO::PARAM_STR)) {
                throw new PDOException("Request Failed");
            }
            // Executing the request
            if (!$request->execute()) {
                // Request Failed
                throw new PDOException("Could not get article");
            }
            // Fetching the article
            $response = $request->fetch();
            if ($request->closeCursor() === false) {
                throw new PDOException("Could not get article");
            }
        } catch (PDOException $error) {
            echo "Request Failed : " . $error;
            exit;
        }
        $article = new ArticleTranslation;
        $article->setId($response["id"]);
        $article->setArticleId($response["article_id"]);
        $article->setLanguageId($response["language_id"]);
        $article->setTitle($response["title"]);
        $article->setContent($response["content"]);
        return ($article);
        // $article =  ["title" => $response]
    }

}
