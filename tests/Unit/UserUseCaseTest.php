<?php

namespace Tests\Unit;

use App\UseCases\UserUseCase;
use PHPUnit\Framework\TestCase;

class UserUseCaseTest extends TestCase
{
    public function testGetUser()
    {
        // ユースケースのインスタンスを作成
        $useCase = new UserUseCase();

        // ユースケースのメソッドを実行
        $result = $useCase->getUser(1);

        // 期待される結果をアサート
        $this->assertIsObject($result);
    }
}
