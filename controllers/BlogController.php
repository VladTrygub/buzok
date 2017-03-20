<?php
/**
 * Created by PhpStorm.
 * User: VladT
 * Date: 20.01.2017
 * Time: 17:01
 */

namespace app\controllers;


use app\models\Comment;
use app\models\Post;
use app\models\User;
use app\models\UserCommentRatesDown;
use app\models\UserCommentRatesUp;
use app\models\UserPostLikes;
use Yii;
use yii\web\Controller;

class BlogController extends Controller {

  public $layout = "my";

  public function actionIndex() {
    //    var_dump(date("Y-m-d H:i", time()));die;
    //    var_dump(time());die;
    $posts = Post::find()->all();
    if (!Yii::$app->user->isGuest) {
      $user = User::find()->where(['uname' => Yii::$app->user->identity->username])->one();
      $query = Yii::$app->db->createCommand("SELECT post_id FROM user_post_likes WHERE user_id = {$user->uid}")->queryAll();
      if ($query) {
        $likes = [];
        foreach ($query as $item)
          $likes[] = $item['post_id'];
        return $this->render('index', compact('posts', 'likes'));
      }
    }
    return $this->render('index', compact('posts'));
  }

  public function actionView($id) {
    $post = Post::findOne($id);
    $post_id = $id;
    $user = User::find()->where(['uname' => Yii::$app->user->identity->username])->one();
    $user_id = $user->uid;
    $comments = Comment::find()->where(['post_id' => $id])->all();
    if (!Yii::$app->user->isGuest) {
      $query = Yii::$app->db->createCommand("SELECT * FROM user_post_likes WHERE user_id = {$user->uid} AND post_id = {$id}")->queryOne();
      $ratesUp = UserCommentRatesUp::getRatesUpByUserID($user->uid);
      $ratesDown = UserCommentRatesDown::getRatesDownByUserID($user->uid);
      if ($query) {
        $liked = true;
        return $this->render('view', compact('post', 'comments', 'liked', 'ratesUp', 'ratesDown', 'post_id', 'user_id'));
      }
    }
    return $this->render('view', compact('post', 'comments', 'post_id', 'user_id'));
  }

  public function actionAddLike($id) {
    $user = User::find()->where(['uname' => Yii::$app->user->identity->username])->one();
    $post = Post::findOne($id);
    if ($user && $post) {
      if (!empty($this->checkLike($user->uid, $post->id))) return false;
      $this->updatePost($post->id, $post->likes + 1);
      $likes = new UserPostLikes();
      $likes->user_id = $user->uid;
      $likes->post_id = $post->id;
      $likes->save();
      $post = Post::findOne($id);
      return $post->likes;
    } else return false;
  }

  public function actionRemoveLike($id) {
    $user = User::find()->where(['uname' => Yii::$app->user->identity->username])->one();
    $post = Post::findOne($id);
    if ($user && $post) {
      if (empty($this->checkLike($user->uid, $post->id))) return false;
      $this->updatePost($post->id, $post->likes - 1);
      Yii::$app->db->createCommand()->delete(
        'user_post_likes',
        "user_id = {$user->uid} AND post_id = {$post->id}"
      )->execute();
      $post = Post::findOne($id);
      $response = $post->likes;
      return $post->likes;
    } else
      return false;
  }

  public function actionRateDown($id) {
    $comment = Comment::findOne($id);
    $user = User::find()->where(['uname' => Yii::$app->user->identity->username])->one();
    if ($user && $comment) {
      $rateDown = new UserCommentRatesDown();
      $rateDown->comment_id = $comment->id;
      $rateDown->user_id = $user->uid;
      $rateDown->save();
      Comment::updateRateDown($comment->id, $comment->dislikes + 1);
      return Comment::getDislikes($id);
    } else return false;
  }

  public function actionRateUp($id) {
    $comment = Comment::findOne($id);
    $user = User::find()->where(['uname' => Yii::$app->user->identity->username])->one();
    if ($user && $comment) {
      $rateUp = new UserCommentRatesUp();
      $rateUp->comment_id = $comment->id;
      $rateUp->user_id = $user->uid;
      $rateUp->save();
      Comment::updateRateUp($comment->id, $comment->likes + 1);
      return Comment::getLikes($id);
    } else return false;
  }

  public function actionRemoveRateDown($id) {
    $comment = Comment::findOne($id);
    $user = User::find()->where(['uname' => Yii::$app->user->identity->username])->one();
    if ($user && $comment)
      if (UserCommentRatesDown::deleteRate($id, $user->uid))
        if (Comment::updateRateDown($id, $comment->dislikes - 1)) {
          $res = Comment::getDislikes($id);
          return $res <= 0 ? 'zero' : $res;
        } else return false;
      else return false;
    else return false;
  }

  public function actionRemoveRateUp($id) {
    $comment = Comment::findOne($id);
    $user = User::find()->where(['uname' => Yii::$app->user->identity->username])->one();
    if ($user && $comment)
      if (UserCommentRatesUp::deleteRate($id, $user->uid))
        if (Comment::updateRateUp($id, $comment->dislikes - 1)) {
          $res = Comment::getLikes($id);
          return $res <= 0 ? 'zero' : $res;
        } else return false;
      else return false;
    else return false;
  }

  public function actionAddUserComment() {
    if (!Yii::$app->request->post()) {
      return false;
    }
    $comment = new Comment();
    $post_id = Yii::$app->request->post('post_id');
    $text = Yii::$app->request->post('text');
    $user_id = User::find()->where(['uname' => Yii::$app->user->identity->username])->one()->uid;
    if ($user_id) {
      $comment->user_id = $user_id;
      $comment->post_id = $post_id;
      $comment->text = $text;
      $time = time();
      $comment->created_at = $time;
      $comment->updated_at = $time;
      $comment->save();
      Post::addComment($post_id);
      $this->layout = false;
      return $this->render('comment', compact('comment'));
    } return false;
  }

  private function checkLike($user_id, $post_id) {
    return Yii::$app->db->createCommand("
            SELECT * 
            FROM user_post_likes 
            WHERE user_id = {$user_id} AND post_id = {$post_id}
    ")->queryAll();
  }

  private function updatePost($post_id, $likes) {
    Yii::$app->db->createCommand()->update('post', ['likes' => $likes], "id = {$post_id}")->execute();
  }

}