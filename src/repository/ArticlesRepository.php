<?php

namespace App\Repository;

use App\Entity\Article;
use App\Repository\DefaultRepository;

class ArticlesRepository extends DefaultRepository
{

    public function getArticleById(int $id): Article
    {
        // Preparing the request in order to avoid SQL injection
        try {
            $request = $this->dataBase->getPDO()->prepare(
                'SELECT * from articles WHERE id = :id;'
            );
            // Binding value
            if (!$request->bindValue(":id", $id, \PDO::PARAM_INT)) {
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
        $article = new Article;
        $article->setId($response[$article->getColumns()["id"]]);
        $article->setCreatedBy($response[$article->getColumns()["createdBy"]]);
        $article->setCreatedAt(new \DateTime($response[$article->getColumns()["createdAt"]]));
        $article->setModifiedBy(null);
        $article->setModifiedAt(null);
        return ($article);
    }

}
