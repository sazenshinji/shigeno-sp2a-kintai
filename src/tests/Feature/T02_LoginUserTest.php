<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class T02_LoginUserTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_ログイン認証機能（一般ユーザー）_バリデーション_email_required()
    {
        //フォームデータ
        $formData = [
            // 'email' => '1234@abcd',
            'password' => '12345678',
        ];
        // POSTリクエスト
        $response = $this->post('/login', $formData);
        // バリデーションエラー発生を確認
        $response->assertSessionHasErrors([
            'email',
            // 'password',
        ]);
        // セッションのエラー取得
        $errors = session('errors')->getMessages();
        // エラーメッセージを確認
        $this->assertEquals('メールアドレスを入力してください', $errors['email'][0]);
    }
}
