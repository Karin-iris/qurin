<?php
namespace App\Exceptions;

use App\Exceptions\TokenException;
use Exception;
use Illuminate\Support\Facades\Log;

class RepositoryExceptionHandler
{
    public static function handle(\Closure $operation)
    {

        try {
            return $operation();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error("データベースクエリエラー: " . $e->getMessage());
            throw new \Exception("データベース操作中にエラーが発生しました。");
        } catch (TokenException $e) {
            Log::error("トークンエラー: " . $e->getMessage());
            return redirect()->route('custom.error.page');
        } catch(Exception $e) {
            // ここで例外を処理
            Log::error($e->getMessage());
            // 必要に応じてカスタム例外を投げるか、さらなる処理を行う
            throw $e;
        }
    }
}
