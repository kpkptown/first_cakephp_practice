<?php

namespace App\Controller;

use App\Controller\AppController;

class PostsController extends AppController   //AppControllerの継承
{
    public function index()
    {
        $posts = $this->Posts->find('all');
        $this->set(compact('posts'));   // ビューテンプレートに値を設定する働き　

    }
    public function view($id = null)
    {
        $post = $this->Posts->get($id,[
            'contain' => 'Comments'
        ]);
        $this->set(compact('post'));

    }
    public function add()
    {
        $post = $this->Posts->newEntity();       //newEntity()で新しいエンティティーの作成
        if($this->request->is('post')){         //エンティティーの取り出し
            $post = $this->Posts->patchEntity($post,$this->request->data);      //patchEntityでエンティティーを更新
            if($this->Posts->save($post)){       //saveでエンティティーの保存
                $this->Flash->success('Add Success!');
                return $this->redirect(['action'=>'index']);
            }else{
                $this->Flash->error('Add Error!');
            }
        }
        $this->set(compact('post'));

    }
    public function edit($id = null)
    {
        $post = $this->Posts->newEntity();      //newEntity()で新しいエンティティーの作成
        if($this->request->is(['post','patch','put'])){     //エンティティーの取り出し
            $post = $this->Posts->patchEntity($post,$this->request->data);     //patchEntityでエンティティーを更新
            if($this->Posts->save($post)){      //saveでエンティティーの保存
                $this->Flash->success('Edit Success!');
                return $this->redirect(['action'=>'index']);
            }else{
                $this->Flash->error('Edit Error!');
            }
        }
        $this->set(compact('post'));

    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post','delete']);     // POST と DELETE のリクエストのみ受け入れる
        $post = $this->Posts->get($id);     //指定のidでエンティティーを取り出す
            if($this->Posts->delete($post)){        //deleteで削除
                $this->Flash->success('Delete Success!');
            }else{
                $this->Flash->error('Delete Error!');
            }
            return $this->redirect(['action'=>'index']);
    }
}

//エンティティーの作成・保存：①フォームの値を取得、②newEntityでインスタンス作成、③saveで保存
//エンティティーの更新：①更新するエンティティーの取り出し、②フォームで修正情報の送信、③取り出したエンティティーを修正し、データベースへアップロード